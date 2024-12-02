<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'payment_mode';
     protected $primaryKey = 'payment_mode_id';
    protected $fillable = [
      'payment_mode_name', 'payment_mode_code',
      'status'
    ];

}
