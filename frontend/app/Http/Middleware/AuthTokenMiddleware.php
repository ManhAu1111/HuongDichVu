<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('auth_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập.');
        }

        // Gọi auth-service để verify token
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8001',
            'http_errors' => false
        ]);

        $response = $client->get('/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        // Token sai → bắt đăng nhập lại
        if (!$data['ok']) {
            return redirect()->route('login')->with('error', 'Phiên đăng nhập đã hết hạn.');
        }

        // Lưu user vào request để Dashboard dùng
        $request->merge([
            'auth_user' => $data['data']
        ]);

        return $next($request);
    }
}
