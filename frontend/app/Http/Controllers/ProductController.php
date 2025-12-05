<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = "http://127.0.0.1:8003";
    }

    // 1. HOME (index)
    public function index()
    {
        $categories = Http::get("$this->api/categories")->json();
        $products   = Http::get("$this->api/products")->json();
        $latest = Http::get("$this->api/products/latest")->json();  
        $featured   = Http::get("$this->api/products/top-rated")->json(); 

        // Chuẩn bị mảng chứa 4 sản phẩm cho từng category
        $productsByCate = [];

        foreach ($categories as $cate) {
            $cateId = $cate['id'];

            // Gọi API lấy 4 sản phẩm theo category
            $productsByCate[$cateId] = Http::get("$this->api/products/category/$cateId/limit/4")->json();
        }

        return view('shop.index', compact('categories', 'products', 'latest', 'featured', 'productsByCate'));
    }

    // 2. SHOP (side_v2)
    public function shop(Request $request)
    {
        $categories = Http::get("$this->api/categories")->json();

        // Build query filter
        $query = [
            'category'  => $request->category,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'limit'     => $request->limit ?? 12,
            'page'      => $request->page ?? 1,
            'search'    => $request->search, // <--- thêm dòng này
        ];

        // Gọi API filter
        $products = Http::get("$this->api/products/filter", $query)->json();

        return view('shop.shop_side_v2', compact('categories', 'products'));
    }


    // 3. Filter theo Category
    public function byCategory($id)
    {
        $categories = Http::get("$this->api/categories")->json();
        $products   = Http::get("$this->api/products/category/$id")->json();

        return view('shop.shop_side_v2', compact('categories', 'products'));
    }

    // 4. Product detail
    public function detail($id)
    {
        $product   = Http::get("$this->api/products/$id")->json();
        $images    = Http::get("$this->api/product_images/$id")->json();
        $category  = Http::get("$this->api/categories/" . $product['category_id'])->json();
        $latest    = Http::get("$this->api/products/latest")->json();
        $categories = Http::get("$this->api/categories")->json();

        return view('products.product_detail', [
            'product'    => $product,
            'images'     => $images,
            'category'   => $category,
            'latest'     => $latest,
            'categories' => $categories
        ]);
    }

}
