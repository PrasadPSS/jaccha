<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Products;
use App\Models\backend\ProductImages;
use App\Models\backend\ProductVariants;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'cart';
     protected $primaryKey = 'id';
     protected $fillable = [
       'id','user_id', 'product_id', 'qty', 'price', 'discount',
       'currency', 'referral_id', 'distributor_id','schemes_id',
       'product_type', 'product_variant_id',
     ];


    public function products()
    {
      return $this->hasOne(Products::class,'product_id','product_id')->with(['size','brands']);
    }
    public function product_images()
    {
      return $this->hasMany(ProductImages::class,'product_id','product_id');
    }
    public function product_variant()
    {
      return $this->hasOne(ProductVariants::class,'product_variant_id','product_variant_id')->with(['size','color']);
    }
}
