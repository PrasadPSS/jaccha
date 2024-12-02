<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilterValues extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'filter_values';
    protected $primaryKey = 'filter_value_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filter_value','filter_id','visibility','product_page_visibility',
        
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
