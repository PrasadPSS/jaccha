<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table='company';
    protected $primaryKey='id';


    protected $fillable=[
      'name','email','mobile_no','pincode','state','country',
      'timings','gstno','bankdetail','address_line1',
      'address_line2','landmark','city','district','facebook', 'instagram', 'copyright'
    ];


}
