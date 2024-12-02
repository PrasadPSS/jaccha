<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CODManagement extends Model
{
    public $table = 'cod_managements';
    protected $primaryKey = 'cod_management_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status','cod_purchase_min_limit',
        'cod_purchase_max_limit',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
