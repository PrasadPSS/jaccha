<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceCounter extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_counter';
    protected $primaryKey = 'invoice_counter_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_counter'];

    //use SoftDeletes;
  //  protected $dates = ['deleted_at'];

}
