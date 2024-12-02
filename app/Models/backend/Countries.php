<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
