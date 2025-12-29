<?php
// admin-service/app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    protected $orderService = 'http://127.0.0.1:8002'; // Cổng Order Service

    public function index(Request $request)
    {
        // Chuyển tiếp tất cả tham số lọc sang Order Service
        $response = Http::get("{$this->orderService}/api/admin/orders", $request->query());
        return response()->json($response->json(), $response->status());
    }

    public function show($public_id)
    {
        // Lấy thông tin đơn hàng
        $order = Http::get("{$this->orderService}/api/orders/{$public_id}")->json();
        // Lấy danh sách món hàng
        $items = Http::get("{$this->orderService}/api/order-items", ['order_id' => $order['id']])->json();

        return response()->json(['order' => $order, 'items' => $items]);
    }

    public function updateStatus(Request $request, $public_id)
    {
        $response = Http::put("{$this->orderService}/api/admin/orders/{$public_id}/status", [
            'status' => $request->status
        ]);
        return response()->json($response->json(), $response->status());
    }
}
