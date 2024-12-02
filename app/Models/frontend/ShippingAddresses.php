<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Products;
use App\Models\backend\ProductImages;

class ShippingAddresses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'shipping_addresses';
     protected $primaryKey = 'shipping_address_id';
     protected $fillable = [
       'user_id', 'shipping_full_name','shipping_mobile_no','shipping_alt_mobile_no',
       'shipping_address_line1','shipping_address_line2','shipping_landmark','shipping_city',
       'shipping_pincode','shipping_district','shipping_state','shipping_address_type',
       'default_address_flag','shipping_email',
     ];



}
