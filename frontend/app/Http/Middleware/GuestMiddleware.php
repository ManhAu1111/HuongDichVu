<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Nếu đã có cookie đăng nhập → đá về dashboard
        if ($request->cookie('auth_token')) {

            // Nếu có role admin → redirect admin dashboard
            if ($request->cookie('user_role') === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Ngược lại là customer
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
