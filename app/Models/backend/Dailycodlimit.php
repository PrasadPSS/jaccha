<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;


class Dailycodlimit extends Model
{
    public $table = 'daily_cod_limit';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status','count',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
