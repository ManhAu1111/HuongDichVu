<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = "http://127.0.0.1:8003";
    }

    /**
     * Lấy user bằng auth_token (từ auth-service)
     */
    private function getUser()
    {
        $token = Cookie::get('auth_token');

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get("http://127.0.0.1:8001/api/me");

        if (!$response->ok()) {
            return null;
        }

        return $response->json();
    }


    /**
     * 1. Trang HOME
     */
    public function index()
    {
        $categories = Http::get("$this->api/categories")->json();
        $products   = Http::get("$this->api/products")->json();
        $latest     = Http::get("$this->api/products/latest")->json();
        $featured   = Http::get("$this->api/products/top-rated")->json();

        $productsByCate = [];
        foreach ($categories as $cate) {
            $productsByCate[$cate['id']] =
                Http::get("$this->api/products/category/{$cate['id']}/limit/4")->json();
        }

        return view('shop.index', compact('categories', 'products', 'latest', 'featured', 'productsByCate'));
    }


    /**
     * 2. Trang SHOP (side_v2)
     */
    public function shop(Request $request)
    {
        // dd(request()->cookie(), Cookie::get('auth_token'));

        $user = $this->getUser();  // <-- Quan trọng

        $categories = Http::get("$this->api/categories")->json();

        $query = [
            'category'  => $request->category,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'limit'     => $request->limit ?? 12,
            'page'      => $request->page ?? 1,
            'search'    => $request->search,
        ];

        $products = Http::get("$this->api/products/filter", $query)->json();


        return view('shop.shop_side_v2', compact('categories', 'products', 'user'));
    }


    /**
     * 3. Filter category
     */
    public function byCategory($id)
    {
        $user = $this->getUser(); // <-- Thêm dòng này

        $categories = Http::get("$this->api/categories")->json();
        $products   = Http::get("$this->api/products/category/$id")->json();

        return view('shop.shop_side_v2', compact('categories', 'products', 'user'));
    }


    /**
     * 4. Trang chi tiết sản phẩm
     */
    public function detail($id)
    {
        $user = $this->getUser(); // <-- Lấy user luôn

        $product    = Http::get("$this->api/products/$id")->json();
        $images     = Http::get("$this->api/product_images/$id")->json();
        $category   = Http::get("$this->api/categories/" . $product['category_id'])->json();
        $latest     = Http::get("$this->api/products/latest")->json();
        $categories = Http::get("$this->api/categories")->json();

        return view('products.product_detail', compact(
            'product',
            'images',
            'category',
            'latest',
            'categories',
            'user'
        ));
    }
}
