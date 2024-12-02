<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;


class Metamanage extends Model
{
    public $table = 'meta_management';
    protected $primaryKey = 'meta_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_title','meta_desc','meta_keywords','og_title','og_desc',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
