<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prices extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prices';
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price_name', 'min', 'max',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
