<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $table='suggestion';
    protected $primaryKey='id';

    protected $fillable=['user_id','message'];
}
