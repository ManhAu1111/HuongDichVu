<?php

namespace App\Helpers;

use App\Core\JWT;

class AuthHelper
{
    public static function user()
    {
        // 1️⃣ Ưu tiên Authorization header (nếu có)
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
            return JWT::decode($token);
        }

        // 2️⃣ Fallback: đọc cookie auth_token
        if (isset($_COOKIE['auth_token'])) {
            try {
                return JWT::decode($_COOKIE['auth_token']);
            } catch (\Exception $e) {
                // continue
            }
        }

        // 3️⃣ Không xác thực được
        http_response_code(401);
        echo json_encode(['message' => 'Unauthenticated']);
        exit;
    }
}
