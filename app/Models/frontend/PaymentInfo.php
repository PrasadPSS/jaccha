<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'payment_info';
    protected $fillable = ['payment_id','user_id', 'transaction_id','amount','payment_data','status','customer_name','email','data_dump','type','payment_tracking_code','payment_mode','pickup_flag'];


    public static function getPaymentsDeatails($sdate,$edate){
        $payments= DB::table('payment_info')->select('customer_name', 'email', 'transaction_id', 'amount','payment_tracking_code','payment_date')->whereBetween('created_at', [$sdate, $edate])
            ->get()->toArray();
        return $payments;
    }

}
