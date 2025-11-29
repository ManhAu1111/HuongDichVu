<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler
{

    public static function encode(array $payload)
    {
        return JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
    }

    public static function decode($token)
    {
        return JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
    }
}
