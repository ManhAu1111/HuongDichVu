<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Services\ShippingFeeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Existing checkout() — used for COD (keeps current behavior)
    public function checkout(CheckoutRequest $request, ShippingFeeService $shippingFeeService)
    {
        $provinceCode = $request->province_code;
        $shippingData = $shippingFeeService->calculate($provinceCode);

        $shippingFee = $shippingData['shipping_fee'];   // LẤY PHÍ SHIP

        $subtotal = collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal + $shippingFee;

        $order = Order::create([
            'user_id'        => $request->user_id,
            'public_id'      => uniqid('order_'),
            'total_price'    => $total,
            'shipping_fee'   => $shippingFee,
            'status'         => 'pending_payment',
            'payment_method' => $request->payment_method,

            'receiver_name'  => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_email' => $request->receiver_email,

            'street_address' => $request->street_address,
            'district_name'  => $request->district_name,
            'province_code'  => $request->province_code,
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item['product_id'],
                'product_name' => $item['product_name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        if ($request->payment_method === "cod") {

            $order->status = "draft";
            $order->save();

            $this->updatePaymentStatus(new Request([
                'order_id' => $order->public_id,
                'status'   => 'pending_payment'
            ]));

            // CLEAR CART
            CartItem::where('user_id', $request->user_id)->delete();

            return response()->json([
                'message'      => 'Đặt hàng COD thành công',
                'order_id'     => $order->public_id,
                'shipping_fee' => $shippingFee,
                'total'        => $total
            ]);
        }

        return response()->json([
            'message'      => 'Tạo đơn hàng thành công',
            'order_id'     => $order->public_id,
            'shipping_fee' => $shippingFee,
            'total'        => $total
        ]);
    }

    // New: create order after payment (MoMo success)
    public function createPaidOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'items'   => 'required|array|min:1',
            'amount'  => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $total = $request->amount;
            $shippingFee = $request->shipping_fee ?? 0;

            $order = Order::create([
                'user_id'        => $request->user_id,
                'public_id'      => uniqid('order_'),
                'total_price'    => $total,
                'shipping_fee'   => $shippingFee,     // >>> LƯU PHÍ SHIP <<
                'status'         => 'paid',
                'payment_method' => 'momo',

                'receiver_name'  => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_email' => $request->receiver_email,

                'street_address' => $request->street_address,
                'district_name'  => $request->district_name,
                'province_code'  => $request->province_code,
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['price'] * $item['quantity'],
                ]);
            }

            CartItem::where('user_id', $request->user_id)->delete();

            $this->decreaseProductStock($order->id);

            DB::commit();

            return response()->json([
                'message'  => 'Tạo đơn (paid) thành công',
                'order_id' => $order->public_id,
                'total'    => $total
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('createPaidOrder error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function calculateShipping(Request $request, ShippingFeeService $shippingFeeService)
    {
        try {
            $provinceCode = $request->input('province_code');
            $shippingData = $shippingFeeService->calculate($provinceCode);
            return response()->json($shippingData);
        } catch (\Throwable $e) {
            Log::error('calculateShipping error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        // ========================
        // VALIDATE INPUT
        // ========================
        if (!$request->order_id || !$request->status) {
            return response()->json([
                'error' => 'order_id and status are required'
            ], 400);
        }

        // ❌ KHÔNG cho dùng API này để hủy đơn
        if ($request->status === 'cancelled') {
            return response()->json([
                'error' => 'Use /orders/{public_id}/cancel to cancel order'
            ], 400);
        }

        $order = Order::where('public_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Nếu status không đổi thì thôi
        if ($oldStatus === $newStatus) {
            return response()->json([
                'message' => 'Order status unchanged'
            ]);
        }

        DB::beginTransaction();
        try {
            $order->status = $newStatus;
            $order->save();

        // ========================
        // STOCK CONTROL LOGIC
        // ========================

            /**
             * 1) Trừ kho khi chuyển sang:
             *    - pending_payment
             *    - paid
             * Nhưng CHỈ trừ nếu trước đó chưa từng ở 2 trạng thái này
             */
            $shouldDecrease =
                in_array($newStatus, ['pending_payment', 'paid']) &&
                !in_array($oldStatus, ['pending_payment', 'paid']);

            if ($shouldDecrease) {
                $this->decreaseProductStock($order->id);
            }

            /**
             * 2) KHÔNG hoàn kho ở đây
             *    - Hoàn kho CHỈ được phép trong cancelOrder()
             */

            DB::commit();

            return response()->json([
                'message' => 'Order status updated',
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('updatePaymentStatus error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Internal server error'
            ], 500);
        }
    }

    public function checkoutFromCart(Request $request, ShippingFeeService $shippingFeeService)
    {
        $request->validate([
            'user_id'         => 'required|integer',
            'province_code'   => 'required|integer',
            'payment_method'  => 'required|in:momo,cod',
            'receiver_name'   => 'required|string',
            'receiver_phone'  => 'nullable|string',
            'street_address'  => 'nullable|string',
            'district_name'   => 'nullable|string',
        ]);

        $userId = $request->input('user_id');

        // CART ITEMS
        $cartItems = CartItem::where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart empty'], 400);
        }

        // SHIPPING
        $shippingData = $shippingFeeService->calculate($request->province_code);
        $shippingFee = $shippingData['shipping_fee'] ?? 0;

        // SUBTOTAL
        $subtotal = $cartItems->sum(fn($it) => $it->price * $it->quantity);
        $total = $subtotal + $shippingFee;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'        => $userId,
                'public_id'      => uniqid('order_'),
                'total_price'    => $total,
                'shipping_fee'   => $shippingFee,        // >>> LƯU PHÍ SHIP <<
                'status'         => 'pending_payment',
                'payment_method' => $request->payment_method,

                'receiver_name'  => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_email' => $request->receiver_email,
                'street_address' => $request->street_address,
                'district_name'  => $request->district_name,
                'province_code'  => $request->province_code,
            ]);

            foreach ($cartItems as $ci) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $ci->product_id,
                    'product_name' => $ci->product_name,
                    'price'        => $ci->price,
                    'quantity'     => $ci->quantity,
                    'subtotal'     => $ci->price * $ci->quantity,
                ]);
            }

            CartItem::where('user_id', $userId)->delete();

            DB::commit();

            return response()->json([
                'message'      => 'Order created',
                'order_id'     => $order->public_id,
                'shipping_fee' => $shippingFee,
                'total'        => $total
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('checkoutFromCart error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    // Xử lý tồn kho (trừ hàng)
    private function decreaseProductStock($orderId)
    {
        $items = OrderItem::where('order_id', $orderId)->get();

        if ($items->isEmpty()) {
            return;
        }

        $payload = [
            "items" => $items->map(function ($i) {
                return [
                    "product_id" => $i->product_id,
                    "quantity" => $i->quantity
                ];
            })
        ];

        try {
            $client = new \GuzzleHttp\Client();

            $client->post("http://127.0.0.1:8003/api/products/decrease-stock", [
                "json" => $payload,
                "timeout" => 5,
            ]);
        } catch (\Throwable $e) {
            Log::error("Failed to decrease stock: " . $e->getMessage());
        }
    }


    // Xử lý tồn kho (hoàn trả hàng)
    private function restoreProductStock($orderId)
    {
        $items = OrderItem::where('order_id', $orderId)->get();

        if ($items->isEmpty()) return;

        $payload = [
            "items" => $items->map(function ($i) {
                return [
                    "product_id" => $i->product_id,
                    "quantity" => $i->quantity
                ];
            })
        ];

        try {
            $client = new \GuzzleHttp\Client();

            $client->post("http://127.0.0.1:8003/api/products/restore-stock", [
                "json" => $payload,
                "timeout" => 5,
            ]);
        } catch (\Throwable $e) {
            Log::error("Failed to restore stock: " . $e->getMessage());
        }
    }

    // Hủy đơn hàng
    public function cancelOrder(Request $request, $publicId)
    {
        $order = Order::where('public_id', $publicId)->first();

        if (!$order) {
            return response()->json(['ok' => false, 'message' => 'Order not found'], 404);
        }

        // Chỉ cho hủy khi chưa giao
        if (in_array($order->status, ['delivering', 'completed', 'cancelled'])) {
            return response()->json([
                'ok' => false,
                'message' => 'Không thể hủy đơn hàng khi đang giao hoặc đã hoàn thành'
            ], 400);
        }

        $oldStatus = $order->status;

        DB::beginTransaction();
        try {
            $order->status = 'cancelled';
            $order->save();

            // Hoàn kho (chỉ 1 lần)
            if ($oldStatus !== 'cancelled') {
                $this->restoreProductStock($order->id);
            }

            Log::info("Order {$order->public_id} cancelled");

            DB::commit();

            return response()->json([
                'ok' => true,
                'message' => 'Hủy đơn hàng thành công'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('cancelOrder error: ' . $e->getMessage());

            return response()->json([
                'ok' => false,
                'message' => 'Internal server error'
            ], 500);
        }
    }


    // Lấy đơn hàng gần đây của user (dashboard)
    public function getOrdersByUser(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'user_id required'], 400);
        }

        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(10) // chỉ lấy recent orders
            ->get();

        foreach ($orders as $order) {
            $order->items = OrderItem::where('order_id', $order->id)->get();
        }

        return response()->json($orders);
    }

    public function getByOrder(Request $request)
    {
        $orderId = $request->order_id;

        if (!$orderId) {
            return response()->json(['error' => 'order_id required'], 400);
        }

        $items = OrderItem::where('order_id', $orderId)->get();

        return response()->json($items);
    }

    public function getOrderByPublicId($publicId)
    {
        $order = Order::where('public_id', $publicId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    // ============================================
    // ADMIN: Lấy tất cả đơn hàng với filter và tìm kiếm
    public function getAllOrdersForAdmin(Request $request)
    {
        $query = Order::query();

        // 1. Tìm theo tên khách hàng (receiver_name)
        if ($request->filled('customer_name')) {
            $query->where('receiver_name', 'like', '%' . $request->customer_name . '%');
        }

        // 2. Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Lọc theo khoảng ngày (Dựa vào created_at)
        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->date_start);
        }
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->date_end);
        }

        // Lọc theo giá trị tối thiểu
        if ($request->filled('price_min')) {
            $query->where('total_price', '>=', $request->price_min);
        }

        // Lọc theo giá trị tối đa (MỚI)
        if ($request->filled('price_max')) {
            $query->where('total_price', '<=', $request->price_max);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    // Admin cập nhật trạng thái đơn hàng
    public function updateOrderStatus(Request $request, $publicId)
    {
        $request->validate(['status' => 'required|string']);

        $order = Order::where('public_id', $publicId)->first();
        if (!$order) return response()->json(['error' => 'Order not found'], 404);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        DB::beginTransaction();
        try {
            $order->status = $newStatus;
            $order->save();

            // Logic xử lý kho khi Admin hủy đơn (Giao không thành công/Bom hàng)
            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                $this->restoreProductStock($order->id);
            }

            DB::commit();
            return response()->json(['ok' => true, 'message' => 'Status updated']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
