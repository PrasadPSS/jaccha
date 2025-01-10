<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Products;
use App\Models\backend\ProductImages;
use App\Models\backend\ProductVariants;

class Logo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'logo';
     protected $primaryKey = 'id';
     protected $fillable = ['logo_path'];

     public $timestamps = false;


}
