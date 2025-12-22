<?php
namespace App\Middleware;

use App\Helpers\AuthHelper;

class AuthMiddleware
{
    public static function handle()
    {
        return AuthHelper::user();
    }
}
