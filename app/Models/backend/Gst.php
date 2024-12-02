<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gst extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gst';
    protected $primaryKey = 'gst_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gst_name', 'gst_percent', 'default_gst','gst_min_price',
        'gst_max_price', 'gst_cgst_percent', 'gst_sgst_percent','gst_igst_percent',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

}
