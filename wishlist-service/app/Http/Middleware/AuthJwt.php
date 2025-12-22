<?php
namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthJwt
{
    public function handle($request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->json(['message' => 'Missing token'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode(
                $token,
                new Key(env('JWT_SECRET'), 'HS256')
            );

            // 👇 MAP TRỰC TIẾP TỪ AUTH-SERVICE
            $request->merge([
                'user_id' => $decoded->sub,
                'user_role' => $decoded->role,
                'user_email' => $decoded->email
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid or expired token'
            ], 401);
        }

        return $next($request);
    }
}
