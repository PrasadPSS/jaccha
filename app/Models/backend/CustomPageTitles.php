<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomPageTitles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'custom_page_titles';
    protected $primaryKey = 'custom_page_title_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'custom_page_title_name','custom_page_title_code'
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    

    public function questions()
    {
      return $this->hasMany(FaQuestions::class,'custom_page_title_id','custom_page_title_id');
    }
}
