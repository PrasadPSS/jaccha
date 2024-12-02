<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FakeOrderManagement extends Model
{
    public $table = 'fake_orders';
    protected $primaryKey = 'fake_order_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','status','count','order_date',
      ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
}
