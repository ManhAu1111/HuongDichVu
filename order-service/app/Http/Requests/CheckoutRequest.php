<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true; // bắt buộc phải để true
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'province_code' => 'required|integer',
            'payment_method' => 'required|in:momo,cod',
            'shipping_address' => 'required|string',
            'items' => 'required|array|min:1',

            'items.*.product_id' => 'required|integer',
            'items.*.product_name' => 'required|string',
            'items.*.price' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }
}
