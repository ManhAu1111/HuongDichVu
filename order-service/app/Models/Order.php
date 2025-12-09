<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'public_id',
        'total_price',
        'status',
        'payment_method',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'street_address',
        'district_name',
        'province_code',
        'shipping_fee',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
