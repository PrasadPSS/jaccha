<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    const PAYMENT_COMPLETED = 1;
    const PAYMENT_INCOMPLETE = 0;
    protected $fillable = [
        'order_id',
        'amount',
        'provider',
        'status'
    ];
}
