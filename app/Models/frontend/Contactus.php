<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;

    protected $table='contactuss';
    protected $primaryKey='contactus_id';

    protected $fillable=['name','email','mobile_no','order_no','issue','comment'];
}
