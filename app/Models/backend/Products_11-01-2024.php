<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_title', 'product_sub_title', 'product_price', 'product_discounted_price', 'product_discount',
        'product_qty', 'product_desc', 'product_material', 'product_fit_type', 'product_pattern',
        'product_neck_type', 'product_sleeve_type', 'product_sleeve_length', 'product_type', 'product_length',
        'product_occasion', 'product_fabric_transparency', 'product_stretch', 'product_closure', 'product_distress',
        'product_waist_rise', 'product_waist_band', 'product_collar', 'product_style', 'product_fade',
        'product_shade', 'product_basic_trend', 'product_suitable_season', 'product_no_of_pkt', 'product_ideal_for',
        'product_set_of', 'product_weight', 'package_length', 'package_width', 'package_height',
        'product_eligible_for_return', 'product_wash_instructions', 'visibility', 'product_generic_name', 'country_id',
        'seller_id', 'manufacturer_id', 'packer_id', 'importer_id', 'category_id',
        'sub_category_id', 'sub_sub_category_id', 'category_slug', 'sub_category_slug', 'sub_sub_category_slug',
        'product_specification', 'product_disclaimer', 'product_sku', 'color_id', 'size_id',
        'meta_title', 'meta_desc', 'meta_keywords', 'og_title', 'og_desc',
        'brand_id', 'size_chart_id', 'new_arrival', 'product_thumb', 'product_discount_type', 'rating', 'product_hsn',
        'product_gst', 'product_delivery_estimate_days', 'hsncode_id', 'popularity',
        'material_id'

    ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    public function sluggable()
    {
        return [
            'product_slug' => [
                'source' => 'product_title'
            ]
        ];
    }

    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'product_id');
    }

    public function country()
    {
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }

    public function seller()
    {
        return $this->hasOne(Sellers::class, 'seller_id', 'seller_id');
    }

    public function packer()
    {
        return $this->hasOne(Packers::class, 'packer_id', 'packer_id');
    }

    public function importer()
    {
        return $this->hasOne(Importers::class, 'importer_id', 'importer_id');
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturers::class, 'manufacturer_id', 'manufacturer_id');
    }

    public function size()
    {
        return $this->hasOne(Sizes::class, 'size_id', 'size_id');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariants::class, 'product_id', 'product_id')->with(['size', 'color']);
    }

    public function color()
    {
        return $this->hasOne(Colors::class, 'color_id', 'color_id');
    }

    public function product_filters()
    {
        return $this->hasMany(ProductFilters::class, 'product_id', 'product_id');
    }

    public function relatedproducts()
    {
        return $this->hasMany(RelatedProducts::class);
    }
    public function brands()
    {
        return $this->hasOne(Brands::class, 'brand_id', 'brand_id');
    }

    public static function getAllProducts()
    {
        $data = DB::table('products')
            ->join('sizes', 'sizes.size_id', '=', 'products.size_id')
            ->select(
                'products.product_title',
                'products.product_sub_title',
                'products.product_price',
                'products.product_discounted_price',
                'products.product_discount',
                'products.product_qty',
                'products.product_type',
                'sizes.size_name'
            )
            ->get()->toArray();
        return $data;
    }
    public function hsncode()
    {
        return $this->hasOne(HSNCodes::class, 'hsncode_id', 'hsncode_id');
    }

    public function variant()
    {
        return $this->hasOne(ProductVariants::class, 'product_variant_id', 'first_variant_id');
    }
    public function variant_size()
    {
        return $this->hasMany(ProductVariants::class, 'product_id', 'product_id');
    }
    public function product_variant_images()
    {
        return $this->hasOne(ProductVariantImages::class, 'product_variant_id', 'product_variant_id');
    }

    public function combined_size()
    {
        return $this->hasMany(ProductVariants::class, 'product_id', 'product_id');
    }
}
