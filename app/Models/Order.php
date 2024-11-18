<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function payment_details()
    {
        return $this->hasOne(PaymentDetail::class, 'id', 'payment_id');
    }

    protected $fillable = [
        'user_id',
        'payment_id',
        'total'
    ];
}
