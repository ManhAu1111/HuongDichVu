<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // =========================
    // LIST USERS
    // =========================
    public function index(Request $request)
    {
        $token = $request->cookie('auth_token');

        if (!$token) {
            abort(401, 'Chưa đăng nhập');
        }

        $response = Http::withToken($token)
            ->get(env('AUTH_SERVICE_URL') . '/admin/users');

        if (!$response->ok()) {
            abort(500, 'Không lấy được dữ liệu người dùng');
        }

        $users = $response->json('data') ?? [];

        // SEARCH
        if ($search = $request->get('search')) {
            $users = array_filter($users, function ($u) use ($search) {
                return str_contains(strtolower($u['email']), strtolower($search))
                    || str_contains(strtolower($u['fullname']), strtolower($search));
            });
        }

        return view('admin.users.index', compact('users'));
    }

    // =========================
    // BLOCK USER
    // =========================
    public function block($id, Request $request)
    {
        $token = $request->cookie('auth_token');

        Http::withToken($token)
            ->put(env('AUTH_SERVICE_URL') . "/admin/users/{$id}/block");

        return back()->with('success', 'Đã khóa tài khoản');
    }

    // =========================
    // UNBLOCK USER
    // =========================
    public function unblock($id, Request $request)
    {
        $token = $request->cookie('auth_token');

        Http::withToken($token)
            ->put(env('AUTH_SERVICE_URL') . "/admin/users/{$id}/unblock");

        return back()->with('success', 'Đã mở khóa tài khoản');
    }

    // =========================
    // EDIT FORM
    // =========================
    public function edit($id, Request $request)
    {
        $token = $request->cookie('auth_token');

        $response = Http::withToken($token)
            ->get(env('AUTH_SERVICE_URL') . '/admin/users');

        $users = $response->json('data') ?? [];

        $user = collect($users)->firstWhere('id', (int)$id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.edit', compact('user'));
    }

    // =========================
    // UPDATE USER
    // =========================
    // public function updateName(Request $request, $id)
    // {
    //     $request->validate([
    //         'fullname' => 'required|string|max:255'
    //     ]);

    //     $token = $request->cookie('auth_token');

    //     if (!$token) {
    //         return redirect()->route('admin.users.index')
    //             ->with('error', 'Chưa đăng nhập');
    //     }

    //     $response = Http::withToken($token)
    //         ->put(env('AUTH_SERVICE_URL') . "/admin/users/{$id}/update-name", [
    //             'fullname' => $request->fullname
    //         ]);

    //     if (!$response->ok()) {
    //         return redirect()->route('admin.users.index')
    //             ->with('error', 'Cập nhật tên thất bại');
    //     }

    //     return redirect()->route('admin.users.index')
    //         ->with('success', 'Cập nhật tên thành công');
    // }
}
