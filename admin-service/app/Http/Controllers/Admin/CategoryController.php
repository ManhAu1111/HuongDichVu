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
}
