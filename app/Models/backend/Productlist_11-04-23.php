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
        'category_id','sub_category_id','sub_sub_category_id','content_date','contents',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
