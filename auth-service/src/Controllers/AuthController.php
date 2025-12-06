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

    private function getFullname($id)
    {
        $stmt = $this->db->prepare("SELECT fullname FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }


    /* ============================================================
     *  REGISTER
     * ============================================================ */
    public function register($fullname, $email, $password)
    {
        // Email tồn tại?
        $query = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $query->execute([$email]);

        if ($query->fetch()) {
            return ["ok" => false, "message" => "Email đã tồn tại"];
        }

        // Hash password
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Token dùng để verify email
        $verifyToken = bin2hex(random_bytes(32));

        // Insert user
        $stmt = $this->db->prepare("
            INSERT INTO users(fullname, email, password, verify_token, is_verified)
            VALUES(?,?,?,?,0)
        ");
        $stmt->execute([$fullname, $email, $hash, $verifyToken]);

        // Gửi email verify
        MailHelper::sendVerifyEmail($email, $fullname, $verifyToken);

        return ["ok" => true, "message" => "Đăng ký thành công! Hãy kiểm tra email để xác thực."];
    }


    /* ============================================================
     *  LOGIN
     * ============================================================ */
    public function login($email, $password)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Sai email hoặc password
        if (!$user || !password_verify($password, $user["password"])) {
            return ["ok" => false, "message" => "Sai email hoặc mật khẩu"];
        }

        // Chưa xác thực email
        if ($user["is_verified"] == 0) {
            return ["ok" => false, "message" => "Email chưa được xác thực"];
        }

        // Tạo JWT chứa id (sub) và email
        $token = JWTHandler::encode([
            "sub"   => $user["id"],
            "email" => $user["email"],
            "iat"   => time(),
            "exp"   => time() + (int) $_ENV["JWT_EXPIRES_IN"]
        ]);

        return ["ok" => true, "token" => $token];
    }


    /* ============================================================
     *  VERIFY EMAIL
     * ============================================================ */
    public function verify($token)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE verify_token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ["ok" => false, "message" => "Token không hợp lệ hoặc đã hết hạn"];
        }

        $update = $this->db->prepare("
            UPDATE users SET is_verified = 1, verify_token = NULL WHERE id = ?
        ");
        $update->execute([$user["id"]]);

        return ["ok" => true, "message" => "Xác thực email thành công!"];
    }


    /* ============================================================
     *  ME — Lấy user từ JWT
     * ============================================================ */
    public function me()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Missing token']);
            return;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $jwtHandler = new \App\Helpers\JWTHandler();
        $user = $jwtHandler->decode($token);

        // decode lỗi hoặc token hết hạn → trả về null
        if (!$user || !isset($user->sub)) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
            return;
        }

        // Lấy fullname từ DB
        $fullname = $this->getFullname($user->sub);

        echo json_encode([
            'id'       => $user->sub,
            'email'    => $user->email ?? null,
            'fullname' => $fullname,
        ]);
    }
}
