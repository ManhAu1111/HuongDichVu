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
        $shippingFee = $shippingData['shipping_fee'];

        $subtotal = collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal + $shippingFee;

        $order = Order::create([
            'user_id'        => $request->user_id,
            'public_id'      => uniqid('order_'),
            'total_price'    => $total,
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
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Tạo đơn hàng thành công',
            'order_id' => $order->public_id,
            'shipping_fee' => $shippingFee,
            'total' => $total
        ]);
    }

    // New: create order after payment (MoMo success)
    public function createPaidOrder(Request $request)
    {
        // minimal validation
        $request->validate([
            'user_id' => 'required',
            'items'   => 'required|array|min:1',
            'amount'  => 'required|numeric',
        ]);

        $total = $request->amount; // MoMo đã xác nhận số tiền
        $shippingFee = $request->shipping_fee ?? 0;

        $order = Order::create([
            'user_id'        => $request->user_id,
            'public_id'      => uniqid('order_'),
            'total_price'    => $total,
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
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Tạo đơn (paid) thành công',
            'order_id' => $order->public_id,
            'total' => $total
        ]);
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
        $order = Order::where('public_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated']);
    }

    public function checkoutFromCart(Request $request, ShippingFeeService $shippingFeeService)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'province_code' => 'required|integer',
            'payment_method' => 'required|in:momo,cod',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'nullable|string',
            // 'receiver_email' => 'nullable|email', // nếu cần
            'street_address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $userId = $request->input('user_id');

        // Lấy items từ cart_items
        $cartItems = CartItem::where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart empty'], 400);
        }

        // shipping
        $shippingData = $shippingFeeService->calculate($request->province_code);
        $shippingFee = $shippingData['shipping_fee'] ?? 0;

        // tính subtotal
        $subtotal = $cartItems->sum(function ($it) {
            return $it->price * $it->quantity;
        });
        $total = $subtotal + $shippingFee;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'public_id' => uniqid('order_'),
                'total_price' => $total,
                'status' => 'pending_payment',
                'payment_method' => $request->payment_method,
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_email' => $request->receiver_email,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'province_code' => $request->province_code,
            ]);

            foreach ($cartItems as $ci) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $ci->product_id,
                    'product_name' => $ci->product_name,
                    'price' => $ci->price,
                    'quantity' => $ci->quantity,
                    'subtotal' => $ci->price * $ci->quantity,
                ]);
            }

            // clear cart
            CartItem::where('user_id', $userId)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order created',
                'order_id' => $order->public_id,
                'shipping_fee' => $shippingFee,
                'total' => $total
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('checkoutFromCart error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
