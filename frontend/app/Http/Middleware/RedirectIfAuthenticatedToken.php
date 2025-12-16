<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('auth_token');

        if ($token) {
            // Khởi tạo Client Guzzle
            $client = new Client([
                // Đảm bảo base_uri khớp với Auth Service
                'base_uri' => 'http://127.0.0.1:8001',
                'http_errors' => false,
            ]);

            // Gọi API /auth/me (đã sửa để khớp với Auth Service) để lấy dữ liệu người dùng
            $response = $client->get('/auth/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // 1. Nếu Auth Service trả về OK (token hợp lệ)
            if (isset($data['ok']) && $data['ok'] === true) {

                // 2. Lấy vai trò (role) từ response
                // Cấu trúc response: $data['data']['role']
                $user_data = $data['data'] ?? [];
                $role_value = $user_data['role'] ?? 0;
                $role_id = (int) $role_value; // Chuyển về số nguyên để so sánh với ID Admin là 1

                // 3. Phân quyền chuyển hướng
                if ($role_id === 1) {
                    // Admin: Chuyển hướng đến Admin Dashboard
                    return redirect('/admin');
                } else {
                    // Client: Chuyển hướng đến Client Dashboard
                    return redirect('/dashboard');
                }
            }
            // Nếu token không hợp lệ (hết hạn, lỗi), sẽ tiếp tục qua $next,
            // cho phép truy cập /signin để đăng nhập lại.
        }

        return $next($request);
    }
}
