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
        $newStatus = $request->status;

        // 1. LẤY CHI TIẾT ĐƠN HÀNG (để biết có những sản phẩm nào)
        $orderData = Http::get("{$this->orderService}/api/orders/{$public_id}")->json();
        if (!$orderData || isset($orderData['error'])) {
            return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
        }

        // Nếu Admin nhấn "Duyệt đơn" (chuyển sang Delivering)
        if ($newStatus === 'delivering') {
            // Lấy danh sách món hàng
            $items = Http::get("{$this->orderService}/api/order-items", ['order_id' => $orderData['id']])->json();

            // Chuẩn bị dữ liệu gửi sang Product Service
            $payload = [
                'items' => collect($items)->map(fn($i) => [
                    'product_id' => $i['product_id'],
                    'quantity' => $i['quantity']
                ])->toArray()
            ];

            // 2. GỌI PRODUCT SERVICE ĐỂ KIỂM TRA VÀ TRỪ KHO (Tận dụng API đã có)
            // Lưu ý: Hàm decreaseStock bên Product Service của bạn đã có logic kiểm tra đủ hàng mới trừ
            $productServiceUrl = 'http://127.0.0.1:8003';
            $stockRes = Http::post("{$productServiceUrl}/api/products/decrease-stock", $payload);

            if (!$stockRes->successful() || isset($stockRes->json()['error'])) {
                return response()->json([
                    'error' => 'Kho hàng không đủ: ' . ($stockRes->json()['error'] ?? 'Lỗi không xác định')
                ], 400);
            }
        }

        // 3. GỌI ORDER SERVICE ĐỂ CẬP NHẬT TRẠNG THÁI CUỐI CÙNG
        $response = Http::put("{$this->orderService}/api/admin/orders/{$public_id}/status", [
            'status' => $newStatus
        ]);

        return response()->json($response->json(), $response->status());
    }
}
