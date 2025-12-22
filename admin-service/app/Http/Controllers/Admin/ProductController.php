<?php
// admin-service/app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // URL của product-service theo file index.php bạn cung cấp
    protected $productService = 'http://127.0.0.1:8003';
    /**
     * 1. Lấy danh sách sản phẩm
     * Gọi đến GET /products của product-service
     */
    public function index()
    {
        try {
            $response = Http::timeout(5)->get("{$this->productService}/products");
            if ($response->successful()) {
                return $response->json();
            }
            return response()->json(['error' => 'Product service returned an error'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Cannot connect to Product Service: ' . $e->getMessage()], 503);
        }
    }
    /**
     * 2. Lấy dữ liệu chi tiết sản phẩm
     * Gọi đến GET /products/{id} của product-service
     */
    public function show($id)
    {
        $response = Http::get("{$this->productService}/products/{$id}");
        return response()->json($response->json(), $response->status());
    }

    /**
     * 3. Lấy danh sách danh mục
     * Gọi đến GET /categories của product-service
     */
    public function getCategories()
    {
        // Đã sửa lỗi cú pháp và đảm bảo gọi đúng endpoint /categories
        $response = Http::get("{$this->productService}/categories");
        return response()->json($response->json(), $response->status());
    }

    /**
     * 4. Thêm mới sản phẩm
     * Gọi đến POST /products của product-service
     */
    public function store(Request $request)
    {
        // Chuyển tiếp toàn bộ dữ liệu từ FE sang product-service
        $response = Http::post("{$this->productService}/products", $request->all());
        return response()->json($response->json(), $response->status());
    }

    /**
     * 5. Cập nhật sản phẩm
     * Gọi đến PUT /products/{id} của product-service
     */
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->productService}/products/{$id}", $request->all());
        return response()->json($response->json(), $response->status());
    }

    /**
     * 6. Xóa sản phẩm
     * Gọi đến DELETE /products/{id} của product-service
     */
    public function destroy($id)
    {
        $response = Http::delete("{$this->productService}/products/{$id}");
        return response()->json($response->json(), $response->status());
    }
}
