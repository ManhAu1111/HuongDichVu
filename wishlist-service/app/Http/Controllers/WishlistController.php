<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user_id;

        $productIds = Wishlist::where('user_id', $userId)
            ->pluck('product_id')
            ->toArray();

        if (empty($productIds)) {
            return response()->json([]);
        }

        $response = Http::post(
            config('services.product.url') . '/products/bulk',
            ['ids' => $productIds]
        );

        if (!$response->ok()) {
            return response()->json([
                'message' => 'Product service unavailable'
            ], 503);
        }

        return response()->json($response->json());
    }



    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        Wishlist::firstOrCreate([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id
        ]);

        return response()->json(['message' => 'Added to wishlist']);
    }

    public function destroy(Request $request, $productId)
    {
        Wishlist::where('user_id', $request->user_id)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['message' => 'Removed from wishlist']);
    }

    public function clear(Request $request)
    {
        $userId = $request->user_id; // lấy từ AuthJwt middleware

        Wishlist::where('user_id', $userId)->delete();

        return response()->json([
            'message' => 'Wishlist cleared'
        ]);
    }
}
