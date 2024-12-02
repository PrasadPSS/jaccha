<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{

    protected $table = 'banks';
    protected $primaryKey = 'bank_id';
    protected $fillable = [
        'bank_id','user_id','customer_name','account_number',
        'bank_ifsc_code','branch_name','account_type','bank_name'//'order_id',//'Re_enter_account_number',
    ];

}
