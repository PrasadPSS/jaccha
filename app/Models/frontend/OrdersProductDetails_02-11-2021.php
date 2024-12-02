<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\backend\ProductImages;

class OrdersProductDetails extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders_product_details';
    protected $primaryKey = 'orders_product_details_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
      'orders_product_details_id','product_id', 'qty',
      'product_price','order_id','product_title', 'product_sub_title',
      'product_price', 'product_discounted_price',
      'product_discount', 'product_discount_type','product_color','product_size',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function productthumb()
    {
      return $this->hasOne(ProductImages::class,'product_id','product_id');
    }
}
