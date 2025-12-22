<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CartPageController extends Controller
{
    private function getCookie($name)
    {
        return request()->cookie($name);
    }

    private function getUserIdFromJWT()
    {
        $token = $this->getCookie('auth_token');
        if (!$token) return null;

        try {
            $parts = explode('.', $token);
            if (count($parts) < 2) return null;

            $payload = json_decode(base64_decode($parts[1]), true);
            return $payload['sub'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function index()
    {
        $userId = $this->getUserIdFromJWT();

        if (!$userId) {
            return redirect('/signin')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng');
        }

        // GỌI ORDER SERVICE
        $response = Http::get('http://127.0.0.1:8002/api/cart', [
            'user_id' => $userId
        ]);

        if (!$response->ok()) {
            Log::error('Cart API error', ['resp' => $response->body()]);
            return back()->with('error', 'Không thể tải giỏ hàng');
        }

        $cartItems = $response->json()['items'] ?? [];

        return view('cart', [
            'cartItems' => $cartItems,
            'userId'    => $userId
        ]);
    }
}
