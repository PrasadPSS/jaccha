<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table='company';
    protected $primaryKey='id';


    protected $fillable=['name','email','mobile_no','pincode','state','country','address','gstno','bankdetail'];


}
