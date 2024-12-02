<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Products;
use App\Models\backend\ProductImages;

class OrderCancellationReasons extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'order_cancellation_reasons';
     protected $primaryKey = 'order_cancellation_reason_id';
     protected $fillable = [
       'order_cancellation_reason_desc','for_dadreeios'
     ];

}
