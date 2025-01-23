<?php

namespace App\Models\backend;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Publication extends Model
{
  use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'publications';
     protected $primaryKey = 'publications_id';
     protected $fillable = [
       'publications_title','publications_content', 'publications_top','publications_footer',
       'show_hide','cms_slug','column_type','publications_link','contactus_form_flag','publications_date',
       'publications_sub_title'
     ];

     public function sluggable(): array
     {
         return [
             'publication_slug' => [
                 'source' => 'publications_title'
             ]
         ];
     }

}
