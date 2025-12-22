<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WishlistController extends Controller
{
    public function index()
    {
        // JWT đã có sẵn (cookie hoặc session)
        $token = request()->cookie('token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get(env('WISHLIST_SERVICE_URL') . '/wishlist');

        if (!$response->ok()) {
            return view('wishlist', ['wishlistItems' => []]);
        }

        return view('wishlist', [
            'wishlistItems' => $response->json()
        ]);
    }
}
