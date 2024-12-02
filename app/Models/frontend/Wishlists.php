<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Products;
use App\Models\backend\ProductImages;

class Wishlists extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'wishlists';
     protected $primaryKey = 'wishlist_id';
     protected $fillable = [
       'user_id', 'product_id',
     ];


    public function products()
    {
      return $this->hasOne(Products::class,'product_id','product_id')->with('size');
    }
    public function product_images()
    {
      return $this->hasMany(ProductImages::class,'product_id','product_id');
    }
}
