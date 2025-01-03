<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;


    protected $table='districts';
    protected $primaryKey='id';

    protected $fillable=['name','sid', 'state_name'];

}
