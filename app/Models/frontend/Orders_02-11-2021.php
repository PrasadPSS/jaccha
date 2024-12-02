<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\backend\ProductImages;
use App\Models\frontend\User;
use Illuminate\Support\Facades\DB;

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
      'delivered_stage','shipping_dump','shipping_amount','shipping_full_name','shipping_mobile_no','shipping_alt_mobile_no',
      'shipping_address_line1','shipping_address_line2','shipping_landmark','shipping_city',
      'shipping_pincode','shipping_district','shipping_state','shipping_address_type',
      'default_address_flag','cancel_order_flag','cancel_reason','order_cancellation_reason_id',

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

    public static function getOrdersDeatails($sdate,$edate)
    {
        $orders=DB::table('orders')
            ->join('users','users.id','=','orders.user_id')
            ->select('orders.orders_counter_id','users.name','users.email','orders.total',
                'orders.payment_tracking_code','orders.created_at')
            ->whereBetween('orders.created_at',[$sdate,$edate])
            ->get()->toArray();
        return $orders;
    }
}
