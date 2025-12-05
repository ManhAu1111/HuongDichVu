<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'province_code' => 'required|integer',
            'payment_method' => 'required|in:momo,cod',

            // chấp nhận cả trường cũ shipping_address hoặc các trường tách rời
            'shipping_address' => 'nullable|string',
            'street_address'  => 'nullable|string',
            'city'            => 'nullable|string',
            'receiver_name'   => 'nullable|string',
            'receiver_phone'  => 'nullable|string',
            'receiver_email'  => 'nullable|email',

            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|integer',
            'items.*.product_name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'Phải có ít nhất 1 sản phẩm.',
            'items.*.product_name.required' => 'Tên sản phẩm bị thiếu trong items.',
            // ... bạn có thể thêm message rõ hơn
        ];
    }

    public function wantsJson()
    {
        return true;
    }
}