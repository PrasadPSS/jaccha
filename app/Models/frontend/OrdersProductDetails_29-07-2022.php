<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\backend\ProductImages;
use App\Models\backend\Products;
use App\Models\backend\ProductVariants;
use App\Models\backend\ProductVariantImages;

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
      'product_discount', 'product_discount_type','product_color','product_size','product_variant_id',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function productthumb()
    {
      return $this->hasOne(ProductImages::class,'product_id','product_id');
    }
    public function productvariantthumb()
    {
      return $this->hasOne(ProductVariantImages::class,'product_variant_id','product_variant_id');
    }
    public function products()
    {
      return $this->hasOne(Products::class,'product_id','product_id')->with(['size','brands']);
    }
    public function product_variant()
    {
      return $this->hasOne(ProductVariants::class,'product_variant_id','product_variant_id')->with(['size','color']);
    }
}
