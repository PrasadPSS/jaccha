<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\backend\ProductImages;
use App\Models\frontend\User;

class Orders extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
      'order_id','user_id','gst_percent','discount_percent',
      'gst_value','discounted_value','total','confirmed_stage',
      'preparing_order_stage','shipped_stage','out_for_delivery_stage',
      'delivered_stage','shipping_dump','shipping_amount',
    ];

    //use SoftDeletes;
    //  protected $dates = ['deleted_at'];

    public function orderproducts()
    {
      return $this->hasMany(OrdersProductDetails::class,'order_id','order_id')->with('productthumb');
    }

    // public function productthumb()
    // {
    //   return $this->hasOne(ProductImages::class,'product_id','product_id');
    // }

    public function users()
    {
      return $this->hasOne(User::class,'id','user_id');
    }
}
