<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filters extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'filters';
    protected $primaryKey = 'filter_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filter_name', 'filter_desc','visibility','product_page_visibility','sort_order',
        'filter_type',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    public function filtervalues()
    {
      return $this->hasMany(FilterValues::class,'filter_id','filter_id');
    }
}
