<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StateCodes extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'state_codes';
    protected $primaryKey = 'state_code_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_name','state_code',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
