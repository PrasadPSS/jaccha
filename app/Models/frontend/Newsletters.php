<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    use HasFactory;

    protected $table='newsletter';
    protected $primaryKey='id';

    protected $fillable=['email'];
}
