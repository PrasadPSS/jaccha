<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Filters extends Model
{
  use Sluggable;

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
        'filter_type','category_id','sub_category_id','sub_sub_category_id',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    public function sluggable()
    {
        return [
            'filter_slug' => [
                'source' => 'filter_name',
                'onUpdate'=>true
            ]
        ];
    }

    public function filtervalues()
    {
      return $this->hasMany(FilterValues::class,'filter_id','filter_id');
    }
}
