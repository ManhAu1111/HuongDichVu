<?php

namespace App\Controllers;

use App\Database;
use App\Helpers\JWTHandler;
use App\Helpers\MailHelper;
use PDO;

class AuthController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    // =========================
    // REGISTER (with verify email)
    // =========================
    public function register($fullname, $email, $password)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $query->execute([$email]);

        if ($query->fetch()) {
            return ["ok" => false, "message" => "Email đã tồn tại"];
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $verifyToken = bin2hex(random_bytes(32));

        $stmt = $this->db->prepare("
            INSERT INTO users(fullname, email, password, verify_token, role)
            VALUES (?, ?, ?, ?, 'customer')
        ");

        $stmt->execute([$fullname, $email, $hash, $verifyToken]);

        MailHelper::sendVerifyEmail($email, $verifyToken);

        return ["ok" => true, "message" => "Đăng ký thành công! Hãy kiểm tra email để xác thực."];
    }

    // =========================
    // LOGIN (check verify + token)
    // =========================
    public function login($email, $password)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user["password"])) {
            return ["ok" => false, "message" => "Sai email hoặc mật khẩu"];
        }

        if ($user["is_verified"] == 0) {
            return ["ok" => false, "message" => "Email chưa được xác thực"];
        }

        if ($user["role"] === "block") {
            return [
                "ok" => false,
                "message" => "Tài khoản đã bị khóa. Vui lòng liên hệ quản trị viên."
            ];
        }

        $token = JWTHandler::encode([
            "sub" => $user["id"],
            "email" => $user["email"],
            "role" => $user["role"],
            "fullname" => $user["fullname"], //Hiển thị tên của user cho greeting
            "iat" => time(),
            "exp" => time() + 3600
        ]);

        return [
            "ok" => true,
            "token" => $token,
            "user" => [
                "id" => $user["id"],
                "fullname" => $user["fullname"],
                "email" => $user["email"],
                "role" => $user["role"],
            ]
        ];
    }

    // =========================
    // ADMIN - BLOCK USER
    // =========================
    public function blockUser($id)
    {
        $stmt = $this->db->prepare("
        UPDATE users SET role = 'block' WHERE id = ?
    ");
        $stmt->execute([$id]);
    }

    // =========================
    // ADMIN - UNBLOCK USER
    // =========================
    public function unblockUser($id)
    {
        $stmt = $this->db->prepare("
        UPDATE users SET role = 'customer' WHERE id = ?
    ");
        $stmt->execute([$id]);
    }


    // =========================
    // VERIFY EMAIL
    // =========================
    public function verify($token)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE verify_token = ?");
        $query->execute([$token]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ["ok" => false, "message" => "Token không hợp lệ"];
        }

        $update = $this->db->prepare("
            UPDATE users 
            SET is_verified = 1, verify_token = NULL 
            WHERE id = ?
        ");
        $update->execute([$user["id"]]);

        return ["ok" => true, "message" => "Email xác thực thành công!"];
    }

    // =========================
    // /me (get user from token)
    // =========================
    public function me($token)
    {
        try {
            $data = JWTHandler::decode($token);
            return ["ok" => true, "data" => (array)$data];
        } catch (\Exception $e) {
            return ["ok" => false, "message" => "Token expired or invalid"];
        }
    }

    // =========================
    // ADMIN - GET ALL USERS
    // =========================
    public function getAllUsers()
    {
        $stmt = $this->db->query("
        SELECT 
            id,
            fullname,
            email,
            role,
            created_at,
            is_verified
        FROM users
        ORDER BY created_at DESC
    ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // ADMIN - UPDATE USER
    // =========================
    public function updateUser($id, $fullname, $role)
    {
        $stmt = $this->db->prepare("
        UPDATE users 
        SET fullname = ?, role = ?
        WHERE id = ?
    ");
        $stmt->execute([$fullname, $role, $id]);
    }
}
