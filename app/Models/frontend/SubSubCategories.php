<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class SubSubCategories extends Model
{
  use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_subcategories';
    protected $primaryKey = 'sub_subcategory_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','sub_subcategory_name', 'sub_subcategory_description','subcategory_id'];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    public function sluggable()
    {
        return [
            'sub_sub_category_slug' => [
                'source' => 'sub_subcategory_name'
            ]
        ];
    }

    public function subcategories()
    {
      return $this->belongsTo(SubCategories::class,'subcategory_id','subcategory_id');
    }
}
