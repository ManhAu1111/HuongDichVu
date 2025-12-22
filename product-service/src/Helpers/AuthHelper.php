<?php

namespace App\Helpers;

use Exception;
use App\Helpers\JWTHandler;

class AuthHelper
{
    public static function getUserIdFromToken(): int
    {
        $headers = getallheaders();

        if (!isset($headers["Authorization"])) {
            http_response_code(401);
            echo json_encode(["message" => "Missing Authorization header"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        try {
            $data = JWTHandler::decode($token);
            return $data->sub; // user_id
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode([
                "message" => "Invalid or expired token"
            ]);
            exit;
        }
    }
    public static function getUserFromToken(): object
    {
        $headers = getallheaders();

        if (!isset($headers["Authorization"])) {
            http_response_code(401);
            echo json_encode(["message" => "Missing Authorization header"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        try {
            $data = JWTHandler::decode($token);
            return $data; // user object
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode([
                "message" => "Invalid or expired token"
            ]);
            exit;
        }
    }
}