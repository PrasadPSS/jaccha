<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sizes extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sizes';
    protected $primaryKey = 'size_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size_name', 'size_code','size_type','length_in','chest_in',
        'shoulder_in','sleeve_lenght_in','waist_in','neck_in','hip_in',
        'inseam_length_in',

      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
