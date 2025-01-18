<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;

use App\Models\backend\Coupons;

class OrderCoupons extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_coupons';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',  'coupon_code'
      ];



    public function coupon()
    {
      return $this->hasOne(Coupons::class,'coupon_id','coupon_id');
    }
}
