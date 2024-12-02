<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productlist extends Model
{
    public $table = 'produt_list';
    protected $primaryKey = 'product_list_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','sub_category_id','sub_sub_category_id','content_date','contents',  'meta_title','meta_desc','meta_keywords','og_title','og_desc',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
