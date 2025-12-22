<?php
namespace App\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT {
    public static function decode($token) {
        return FirebaseJWT::decode(
            $token,
            new Key($_ENV['JWT_SECRET'], 'HS256')
        );
    }
}
