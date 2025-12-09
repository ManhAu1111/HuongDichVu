<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Lấy role từ cookie (đơn giản) hoặc từ auth_user nếu muốn an toàn hơn:
        $userRole = $request->cookie('user_role');

        // Nếu muốn lấy từ request attribute (AuthTokenMiddleware đã set), dùng:
        if (!$userRole) {
            $user = $request->attributes->get('auth_user');
            if ($user && isset($user['role'])) {
                $userRole = $user['role'];
            }
        }

        if (!$userRole || $userRole !== $role) {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
