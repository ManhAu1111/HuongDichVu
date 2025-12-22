<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = Cookie::get('auth_token');

        if (!$token) {
            return redirect()->route('login');
        }

        // SỬA: Thay /api/me thành /auth/me để khớp với route đã định nghĩa trong index.php của Auth Service
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get("http://127.0.0.1:8001/auth/me"); // <--- CHỈ SỬA ĐOẠN NÀY

        if (!$response->ok()) {
            Log::warning('ADMIN AUTH FAILED: Auth Service returned non-200. Status: ' . $response->status());
            Cookie::queue(Cookie::forget('auth_token'));
            return redirect()->route('login')->with('error', 'Phiên đăng nhập hết hạn hoặc dịch vụ xác thực bị lỗi.');
        }

        // Parse JSON.
        $response_data = $response->json() ?? [];

        // Log lại phản hồi thô để chẩn đoán
        Log::info('ADMIN AUTH CHECK: API Response Data: ' . json_encode($response_data));

        // 1. Lấy vai trò (role) an toàn dưới dạng CHUỖI
        // Role từ database/Auth Service là string (ví dụ: 'admin', 'customer')
        $role_value = $response_data['data']['role'] ?? 'guest'; // Mặc định là 'guest'

        // Ghi log để chẩn đoán giá trị cuối cùng
        Log::info('ADMIN AUTH CHECK: User Role Value (Final String): ' . $role_value);

        // 2. Phân quyền: So sánh với chuỗi 'admin'
        if ($role_value !== 'admin') {
            Log::alert('ADMIN ACCESS DENIED: Role is ' . $role_value . ', redirected to shop.index.');
            // Đảm bảo route 'shop.index' đã được định nghĩa trong web.php
            return redirect()->route('shop.index')->with('error', 'Tài khoản của bạn không có quyền truy cập trang Admin.');
        }

        // Nếu role là 'admin', cho phép truy cập
        return $next($request);
    }
}
