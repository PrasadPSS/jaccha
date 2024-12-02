<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedVariantProducts extends Model
{
    use HasFactory;

    protected $table = 'related_variant_products';
    protected $primaryKey = 'id';

    protected $fillable = ['product_variant_id ', 'related_product_list_id'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
