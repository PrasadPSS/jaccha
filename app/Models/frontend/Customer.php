<?php

namespace App\Models\frontend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'flat_no',
        'building_name',
        'address1',
        'address2',
        'pin_code',
        'shipping_address',
        'billing_address',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * Add a mutator to ensure hashed passwords
     */
    
}
