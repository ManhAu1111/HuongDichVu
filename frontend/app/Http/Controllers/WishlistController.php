<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WishlistController extends Controller
{
    public function index()
    {
        // Lấy JWT token từ cookie
        $token = request()->cookie('auth_token');

        // Gọi wishlist-service
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('WISHLIST_SERVICE_URL') . '/wishlist');

        // Debug tạm (rất nên bật 1 lần)
        // dd($response->json());

        return view('wishlist', [
            'wishlistItems' => $response->json() ?? []
        ]);
    }
}
