<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
       'show_hide','cms_slug','column_type','publications_link','contactus_form_flag',
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
