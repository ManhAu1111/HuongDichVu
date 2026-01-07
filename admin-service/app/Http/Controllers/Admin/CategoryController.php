<?php
// admin-service/app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $productService = 'http://127.0.0.1:8003';

    public function getAllCategories()
    {
        try {
            $response = Http::timeout(5)->get("{$this->productService}/categories");
            if ($response->successful()) {
                return $response->json();
            }
            return response()->json(['error' => 'Product service returned an error'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Cannot connect to Product Service: ' . $e->getMessage()], 503);
        }
    }

    public function getCategories()
    {
        // Đã sửa lỗi cú pháp và đảm bảo gọi đúng endpoint /categories
        $response = Http::get("{$this->productService}/categories");
        return response()->json($response->json(), $response->status());
    }

    /**
     * THÊM MỚI DANH MỤC
     */
    public function storeCategory(Request $request)
    {
        // Chuyển tiếp yêu cầu POST tới Product Service
        $response = Http::post("{$this->productService}/categories", $request->all());

        return response()->json($response->json(), $response->status());
    }

    /**
     * CẬP NHẬT DANH MỤC
     */
    public function updateCategory(Request $request, $id)
    {
        // Chuyển tiếp yêu cầu PUT tới Product Service
        $response = Http::put("{$this->productService}/categories/{$id}", $request->all());

        return response()->json($response->json(), $response->status());
    }

    /**
     * XÓA DANH MỤC
     */
    public function deleteCategory($id)
    {
        // Chuyển tiếp yêu cầu DELETE tới Product Service
        $response = Http::delete("{$this->productService}/categories/{$id}");

        return response()->json($response->json(), $response->status());
    }
}
