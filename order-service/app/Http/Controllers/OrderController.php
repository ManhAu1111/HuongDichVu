<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ShippingFeeService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout(CheckoutRequest $request, ShippingFeeService $shippingFeeService)
    {
        $provinceCode = $request->province_code;

        $shippingData = $shippingFeeService->calculate($provinceCode);
        $shippingFee = $shippingData['shipping_fee'];

        // Tính subtotal
        $subtotal = collect($request->items)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $total = $subtotal + $shippingFee;

        // Tạo order
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


        // Tạo order item
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
}
