<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    /**
     * POST /api/cart/add
     */
    public function add(Request $req)
    {
        $req->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'integer|min:1'
        ]);

        $userId = $req->user_id;
        $productId = $req->product_id;
        $qty = $req->quantity ?: 1;

        // GỌI PRODUCT SERVICE ĐỂ LẤY THÔNG TIN SẢN PHẨM
        $productRes = Http::get("http://127.0.0.1:8003/products/{$productId}");

        if (!$productRes->ok()) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product = $productRes->json();

        $price = isset($product['price']) ? (float)$product['price'] : 0;
        $name  = $product['name'] ?? ($product['title'] ?? 'Product');

        $attributes = [
            'user_id'      => $userId,
            'product_id'   => $productId,
            'quantity'     => $qty,
            'product_name' => $name,
            'price'        => $price
        ];

        // ĐÃ CÓ TRONG GIỎ → CỘNG DỒN SỐ LƯỢNG
        $existing = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->quantity = max(1, $existing->quantity + $qty);
            $existing->price = $attributes['price'];
            $existing->product_name = $attributes['product_name'];
            $existing->save();

            return response()->json([
                'ok' => true,
                'message' => 'Updated quantity',
                'item' => $existing
            ]);
        }

        // TẠO MỚI ITEM
        $item = CartItem::create($attributes);

        return response()->json([
            'ok' => true,
            'message' => 'Added to cart',
            'item' => $item
        ]);
    }


    /**
     * GET /api/cart?user_id=...
     */
    public function list(Request $req)
    {
        $req->validate(['user_id' => 'required|integer']);

        $raw = CartItem::where('user_id', $req->user_id)->get();

        $items = [];

        foreach ($raw as $i) {

            $productId = $i->product_id;

            // 1. LẤY ẢNH PRIMARY
            $imgRes = Http::get("http://127.0.0.1:8003/products/{$productId}/primary-image");
            $primaryImage = $imgRes->ok()
                ? ($imgRes->json()['image_url'] ?? null)
                : null;

            // 2. LẤY PRODUCT ĐỂ LẤY category_id
            $productRes = Http::get("http://127.0.0.1:8003/products/{$productId}");
            $productData = $productRes->ok() ? $productRes->json() : null;

            $categoryName = null;

            // 3. LẤY TÊN DANH MỤC NẾU CÓ category_id
            if (!empty($productData['category_id'])) {
                $catRes = Http::get("http://127.0.0.1:8003/categories/" . $productData['category_id']);

                if ($catRes->ok()) {
                    $categoryData = $catRes->json();
                    $categoryName = $categoryData['name'] ?? null;
                }
            }

            // 4. GHÉP DỮ LIỆU TRẢ VỀ
            $items[] = [
                'id'            => $i->id,
                'user_id'       => $i->user_id,
                'product_id'    => $productId,
                'product_name'  => $i->product_name,
                'price'         => (float)$i->price,
                'quantity'      => (int)$i->quantity,
                'subtotal'      => (float)$i->price * (int)$i->quantity,
                'primary_image' => $primaryImage,
                'category_name' => $categoryName
            ];
        }

        return response()->json(['items' => $items]);
    }



    /**
     * PUT /api/cart/update
     */
    public function update(Request $req)
    {
        $req->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::find($req->item_id);

        if (!$item) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $item->quantity = $req->quantity;
        $item->save();

        return response()->json(['ok' => true, 'item' => $item]);
    }

    public function syncCart(Request $req)
    {
        $req->validate([
            'user_id' => 'required|integer'
        ]);

        $items = CartItem::where('user_id', $req->user_id)->get();

        foreach ($items as $item) {

            // Gọi product_service để lấy dữ liệu mới nhất
            $res = Http::get("http://127.0.0.1:8003/products/" . $item->product_id);

            if ($res->ok()) {
                $p = $res->json();

                $item->product_name = $p['name'] ?? $item->product_name;
                $item->price        = $p['price'] ?? $item->price;
                $item->save();
            }
        }

        return response()->json(['ok' => true, 'message' => 'Cart updated']);
    }



    /**
     * DELETE /api/cart/{id}
     */
    public function delete($id)
    {
        $item = CartItem::find($id);

        if (!$item) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $item->delete();

        return response()->json(['ok' => true]);
    }


    /**
     * DELETE ALL AFTER CHECKOUT
     */
    public function clear(Request $req)
    {
        Log::info("CLEAR_REQUEST", $req->all());

        $req->validate(['user_id' => 'required|integer']);

        CartItem::where('user_id', $req->user_id)->delete();

        return response()->json(['ok' => true]);
    }
}
