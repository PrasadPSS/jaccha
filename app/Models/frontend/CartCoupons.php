<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\backend\Coupons;

class CartCoupons extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart_coupons';
    protected $primaryKey = 'cart_coupon_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'coupon_id','status'
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    public function coupon()
    {
      return $this->hasOne(Coupons::class,'coupon_id','coupon_id');
    }
}
