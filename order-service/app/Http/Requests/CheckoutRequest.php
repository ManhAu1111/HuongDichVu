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
            'user_id'         => ['required', 'integer'],
            'payment_method'  => ['required', 'in:momo,cod'],

            // Địa chỉ giao hàng (bắt buộc)
            'receiver_name'   => ['required', 'regex:/^[\p{L}\s]{2,50}$/u'],
            'receiver_phone'  => ['required', 'regex:/^0\d{9}$/'],
            'receiver_email'  => ['required', 'email'],
            'street_address'  => ['required', 'regex:/^[\w\p{L}\s\/\-,.]{5,100}$/u'],

            'province_code'   => ['required', 'integer'],
            'district_name'   => ['required', 'string'],

            // Items
            'items' => ['required', 'array', 'min:1'],

            'items.*.product_id'   => ['required', 'integer'],
            'items.*.product_name' => ['required', 'string'],
            'items.*.price'        => ['required', 'numeric', 'min:0'],
            'items.*.quantity'     => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'receiver_name.required' => 'Họ tên là bắt buộc.',
            'receiver_name.regex'    => 'Họ tên không hợp lệ.',

            'receiver_phone.required' => 'Số điện thoại là bắt buộc.',
            'receiver_phone.regex'    => 'Số điện thoại phải gồm 10 số và bắt đầu bằng 0.',

            'receiver_email.required' => 'Email là bắt buộc.',
            'receiver_email.email'    => 'Email không hợp lệ.',

            'street_address.required' => 'Địa chỉ là bắt buộc.',
            'street_address.regex'    => 'Địa chỉ không hợp lệ.',

            'province_code.required' => 'Vui lòng chọn Tỉnh/Thành.',
            'district_name.required' => 'Vui lòng chọn Quận/Huyện.',

            'items.required' => 'Giỏ hàng đang trống.',
            'items.*.product_id.required' => 'Thiếu product_id.',
            'items.*.product_name.required' => 'Thiếu tên sản phẩm.',
            'items.*.price.required' => 'Thiếu giá sản phẩm.',
            'items.*.quantity.required' => 'Thiếu số lượng sản phẩm.',
        ];
    }

    public function wantsJson()
    {
        return true;
    }
}
