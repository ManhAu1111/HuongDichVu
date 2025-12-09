<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $role = $request->cookie('user_role');

        if ($role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Bạn không có quyền truy cập trang admin.');
        }

        return $next($request);
    }
}
