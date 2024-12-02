<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProductImages;
use App\Models\backend\RecentlyViewed;
use App\Models\backend\RelatedProducts;
use App\Models\frontend\Review;
use Illuminate\Http\Request;
use App\Models\backend\Products;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubSubCategories;
use App\Models\backend\Filters;
use App\Models\backend\FilterValues;
use App\Models\backend\ProductFilters;
use App\Models\backend\Sizes;
use App\Models\backend\Colors;
use App\Models\backend\SizeCharts;
use App\Models\backend\SizeChartTypes;
use App\Models\backend\ProductVariants;
use App\Models\backend\ProductVariantImages;
use App\Models\backend\AssignCategoryFilters;
use Illuminate\Support\Facades\DB;
use App\Models\backend\Coupons;
use App\Models\backend\CODManagement;
use App\Models\backend\OrderDeliveryManagement;
use App\Models\backend\FeaturedProducts;
use Illuminate\Support\Facades\Route;
use App\Models\backend\CustomPageTitles;
use App\Models\backend\Productlist;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    public function index()
    {
        // echo "string";exit;
        return view('index');
    }

    public function productlistlevelfirst(Request $request, $category_slug = null, $sort_order = null)
    {
        $sub_category_slug = null;
        $sub_sub_category_slug = null;

        return $this->productlist($request, $category_slug, $sub_category_slug, $sub_sub_category_slug, $sort_order);
    }
    public function productlistlevelsecond(Request $request, $category_slug = null, $sub_category_slug = null, $sort_order = null)
    {
        $sub_sub_category_slug = null;

        return $this->productlist($request, $category_slug, $sub_category_slug, $sub_sub_category_slug, $sort_order);
    }
    public function search(Request $request, $search_query, $sort_order = null, $category_slug = null, $sub_category_slug = null)
    {
        $sub_sub_category_slug = null;
        // dd($sort_order);
        return $this->productlist($request, $category_slug, $sub_category_slug, $sub_sub_category_slug, $sort_order, $search_query);
    }
    // public function productlist(Request $request,$category_slug=null,$sub_category_slug=null,$sub_sub_category_slug=null,$sort_order=null)
    // {
    //   $sort_by_options = [
    //     'recommended'=> 'Recommended',
    //     'new-arrivals'=> 'New Arrivals',
    //     'popularity'=> 'Popularity',
    //     'highest-discount'=> 'Highest Discount',
    //     'low-to-high'=> 'Price: Low to High',
    //     'high-to-low'=> 'Price: High to Low',
    //   ];
    //   $search = '';
    //   $search_flag = false;
    //   if ($sort_order==''||$sort_order==null)
    //   {
    //     $sort_order='recommended';
    //   }
    //   // echo "string";exit;
    //   $categories = Categories::where('category_slug',$category_slug)->first();
    //   $sub_categories = SubCategories::where('sub_category_slug',$sub_category_slug)->first();
    //   $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug',$sub_sub_category_slug)->first();
    //   // $products = Products::where('category_id',$categories->category_id)->where('sub_category_id',$sub_categories->subcategory_id)->where('sub_sub_category_id',$sub_sub_categories->sub_subcategory_id)->get();
    //   // $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug',$sub_sub_category_slug)->first();
    //   $filter_values_ids = [];
    //   if (isset($request) && count($request->all())>0)
    //   {
    //     $filter_check = [];
    //     $filter_check_str = array_values($request->all());
    //     foreach ($filter_check_str as $filter_slug_value)
    //     {
    //       $filter_check = array_merge($filter_check,explode(',',$filter_slug_value));
    //     }
    //     $filter_values = FilterValues::whereIn('filter_value_slug',$filter_check)->get();
    //     $filter_values_ids = $filter_values->pluck('filter_value_id')->toArray();
    //     $product_filters = ProductFilters::whereIn('filter_value_id',$filter_values_ids)->get();
    //     $product_ids = $product_filters->pluck('product_id')->toArray();
    //     // dd($filter_check);

    //   }
    //   if (isset($product_ids) && count($product_ids)>0)
    //   {
    //     $products = Products::where('category_slug',$category_slug)
    //                 // ->where('sub_category_slug',$sub_category_slug)
    //                 // ->where('sub_sub_category_slug',$sub_sub_category_slug)
    //                 ->whereIn('product_id',$product_ids);
    //                 // ->with('product_images','size','product_variants','brands');
    //                 // ->paginate(4);
    //   }
    //   else
    //   {
    //     $products = Products::where('category_slug',$category_slug);
    //                 // ->where('sub_category_slug',$sub_category_slug)
    //                 // ->where('sub_sub_category_slug',$sub_sub_category_slug)
    //                 // ->with('product_images','size','product_variants','brands');
    //                 // ->paginate(4);
    //   }

    //   $breadcrumb = '';
    //   if ($sub_sub_category_slug)
    //   {
    //     $category_name = ucwords(strtolower($categories->category_name));
    //     $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
    //     $sub_subcategory_name = ucwords(strtolower($sub_sub_categories->sub_subcategory_name));
    //     $breadcrumb .= '
    //       <li class="breadcrumb-item overview-list-subhead"><a href="'.url("/").'">'.$category_name.'</a></li>
    //       <li class="breadcrumb-item overview-list-subhead"><a href="'.url("/").'">'.$subcategory_name.'</a></li>
    //       <li class="breadcrumb-item active" aria-current="page">'.$sub_subcategory_name.'</li>
    //     ';
    //     $search = $sub_subcategory_name;
    //     $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$sub_sub_categories->category_id,'sub_category_id'=>$sub_sub_categories->subcategory_id,'sub_sub_category_id'=>$sub_sub_categories->sub_subcategory_id,'filter_level'=>"third"])->first();
    //     $products = $products->where('sub_category_slug',$sub_category_slug)
    //                 ->where('sub_sub_category_slug',$sub_sub_category_slug);
    //     $filter_level = "third";
    //   }
    //   else if ($sub_category_slug)
    //   {
    //     $category_name = ucwords(strtolower($categories->category_name));
    //     $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
    //     $breadcrumb .= '
    //       <li class="breadcrumb-item overview-list-subhead"><a href="'.url("/").'">'.$category_name.'</a></li>
    //       <li class="breadcrumb-item active" aria-current="page">'.$subcategory_name.'</li>
    //     ';
    //     $search = $subcategory_name;
    //     $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$sub_categories->category_id,'sub_category_id'=>$sub_categories->subcategory_id,'filter_level'=>"second"])->first();
    //     $products = $products->where('sub_category_slug',$sub_category_slug);
    //     $filter_level = "second";
    //   }
    //   else if ($category_slug)
    //   {
    //     $category_name = ucwords(strtolower($categories->category_name));
    //     $breadcrumb .= '
    //       <li class="breadcrumb-item active" aria-current="page">'.$category_name.'</li>
    //     ';
    //     $search = $category_name;
    //     $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$categories->category_id,'filter_level'=>"first"])->first();
    //     $filter_level = "first";
    //   }

    //   if ($sort_order == 'new-arrivals')
    //   {
    //     $products->where('new_arrival',1);
    //   }
    //   else if ($sort_order == 'recommended')
    //   {
    //     // $products->where('new_arrival',1);
    //   }
    //   else if ($sort_order == 'popularity')
    //   {
    //     // $products->where('new_arrival',1);
    //   }
    //   else if ($sort_order == 'highest-discount')
    //   {
    //     $products->orderBy('product_discounted_amount','ASC');
    //   }
    //   else if ($sort_order == 'low-to-high')
    //   {
    //     $products->orderBy('product_discounted_price','ASC');
    //   }
    //   else if ($sort_order == 'high-to-low')
    //   {
    //     $products->orderBy('product_discounted_price','DESC');
    //   }

    //   $product_count = 0;
    //   if (isset($products))
    //   {
    //     $products = $products->with('product_images','size','product_variants','brands');
    //     $products = $products->paginate(40);
    //     $product_count = $products->count();
    //   }
    //   else
    //   {
    //     $products = [];
    //   }
    //   $search .= '<span class="product-count"> ('.$product_count.')</span>';
    //   // dd($products);

    //   // dd($filters);


    //   $filter_value_ids = [];
    //   $filter_ids = [];
    //   if ($assign_category_filters)
    //   {
    //     $filter_value_ids = explode(',',$assign_category_filters->filter_value_ids);
    //     $filter_ids = explode(',',$assign_category_filters->filter_ids);
    //   }
    //   $filters = Filters::with(['filtervalues'=>function($query)use($filter_value_ids)
    //   {
    //     $query->whereIn('filter_value_id',$filter_value_ids);
    //   }])->whereIn('filter_id',$filter_ids)->where('visibility',1)->orderBy('sort_order','ASC')->get();
    //   $size_list = Sizes::all();
    //   $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
    //     return [$item['size_id'] => $item['size_name']];
    //   });
    //   return view('frontend.product.viewlist',compact('products','filters','size_list',
    //   'category_slug','sub_category_slug','sub_sub_category_slug','sort_order','sort_by_options',
    //   'filter_values_ids','search','search_flag','breadcrumb'));
    // }
    public function productlist(Request $request, $category_slug = null, $sub_category_slug = null, $sub_sub_category_slug = null, $sort_order = null, $search_query = null)
    {

        $sort_by_options = [
            'recommended' => 'Recommended',
            'new-arrivals' => 'New Arrivals',
            'popularity' => 'Popularity',
            'highest-discount' => 'Highest Discount',
            'low-to-high' => 'Price: Low to High',
            'high-to-low' => 'Price: High to Low',
        ];
        // dd($sort_order);
        // dd($request->all());
        $assign_category_filters = [];
        $product_listing_title = '';
        $product_list = '';
        $search = '';
        $search_flag = false;
        $filter_check = [];
        // $request_string = null;
        /************************************************ to get first variant id of product */
        $firstVariants = DB::table('product_variants')
            ->select('product_id', 'product_variant_id', 'color_id', DB::raw('MIN(product_variant_id) as first_variant_id'))
            ->whereNotNull('color_id')
            ->groupBy('product_id', 'color_id');
        /************************************************ */
        if ($sort_order == '' || $sort_order == null) {
            $sort_order = 'recommended';
        }
        // echo "string";exit;

        $categories = Categories::where('category_slug', $category_slug)->first();
        $sub_categories = SubCategories::where('sub_category_slug', $sub_category_slug)->first();
        $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug', $sub_sub_category_slug)->first();
        // $products = Products::where('category_id',$categories->category_id)->where('sub_category_id',$sub_categories->subcategory_id)->where('sub_sub_category_id',$sub_sub_categories->sub_subcategory_id)->get();
        // $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug',$sub_sub_category_slug)->first();
        $filter_values_ids = [];
        // dd($request->all());
        $product_id = [];
        $price_filer_ids = [];
        if (isset($request) && count($request->all()) > 0) {
            $request_string = $request->all();
            // dd($request_string['color-2'], $request_string['price-2']);
            if (isset($request_string['gender'])) {
                unset($request_string['gender']);
            }
            if (isset($request_string['price-2'])) {
                $price_slugs = explode(',', $request_string['price-2']);
                //seperate price filter ids from
                $price_filter_values = FilterValues::whereIn('filter_value_slug', $price_slugs)->where('filter_type', 'price')->get();
                $price_filer_ids = $price_filter_values->pluck('filter_value_id')->toArray();
                unset($request_string['price-2']);
            }
            if (isset($request_string['size-2'])) {
                $size_slugs = explode(',', $request_string['size-2']);
                //seperate size filter ids from
                $size_filter_values = FilterValues::whereIn('filter_value_slug', $size_slugs)->where('filter_type', 'size')->get();
                $size_filter_ids = $size_filter_values->pluck('filter_value_id')->toArray();
                // unset($request_string['size-2']);
            }
            if (isset($request_string['color-2'])) {
                $color_slugs = explode(',', $request_string['color-2']);

                //seperate color filter ids from
                $color_filter_values = FilterValues::whereIn('filter_value_slug', $color_slugs)->where('filter_type', 'color')->get();
                $color_filter_ids = $color_filter_values->pluck('filter_value_id')->toArray();
                // unset($request_string['color-2']);
            }
            if (isset($request_string['discount-range-2'])) {
                $discount_slugs = explode(',', $request_string['discount-range-2']);
                //seperate discount filter ids from
                $discount_filter_values = FilterValues::whereIn('filter_value_slug', $discount_slugs)->where('filter_type', 'discount')->get();
                $discount_filter_ids = $discount_filter_values->pluck('filter_value_id')->toArray();
                unset($request_string['discount-range-2']);
            }
            if (isset($request_string['ratings'])) {
                $ratings_slugs = explode(',', $request_string['ratings']);
                //seperate ratings filter ids from
                $ratings_filter_values = FilterValues::whereIn('filter_value_slug', $ratings_slugs)->where('filter_type', 'ratings')->get();
                $ratings_filter_ids = $ratings_filter_values->pluck('filter_value_id')->toArray();
                unset($request_string['ratings']);
            }

            $filter_check_str = array_values($request_string);
            // dd($price_filer_ids);

            foreach ($filter_check_str as $filter_slug_value) {
                $filter_check = array_merge($filter_check, explode(',', $filter_slug_value));
            }
            $filter_values = FilterValues::whereIn('filter_value_slug', $filter_check)->get();
            $filter_values_ids = $filter_values->pluck('filter_value_id')->toArray();
            $product_filters = ProductFilters::whereIn('filter_value_id', $filter_values_ids)->get();
            $product_ids = $product_filters->pluck('product_id')->toArray();
            // dd($filter_values);
        }
        if (isset($request->q) && $request->q != '') {
            $search_query = $request->q;
            $search_flag = true;
            $search .= $search_query;
            if (!isset($products)) {
                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])

                    ->leftJoin('categories', 'categories.category_id', '=', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.subcategory_id', '=', 'products.sub_category_id')
                    ->leftJoin('sub_subcategories', 'sub_subcategories.sub_subcategory_id', '=', 'products.sub_sub_category_id')
                    ->leftJoin('brands', 'brands.brand_id', '=', 'products.brand_id');


                // dd($products->get());
            } else {
                // dd($products);
                $products = $products->select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])

                    ->leftJoin('categories', 'categories.category_id', '=', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.subcategory_id', '=', 'products.sub_category_id')
                    ->leftJoin('sub_subcategories', 'sub_subcategories.sub_subcategory_id', '=', 'products.sub_sub_category_id')
                    ->leftJoin('brands', 'brands.brand_id', '=', 'products.brand_id');
            }

            if (isset($request->gender) && $request->gender != '') {
                $products = $products->Where('products.category_id', $request->gender);
                $assign_category_filters = AssignCategoryFilters::where(['category_id' => $request->gender, 'filter_level' => 'first'])->first();
            }
            $products = $products->when($search_query, function ($query, $search_query) {

                // return $query->where('products.product_title', 'LIKE', '%'.$search_query.'%')
                //                 ->orWhere('categories.category_name', 'LIKE', '%'.$search_query.'%')
                //                 ->orWhere('subcategories.subcategory_name', 'LIKE', '%'.$search_query.'%')
                //                 ->orWhere('sub_subcategories.sub_subcategory_name', 'LIKE', '%'.$search_query.'%')
                //                 ->orWhere('brands.brand_name', 'LIKE', '%'.$search_query.'%');
                return $query->whereRaw('(products.product_title LIKE "%' . $search_query . '%" OR categories.category_name LIKE "%'
                    . $search_query . '%" OR subcategories.subcategory_name LIKE "%' . $search_query
                    . '%" OR sub_subcategories.sub_subcategory_name LIKE "%' . $search_query . '%" OR brands.brand_name LIKE "%'
                    . $search_query . '%")');
            });

            // dd($products->get());
            if (isset($request->gender) && $request->gender != '') {
                $products = $products->Where('products.category_id', $request->gender);
            }
        }

        if (!isset($products)) {

            if (isset($product_ids) && count($product_ids) > 0) {
                $products = Products::whereIn('product_id', $product_ids);
            } else if (isset($filter_check) && count($filter_check) > 0 && (isset($product_ids) && count($product_ids) <= 0) && (isset($size_filter_ids) && count($size_filter_ids) <= 0)) {
                $products = Products::where('product_id', 0);
                // dd($products);
            } else {
                // dd("");
                // $products = Products::where('category_slug', $category_slug);
                // dd($p);
                // $products = Products::select('products.product_id', 'products.product_title', 'products.product_type', 'product_variants.*', 'sizes.size_name')
                //     ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.product_id')
                //     ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.size_id')
                //     ->where(function ($query) {
                //         $query->where('products.product_type', '=', 'simple')
                //             ->orWhere(function ($query) {
                //                 $query->where('products.product_type', '=', 'configurable')
                //                     ->whereHas('product_variants'); // Use the relationship name
                //             });
                //     })->where('products.category_slug', $category_slug);

                // $products = Products::select('products.*', 'product_variants.*')
                //     ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.product_id')
                //     ->where(function ($query) {
                //         $query->where('products.product_type', '=', 'simple');
                //     })
                //     ->where('products.category_slug', $category_slug)->get();
                /********************************************************* */
                // $firstVariants = DB::table('product_variants')
                //     ->select('product_id', 'product_variant_id', 'color_id', DB::raw('MIN(product_variant_id) as first_variant_id'))
                //     ->whereNotNull('color_id')
                //     ->groupBy('product_id', 'color_id');

                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])
                    ->where('products.category_slug', $category_slug);

                // ->orderBy('product_variants.first_variant_id', 'asc')
                // ->orderBy('products.product_id', 'desc')
                // ->get();
                //*********************************************************** */
                // $products = Products::select('products.*', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                //     ->leftJoin('product_variants', function ($join) {
                //         $join->on('products.product_id', '=', 'product_variants.product_id')
                //             ->where(function ($query) {
                //                 $query->whereNotNull('product_variants.color_id')
                //                     ->orWhereNull('product_variants.product_id');
                //             })
                //             ->where('product_variants.product_variant_id', '=', function ($query) {
                //                 $query->select('product_variant_id')
                //                     ->from('product_variants')
                //                     ->whereColumn('products.product_id', 'product_variants.product_id')
                //                     ->orderBy('product_variant_id', 'asc')
                //                     ->limit(1);
                //             });
                //     })
                //     ->groupBy('products.product_id')
                //     ->with(['variant'])
                //     ->with(['variant_size'])
                //     ->with(['combined_size'])
                //     ->where('products.category_slug', $category_slug)
                //     ->get();



                // dd($products[0]);

                // ---------------------------------

                // $products = Products::select('products.*', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                //     ->leftJoin('product_variants', function ($join) {
                //         $join->on('products.product_id', '=', 'product_variants.product_id')
                //             ->whereNotNull('product_variants.color_id')
                //             ->orderBy('product_variants.product_variant_id', 'desc');
                //     })
                //     ->groupBy('products.product_id', 'product_variants.color_id')
                //     ->with(['variant'])
                //     ->with(['variant_size'])
                //     ->with(['combined_size'])
                //     ->where('products.category_slug', $category_slug)

                //     ->get();
                // dd($products[147]);
                // -------------------------------------

                // $products = Products::select('products.*', 'product_variants.color_id')
                //     ->leftJoin('product_variants', function ($join) {
                //         $join->on('products.product_id', '=', 'product_variants.product_id')
                //             ->whereNotNull('product_variants.color_id'); // Ensures only variant products are considered
                //     })
                //     ->with(['variant' => function ($query) {
                //         $query->select('product_variants.product_id',  'product_variants.size_id')
                //             ->groupBy('product_variants.color_id'); // Group by color to get unique colors
                //     }])
                //     ->where('products.category_slug', $category_slug)
                //     ->groupBy('products.product_id');

                // dd($products[5]);
                // $products = Products::select(
                //     'products.product_id',
                //     'products.product_type',
                //     'products.product_title',
                //     'products.category_slug AS category_slug',
                //     'products.sub_category_slug',
                //     'products.sub_sub_category_slug',
                //     'products.product_slug',
                //     'products.product_thumb',
                //     'products.product_price',
                //     'products.product_discounted_price',
                //     'products.product_discount',
                //     'products.product_discount_type',
                //     'products.size_id',
                //     'products.product_thumb',
                //     'product_variants.product_id',
                //     'product_variants.product_type',
                //     'product_variants.product_title',
                //     'product_variants.product_thumb',
                //     'product_variants.product_price',
                //     'product_variants.product_discounted_price',
                //     'product_variants.product_discount',
                //     'product_variants.size_id',
                //     'product_variants.product_thumb',

                // )
                //     ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.product_id')
                //     ->where('products.category_slug', $category_slug);
                // dd($p, $products);

                // $products = DB::table('products')
                //     ->leftJoin('product_variants', 'products.product_id', '=', 'product_variants.product_id')
                //     ->select('products.*', 'product_variants.product_title')
                //     ->where('products.product_type', '=', 'simple') // You can add more conditions as needed
                //     ->orWhere('products.product_type', '=', 'configurable') // You can add more conditions as needed
                //     ->orderBy('products.created_at', 'desc') // You can change the ordering as needed
                //     ->get();
                // $products = Products::with('product_variants')
                // ->where('condition', 'value') // Example condition
                // ->whereRaw('raw SQL condition') // Example raw condition
                // ->orderBy('column', 'asc') // Example order by
                // ->where('products.category_slug', $category_slug);
                // ->get();

                // $simpleProducts = Products::select('products.product_id', 'products.product_title', 'products.product_type', 'sizes.size_name')
                //     ->leftJoin('sizes', 'products.size_id', '=', 'sizes.size_id')
                //     ->where('products.product_type', '=', 'simple');

                // $configurableProducts = Products::select('products.product_id', 'products.product_title', 'products.product_type', 'product_variants.*', 'sizes.size_name')
                //     ->join('product_variants', 'product_variants.product_id', '=', 'products.product_id')
                //     ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.size_id')
                //     ->where('products.product_type', '=', 'configurable');

                // $products = $simpleProducts->union($configurableProducts)->orderBy('product_id', 'desc')->get();


                // $simpleProducts = Products::select('products.product_id', 'products.product_title', 'products.product_type', 'sizes.size_name')
                //     ->leftJoin('sizes', 'products.size_id', '=', 'sizes.size_id')
                //     ->where('products.product_type', '=', 'simple')
                //     // ->orderBy('product_id', 'desc')
                //     ->toSql();

                // $configurableProducts = Products::select('products.product_id', 'products.product_title', 'products.product_type', 'product_variants.*', 'sizes.size_name')
                //     ->join('product_variants', 'product_variants.product_id', '=', 'products.product_id')
                //     ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.size_id')
                //     ->where('products.product_type', '=', 'configurable')
                //     // ->orderBy('products.product_id', 'desc')
                //     ->toSql();

                // $products = $simpleProducts->merge($configurableProducts);
                // $products = $simpleProducts->concat($configurableProducts);
                // $products = $products->toBase();
                // $products = "
                //     SELECT *
                //     FROM (
                //         $simpleProducts
                //         UNION
                //         $configurableProducts
                //     ) AS subquery
                //     WHERE some_column = :some_value
                // ";
                // $products = (new Collection($simpleProducts))->concat($configurableProducts);

                // You can now use $result as your combined result set


                // dd($products);

            }
        } else {

            // dd($product_ids);
            // dd($filter_check);
            // dd($products->get());
            if (isset($product_ids) && count($product_ids) > 0) {
                $products = $products->whereIn('products.product_id', $product_ids);
            } else if (isset($filter_check) && count($filter_check) > 0 && isset($product_ids) && count($product_ids) <= 0) {
                $products = $products->where('products.product_id', 0); //->where('products.category_slug',$category_slug)
                // dd($filter_check);
            }
        }

        if (isset($products)) {
            // dd($products->get());

            $products = $products->where('products.visibility', 1);
        }
        // dd($products[5]);
        // dd($request->gender);


        $breadcrumb = '';

        $filter_level = "third";

        if ($sub_sub_category_slug) {
            $category_name = ucwords(strtolower($categories->category_name));
            $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
            $sub_subcategory_name = ucwords(strtolower($sub_sub_categories->sub_subcategory_name));
            $breadcrumb .= '
          <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/") . '">' . $category_name . '</a></li>
          <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/") . '">' . $subcategory_name . '</a></li>
          <li class="breadcrumb-item active" aria-current="page">' . $sub_subcategory_name . '</li>';
            $search = $sub_subcategory_name;
            $sub_subcategory_description = (isset($sub_categories->sub_subcategory_description) && $sub_categories->sub_subcategory_description != "") ? $sub_categories->sub_subcategory_description : '';
            $custom_page_title = CustomPageTitles::where('custom_page_title_code', 'list3')->first();
            $page_title = "";
            if (isset($custom_page_title->custom_page_title_name) && $custom_page_title->custom_page_title_name != "") {
                $page_title = $custom_page_title->custom_page_title_name;
                $page_title = str_replace("{#category}", $category_name, $page_title);
                $page_title = str_replace("{#subcategory}", $subcategory_name, $page_title);
                $page_title = str_replace("{#childcategory}", $sub_subcategory_name, $page_title);
                $page_title = str_replace("{#childcategorydescription}", $sub_subcategory_description, $page_title);
                $product_listing_title = $page_title;
            } else {
                $product_listing_title = "Buy " . $sub_subcategory_name . " for " . $category_name . " Online";
            }

            $filter_level = "third";
            $assign_category_filters = AssignCategoryFilters::where(['category_id' => $sub_sub_categories->category_id, 'sub_category_id' => $sub_sub_categories->subcategory_id, 'sub_sub_category_id' => $sub_sub_categories->sub_subcategory_id, 'filter_level' => $filter_level])->first();

            $products = $products->where('products.sub_category_slug', $sub_category_slug)
                ->where('products.sub_sub_category_slug', $sub_sub_category_slug);
        } else if ($sub_category_slug) {
            $filter_level = "second";
            $category_name = ucwords(strtolower($categories->category_name));
            $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
            $breadcrumb .= '
          <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/") . '">' . $category_name . '</a></li>
          <li class="breadcrumb-item active" aria-current="page">' . $subcategory_name . '</li>';
            $search = $subcategory_name;
            $subcategory_description = (isset($sub_categories->subcategory_description) && $sub_categories->subcategory_description != "") ? $sub_categories->subcategory_description : '';
            $custom_page_title = CustomPageTitles::where('custom_page_title_code', 'list2')->first();
            $page_title = "";
            if (isset($custom_page_title->custom_page_title_name) && $custom_page_title->custom_page_title_name != "") {
                $page_title = $custom_page_title->custom_page_title_name;
                $page_title = str_replace("{#category}", $category_name, $page_title);
                $page_title = str_replace("{#subcategory}", $subcategory_name, $page_title);
                $page_title = str_replace("{#subcategorydescription}", $subcategory_description, $page_title);
                $product_listing_title = $page_title;
            } else {

                $product_listing_title = $subcategory_description . " - Buy " . $subcategory_name . " for " . $category_name . " at the best price";
            }


            $assign_category_filters = AssignCategoryFilters::where(['category_id' => $sub_categories->category_id, 'sub_category_id' => $sub_categories->subcategory_id, 'filter_level' => $filter_level])->first();

            $products = $products->where('products.sub_category_slug', $sub_category_slug);
        } else if ($category_slug) {

            $filter_level = "first";
            $category_name = ucwords(strtolower($categories->category_name));
            $breadcrumb .= '
          <li class="breadcrumb-item active" aria-current="page">' . $category_name . '</li>';
            $search = $category_name;
            $category_description = (isset($categories->category_description) && $categories->category_description != "") ? $categories->category_description : '';
            $custom_page_title = CustomPageTitles::where('custom_page_title_code', 'list1')->first();
            $page_title = "";
            if (isset($custom_page_title->custom_page_title_name) && $custom_page_title->custom_page_title_name != "") {
                $page_title = $custom_page_title->custom_page_title_name;
                $page_title = str_replace("{#category}", $category_name, $page_title);
                $page_title = str_replace("{#categorydescription}", $category_description, $page_title);
                $product_listing_title = $page_title;
            } else {

                $product_listing_title = $category_description . " - Shop " . $category_name . " Clothing Online in India";
            }


            $assign_category_filters = AssignCategoryFilters::where(['category_id' => $categories->category_id, 'filter_level' => $filter_level])->first();

            $products = $products->where('products.category_slug', $category_slug);
        }

        if (isset($price_filer_ids) && count($price_filer_ids) > 0) {

            $price_between = '';
            foreach ($price_filter_values as $price_filter_value) {
                if ($price_between != '') {
                    $price_between .= ' OR ';
                } else {
                    if (isset($price_filter_value->filter_min_value) && isset($price_filter_value->filter_max_value)) {
                        $price_between = '(';
                    }
                }
                if (isset($price_filter_value->filter_min_value) && isset($price_filter_value->filter_max_value)) {
                    $price_between .= 'products.product_discounted_price between ' . $price_filter_value->filter_min_value . ' and ' . $price_filter_value->filter_max_value;
                }
            }
            if ($price_between != '') {
                $price_between .= ')';
            }
            $products = $products->whereRaw($price_between);
        } else {
            // dd($products->get());

            $price_array = [125, 32000];
            $price_array_between = 'products.product_discounted_price between ' . $price_array[0] . ' and ' . $price_array[1];
            // dd("");
            $products = $products->whereRaw($price_array_between);
        }
        //filtering products based on size
        // dd($size_filter_ids
        // if(isset($size_filter_ids) && count($size_filter_ids)>0)
        // {
        //   $ex_size_ids = $size_filter_values->pluck('reference_id')->toArray();
        //   // dd($ex_size_ids);
        //   $products = $products->whereIn('products.size_id',$ex_size_ids);
        // }
        $ex_size_ids = [];
        if (isset($size_filter_ids) && count($size_filter_ids) > 0) {
            $ex_size_ids = $size_filter_values->pluck('reference_id')->toArray();
            // dd($ex_size_ids);
            $size_variant_in = '';
            foreach ($ex_size_ids as $ex_size_id) {
                if ($size_variant_in != '' && $ex_size_id != '') {
                    $size_variant_in .= ' OR ';
                }
                $size_variant_in .= 'FIND_IN_SET("' . $ex_size_id . '", products.`filter_size_ids`) OR (products.size_id =' . $ex_size_id . ')';
            }
            $products = $products->whereRaw("(" . $size_variant_in . ")");
        }
        //filtering products based on size
        $ex_color_ids = [];
        if (isset($color_filter_ids) && count($color_filter_ids) > 0) {
            $ex_color_ids = $color_filter_values->pluck('reference_id')->toArray();
            $color_variant_in = '';
            foreach ($ex_color_ids as $ex_color_id) {
                if ($color_variant_in != '' && $ex_color_id != '') {
                    $color_variant_in .= ' OR ';
                }
                $color_variant_in .= 'FIND_IN_SET("' . $ex_color_id . '", products.`filter_color_ids`) OR (products.color_id =' . $ex_color_id . ')';
            }
            $products = $products->whereRaw("(" . $color_variant_in . ")");
        }
        //filtering products based on discount
        $ex_discount_ids = [];
        if (isset($discount_filter_ids) && count($discount_filter_ids) > 0) {

            $ex_discount_ids = $discount_filter_values->pluck('filter_min_value', 'filter_value_id')->toArray();
            $discount_variant_in = '';
            foreach ($ex_discount_ids as $ex_discount_id) {
                $discount_variant_in .= '`filter_discount` >= ' . $ex_discount_id;
            }
            $products = $products->whereRaw("(" . $discount_variant_in . ")");
        }

        //filtering products based on ratings
        $ex_ratings_ids = [];
        if (isset($ratings_filter_ids) && count($ratings_filter_ids) > 0) {

            $ex_ratings_ids = $ratings_filter_values->pluck('filter_min_value', 'filter_value_id')->toArray();
            $ratings_variant_in = '';
            foreach ($ex_ratings_ids as $ex_ratings_id) {

                $ratings_variant_in .= '`rating` >= ' . $ex_ratings_id;
            }
            $products = $products->whereRaw("(" . $ratings_variant_in . ")");
            // dd($products->get());
        }
        if ($sort_order == 'new-arrivals') {
            // $homepagefeaturedproducts = FeaturedProducts::where('home_page_featured_product_code', 'new-arrivals')->pluck('product_id')->toArray();
            // $arrival_product_ids = $homepagefeaturedproducts[0];
            // // dd($arrival_product_ids);
            // if (isset($arrival_product_ids)) {
            //     $products->orderByRaw(DB::raw("FIELD(products.product_id, $arrival_product_ids) DESC"));
            //     // $d = $products->orderByRaw(DB::raw("FIELD(products.product_id, $arrival_product_ids) ASC"))->get();
            //     // dd($d[147]);
            //     // $products->orderBy('new_arrival', 'ASC');
            // }
            //   $products->orderBy(array('product_id'=>'DESC', 'new_arrival'=> 'ASC'));
            $products->orderBy('new_arrival', 'DESC');

            // $products->where('new_arrival',1);
        } else if ($sort_order == 'recommended') {
            // $homepagefeaturedproducts = FeaturedProducts::where('home_page_featured_product_code', 'recommended')->pluck('product_id')->toArray();
            // $recommended_product_ids = $homepagefeaturedproducts[0];
            // if (isset($recommended_product_ids)) {

            //     $products->orderByRaw(DB::raw("FIELD(products.product_id, $recommended_product_ids) DESC"));
            // }
            $products->orderBy('recommended', 'DESC');


            // $products->where('new_arrival',1);
        } else if ($sort_order == 'popularity') {
            // $products->where('new_arrival',1);
            //   $products->orderBy(array('product_id'=>'DESC', 'popularity' => 'ASC'));
            $products->orderBy('popularity', 'DESC');
        } else if ($sort_order == 'highest-discount') {
            //   $products->orderBy(array('product_id'=>'DESC', 'product_discounted_amount' => 'ASC'));
            $products->orderBy('filter_discount', 'DESC');
        } else if ($sort_order == 'low-to-high') {
            //   $products->orderBy(array('product_id'=>'DESC', 'product_discounted_price' => 'ASC'));
            $products->orderBy('product_discounted_price', 'ASC');
        } else if ($sort_order == 'high-to-low') {
            //   $products->orderBy(array('product_id'=>'DESC', 'product_discounted_price' => 'DESC'));
            $products->orderBy('product_discounted_price', 'DESC');
        }

        $product_count = 0;
        // $product_count = $products->count();
        // dd($products->get(), $product_count);
        if (isset($products)) {

            $products = $products->with('product_images', 'size', 'product_variants', 'brands');
            // $products = $products->select('products.product_id', 'products.product_title', 'product_variants.product_title as variant_title', 'product_variants.product_price', 'product_variants.product_thumb', 'sizes.size_name')
            //     ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.product_id')
            //     ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.size_id');
            // dd($products);


            $product_count = $products->get()->count();

            // dd($product_count);
            $products = $products->orderBy('products.product_id', 'desc')->paginate(40);

            // dd($products[0]);
            // $products = $products->paginate(4);
        } else {
            $products = [];
        }
        // $search .= '';
        // dd($products);

        // dd($filters);


        $filter_value_ids = [];
        $filter_ids = [];


        if (isset($assign_category_filters) && $assign_category_filters) {
            $filter_value_ids = explode(',', $assign_category_filters->filter_value_ids);
            $filter_ids = explode(',', $assign_category_filters->filter_ids);
        }
        $filters = Filters::with([
            'filtervalues' => function ($query) use ($filter_value_ids) {
                $query->whereIn('filter_value_id', $filter_value_ids);
            }
        ])->whereIn('filter_id', $filter_ids)->where('visibility', 1)->orderBy('sort_order', 'ASC')->get();
        if (isset($request->gender) && $request->gender != '') {
        }

        $size_list = Sizes::all();
        $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
            return [$item['size_id'] => $item['size_name']];
        });
        // dd($assign_category_filters->toArray());
        //contents

        if (!empty($assign_category_filters->sub_sub_category_id)) {
            $content_prod = Productlist::where([
                'category_id' => $assign_category_filters->category_id,
                'sub_category_id' => $assign_category_filters->sub_category_id,
                'sub_sub_category_id' => $assign_category_filters->sub_sub_category_id
            ])->first();
        } else if (!empty($assign_category_filters->sub_category_id)) {
            $content_prod = Productlist::where([
                'category_id' => $assign_category_filters->category_id,
                'sub_category_id' => $assign_category_filters->sub_category_id,
                'sub_sub_category_id' => null
            ])->first();

            // dd($content_prod->toArray());
        } else {
            // dd($assign_category_filters);
            $content_prod = Productlist::where([
                'category_id' => !empty($assign_category_filters) ? $assign_category_filters->category_id : '',
                'sub_category_id' => null,
                'sub_sub_category_id' => null
            ])->first();
            // dd($content_prod->toArray());
        }

        //products listing around contents

        if (!empty($assign_category_filters->category_id) && empty($assign_category_filters->sub_category_id) && empty($assign_category_filters->sub_sub_category_id)) {

            $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
                ->take(12)->get();
        } else if (!empty($assign_category_filters->category_id) && !empty($assign_category_filters->sub_category_id) && empty($assign_category_filters->sub_sub_category_id)) {

            $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
                ->where('sub_category_id', $assign_category_filters->sub_category_id)
                ->take(12)->get();
        } else {
            if (!empty($assign_category_filters)) {
                $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
                    ->where('sub_category_id', $assign_category_filters->sub_category_id)
                    ->where('sub_sub_category_id', $assign_category_filters->sub_sub_category_id)
                    ->take(12)->get();
            }
        }

        // if(!empty($assign_category_filters->sub_category_id)){

        // $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
        //     ->where('sub_category_id',$assign_category_filters->sub_category_id)

        //   ->take(12)->get();
        // //   if(count($product_list)<=12){
        // //     $more_data = Products::orwhere('category_id', $assign_category_filters->category_id)
        // //     ->take(12-count($product_list))->get();
        // //     $product_list = $product_list->merge($more_data);
        // //   }
        // }else if(!empty($assign_category_filters->sub_sub_category_id)){

        //     $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
        //           ->where('sub_category_id',$assign_category_filters->sub_category_id)
        //     ->where('sub_sub_category_id',$assign_category_filters->sub_sub_category_id)
        //   ->take(12)->get();
        // }

        // else if(!empty($assign_category_filters->category_id)){
        //   $product_list = Products::orwhere('category_id', $assign_category_filters->category_id)
        // ->take(12)->get();
        // }
        // dd($products[0], $products[1], $products[2]);
        // dd($product_list->toArray());
        // dd($filters);
        // dd($filter_check);

        return view(
            'frontend.product.viewlist',
            compact(
                'products',
                'content_prod',
                'product_list',
                'filters',
                'size_list',
                'category_slug',
                'sub_category_slug',
                'sub_sub_category_slug',
                'sort_order',
                'sort_by_options',
                'filter_values_ids',
                'search',
                'search_flag',
                'breadcrumb',
                'filter_level',
                'product_count',
                'search_query',
                'product_listing_title',
                'filter_check'

            )
        );
    }

    public function productdetails1($category_slug, $sub_category_slug, $sub_sub_category_slug, $product_slug)
    {
        $product = Products::where('category_slug', $category_slug)->where('sub_category_slug', $sub_category_slug)->where('sub_sub_category_slug', $sub_sub_category_slug)->where('product_slug', $product_slug)->with(['product_images', 'country', 'seller', 'packer', 'importer', 'manufacturer', 'product_variants', 'size', 'brands'])->first();
        if ($product->count() > 0) {
            $size_chart = SizeCharts::where('size_chart_id', $product->size_chart_id)->with('chart_childs')->first();
            // dd($size_chart);
            $size_chart_types = SizeChartTypes::leftJoin("size_chart_fields", \DB::raw("FIND_IN_SET(size_chart_fields.size_chart_field_id,size_chart_types.size_chart_field_id)"), ">", \DB::raw("'0'"))
                ->where('size_chart_types.size_chart_type_id', $size_chart->size_type)
                ->get([
                    'size_chart_types.*',
                    \DB::raw("size_chart_fields.*")
                ]);
            $color_list = Colors::all();
            $color_list = collect($color_list)->mapWithKeys(function ($item, $key) {
                return [$item['color_id'] => $item['color_code']];
            });
            $size_list = Sizes::all();
            $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
                return [$item['size_id'] => $item['size_name']];
            });
            // dd($size_list);
            return view('frontend.product.viewproduct', compact('product', 'size_chart', 'size_chart_types', 'color_list', 'size_list'));
        } else {
            return redirect('/');
        }
    }

    public function productdetails($category_slug, $sub_category_slug, $sub_sub_category_slug, $product_slug, $variant_slug = null)
    {
        if (isset($variant_slug)) {
            // dd("variant");
            // dd($product_slug . "/" . $variant_slug);
            $order_delivery = OrderDeliveryManagement::first();
            $coupon_data = Coupons::get();
            $product = ProductVariants::where('category_slug', $category_slug)
                ->where('sub_category_slug', $sub_category_slug)
                ->where('sub_sub_category_slug', $sub_sub_category_slug)
                ->where('product_slug', $variant_slug)
                ->with([
                    'product_variant_images', 'country', 'seller', 'packer',
                    'importer', 'manufacturer', 'size', 'brands', 'variant_combined_size', 'product'
                ])
                ->first();
            // dd($product->product->product_type);
            if (isset($product) && $product->count() > 0) {
                $size_chart_id = Products::pluck('size_chart_id');
                // dd($size_chart_id);
                $size_chart = SizeCharts::where('size_chart_id', $product->product->size_chart_id)->with('chart_childs')->first();
                // dd($size_chart);
                $size_chart_types = [];
                if (isset($size_chart)) {
                    $type_sort = [1, 3, 12, 6, 2, 5, 4, 8, 10, 7, 11, 9, 13];
                    $sortedIds = implode(',', $type_sort);
                    $size_chart_types = SizeChartTypes::leftJoin("size_chart_fields", \DB::raw("FIND_IN_SET(size_chart_fields.size_chart_field_id,size_chart_types.size_chart_field_id)"), ">", \DB::raw("'0'"))
                        ->where('size_chart_types.size_chart_type_id', $size_chart->size_type)->orderByRaw("FIELD(size_chart_fields.size_chart_field_id, $sortedIds)")
                        ->get([
                            'size_chart_types.*',
                            \DB::raw("size_chart_fields.*")
                        ]);
                }
                // dd($size_chart_types);
                $color_list = Colors::all();
                $color_list = collect($color_list)->mapWithKeys(function ($item, $key) {
                    return [$item['color_id'] => $item['color_code']];
                });
                $size_list = Sizes::pluck('size_name', 'size_id')->all();
                // dd($size_list);
                $twoReviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->paginate(2);
                $reviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->get();
                // dd($reviews);
                $countReviews = $reviews->count();
                $avgrates = $reviews->avg('rating');
                $calstar = DB::table('reviews')
                    ->select('rating', DB::raw('count(*) as total'))
                    ->where('product_id', $product->product_id)
                    ->where('approval', 1)
                    ->groupBy('rating')
                    ->get();
                $percentage = array();
                foreach ($calstar as $cal) {
                    if ($cal->rating == 1) {
                        $percentage[1] = $cal->total / $countReviews * 100;
                    }

                    if ($cal->rating == 2) {
                        $percentage[2] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 3) {
                        $percentage[3] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 4) {
                        $percentage[4] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 5) {
                        $percentage[5] = $cal->total / $countReviews * 100;
                    }
                }
                $productrating = DB::table('products')
                    ->where('product_id', $product->product_id)
                    ->update(
                        array(
                            'rating' => floor($avgrates)
                        )
                    );

                $relatedProducts = DB::table('related_products')
                    ->join('products', 'products.product_id', '=', 'related_products.related_product_list_id')
                    ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                    ->where('related_products.product_id', $product->product_id)
                    ->get();

                $imageList = [];
                foreach ($relatedProducts as $relatedProduct) {
                    $productImages = ProductImages::where('product_id', $relatedProduct->related_product_list_id)->first();
                    if ($productImages) {
                        $imageList[$relatedProduct->related_product_list_id] = $productImages->image_name;
                    }
                }

                // dd($product->product_variant_id);
                $relatedVariantProducts = DB::table('related_variant_products')
                    ->join('products', 'products.product_id', '=', 'related_variant_products.related_product_list_id')
                    ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                    ->where('related_variant_products.product_variant_id', $product->product_variant_id)
                    ->get();
                // dd($relatedVariantProducts);
                $variantImageList = [];
                foreach ($relatedVariantProducts as $relatedVariantProduct) {
                    $productVariantImages = ProductImages::where('product_id', $relatedVariantProduct->related_product_list_id)->first();
                    if ($productVariantImages) {
                        $variantImageList[$relatedVariantProduct->related_product_list_id] = $productVariantImages->image_name;
                    }
                }
                // dd($variantImageList);
                $frequently_boughts = DB::table('frequently_bought')
                    ->join('products', 'products.product_id', '=', 'frequently_bought.frequently_bought_together_id')
                    ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                    ->where('frequently_bought.product_id', $product->product_id)
                    ->get();


                $frequently_bought_image = [];

                foreach ($frequently_boughts as $frequently_bought) {
                    $productImages = ProductImages::where('product_id', $frequently_bought->product_id)->first();
                    if ($productImages) {
                        $frequently_bought_image[$frequently_bought->product_id] = $productImages->image_name;
                    }
                }
                // dd($frequently_boughts);
                $recentlyViewsimage = [];
                $breadcrumb = '';
                $product_details_title = '';
                if ($sub_sub_category_slug) {
                    $categories = Categories::where('category_slug', $category_slug)->first();
                    $sub_categories = SubCategories::where('sub_category_slug', $sub_category_slug)->first();
                    $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug', $sub_sub_category_slug)->first();
                    $category_name = ucwords(strtolower($categories->category_name));
                    $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
                    $category_slug = $categories->category_slug;
                    $subcategory_slug = $sub_categories->sub_category_slug;
                    $sub_subcategory_name = ucwords(strtolower($sub_sub_categories->sub_subcategory_name));
                    $breadcrumb .= '
                    <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/sf/" . $category_slug) . '">' . $category_name . '</a></li>
                    <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/ss/" . $category_slug . '/' . $subcategory_slug) . '">' . $subcategory_name . '</a></li>
                    <li class="breadcrumb-item active" aria-current="page">' . $sub_subcategory_name . '</li>';
                    $sub_subcategory_description = (isset($sub_categories->sub_subcategory_description) && $sub_categories->sub_subcategory_description != "") ? $sub_categories->sub_subcategory_description : '';
                    $custom_page_title = CustomPageTitles::where('custom_page_title_code', 'product')->first();
                    $page_title = "";
                    if (isset($custom_page_title->custom_page_title_name) && $custom_page_title->custom_page_title_name != "") {
                        $page_title = $custom_page_title->custom_page_title_name;
                        $page_title = str_replace("{#category}", $category_name, $page_title);
                        $page_title = str_replace("{#subcategory}", $subcategory_name, $page_title);
                        $page_title = str_replace("{#childcategory}", $sub_subcategory_name, $page_title);
                        $page_title = str_replace("{#childcategorydescription}", $sub_subcategory_description, $page_title);
                        $product_details_title = $page_title;
                    } else {
                        $product_details_title = $sub_subcategory_name . " for " . $category_name . " - Shop " . $category_name . " " . $sub_subcategory_name . " Online in India | Dadreeios";
                    }
                }
                if (Auth()->check()) {
                    $checkproduct = RecentlyViewed::where(['user_id' => Auth()->user()->id, 'product_id' => $product->product_id])->first();

                    if (!$checkproduct) {
                        $recentlyviewedproduct = new RecentlyViewed();
                        $recentlyviewedproduct->user_id = Auth()->user()->id;
                        $recentlyviewedproduct->product_id = $product->product_id;
                        $recentlyviewedproduct->save();
                    }
                    $recentlyViews = DB::table('recentlyviewed')
                        ->join('products', 'products.product_id', '=', 'recentlyviewed.product_id')
                        ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                        ->where('recentlyviewed.product_id', '!=', $product->product_id)
                        ->where('recentlyviewed.user_id', Auth()->user()->id)
                        ->latest('recentlyviewed.created_at')
                        ->take(10)
                        ->get();
                    //$recentlyViews = RecentlyViewed::where(['user_id'=> Auth()->user()->id,'product_id','!=',$product->product_id])->latest()->take(10)->get();

                    foreach ($recentlyViews as $recentlyView) {
                        $productImages = ProductImages::where('product_id', $recentlyView->product_id)->first();
                        $recentlyViewsimage[$recentlyView->product_id] = $productImages->image_name;
                    }

                    return view(
                        'frontend.product.viewproduct',
                        compact(
                            'product',
                            'size_chart',
                            'size_chart_types',
                            'color_list',
                            'reviews',
                            'countReviews',
                            'avgrates',
                            'calstar',
                            'percentage',
                            'relatedProducts',
                            'imageList',
                            'twoReviews',
                            'frequently_boughts',
                            'frequently_bought_image',
                            'recentlyViews',
                            'recentlyViewsimage',
                            'size_list',
                            'coupon_data',
                            'order_delivery',
                            'breadcrumb',
                            'product_details_title',
                            'relatedVariantProducts',
                            'variantImageList'
                        )
                    );
                }
                return view(
                    'frontend.product.viewproduct',
                    compact(
                        'product',
                        'size_chart',
                        'size_chart_types',
                        'color_list',
                        'reviews',
                        'countReviews',
                        'avgrates',
                        'calstar',
                        'percentage',
                        'relatedProducts',
                        'imageList',
                        'twoReviews',
                        'frequently_boughts',
                        'frequently_bought_image',
                        'size_list',
                        'coupon_data',
                        'order_delivery',
                        'breadcrumb',
                        'product_details_title',
                        'relatedVariantProducts',
                        'variantImageList'
                    )
                );
            } else {
                return redirect('/');
            }
        } else {

            $order_delivery = OrderDeliveryManagement::first();
            $coupon_data = Coupons::get();
            $product = Products::where('category_slug', $category_slug)->where('sub_category_slug', $sub_category_slug)->where('sub_sub_category_slug', $sub_sub_category_slug)->where('product_slug', $product_slug)->with(['product_images', 'country', 'seller', 'packer', 'importer', 'manufacturer', 'product_variants', 'size', 'brands'])->first();
            if ($product->count() > 0) {
                $size_chart = SizeCharts::where('size_chart_id', $product->size_chart_id)->with('chart_childs')->first();
                // dd($size_chart);
                $type_sort = [1, 3, 12, 6, 2, 5, 4, 8, 10, 7, 11, 9, 13];
                $sortedIds = implode(',', $type_sort);
                $size_chart_types = SizeChartTypes::leftJoin("size_chart_fields", \DB::raw("FIND_IN_SET(size_chart_fields.size_chart_field_id,size_chart_types.size_chart_field_id)"), ">", \DB::raw("'0'"))
                    ->where('size_chart_types.size_chart_type_id', $size_chart->size_type)->orderByRaw("FIELD(size_chart_fields.size_chart_field_id, $sortedIds)")
                    ->get([
                        'size_chart_types.*',
                        \DB::raw("size_chart_fields.*")
                    ]);
                $color_list = Colors::all();
                $color_list = collect($color_list)->mapWithKeys(function ($item, $key) {
                    return [$item['color_id'] => $item['color_code']];
                });
                $size_list = Sizes::pluck('size_name', 'size_id')->all();
                // dd($size_list);
                $twoReviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->paginate(2);
                $reviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->get();

                $countReviews = $reviews->count();
                $avgrates = $reviews->avg('rating');
                $calstar = DB::table('reviews')
                    ->select('rating', DB::raw('count(*) as total'))
                    ->where('product_id', $product->product_id)
                    ->where('approval', 1)
                    ->groupBy('rating')
                    ->get();
                $percentage = array();
                foreach ($calstar as $cal) {
                    if ($cal->rating == 1) {
                        $percentage[1] = $cal->total / $countReviews * 100;
                    }

                    if ($cal->rating == 2) {
                        $percentage[2] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 3) {
                        $percentage[3] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 4) {
                        $percentage[4] = $cal->total / $countReviews * 100;
                    }
                    if ($cal->rating == 5) {
                        $percentage[5] = $cal->total / $countReviews * 100;
                    }
                }
                $productrating = DB::table('products')
                    ->where('product_id', $product->product_id)
                    ->update(
                        array(
                            'rating' => floor($avgrates)
                        )
                    );

                $relatedProducts = DB::table('related_products')
                    ->join('products', 'products.product_id', '=', 'related_products.related_product_list_id')
                    ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                    ->where('related_products.product_id', $product->product_id)
                    ->get();

                $imageList = [];
                foreach ($relatedProducts as $relatedProduct) {
                    $productImages = ProductImages::where('product_id', $relatedProduct->related_product_list_id)->first();
                    if ($productImages) {
                        $imageList[$relatedProduct->related_product_list_id] = $productImages->image_name;
                    }
                }
                $frequently_boughts = DB::table('frequently_bought')
                    ->join('products', 'products.product_id', '=', 'frequently_bought.frequently_bought_together_id')
                    ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                    ->where('frequently_bought.product_id', $product->product_id)
                    ->get();


                $frequently_bought_image = [];

                foreach ($frequently_boughts as $frequently_bought) {
                    $productImages = ProductImages::where('product_id', $frequently_bought->product_id)->first();
                    if ($productImages) {
                        $frequently_bought_image[$frequently_bought->product_id] = $productImages->image_name;
                    }
                }
                // dd($frequently_boughts);
                $recentlyViewsimage = [];
                $breadcrumb = '';
                $product_details_title = '';
                if ($sub_sub_category_slug) {
                    $categories = Categories::where('category_slug', $category_slug)->first();
                    $sub_categories = SubCategories::where('sub_category_slug', $sub_category_slug)->first();
                    $sub_sub_categories = SubSubCategories::where('sub_sub_category_slug', $sub_sub_category_slug)->first();
                    $category_name = ucwords(strtolower($categories->category_name));
                    $subcategory_name = ucwords(strtolower($sub_categories->subcategory_name));
                    $category_slug = $categories->category_slug;
                    $subcategory_slug = $sub_categories->sub_category_slug;
                    $sub_subcategory_name = ucwords(strtolower($sub_sub_categories->sub_subcategory_name));
                    $breadcrumb .= '
                    <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/ss/" . $category_slug . '/' . $subcategory_slug) . '">' . $subcategory_name . '</a></li>
                    <li class="breadcrumb-item overview-list-subhead"><a href="' . url("/sf/" . $category_slug) . '">' . $category_name . '</a></li>
                    <li class="breadcrumb-item active" aria-current="page">' . $sub_subcategory_name . '</li>';
                    $sub_subcategory_description = (isset($sub_categories->sub_subcategory_description) && $sub_categories->sub_subcategory_description != "") ? $sub_categories->sub_subcategory_description : '';
                    $custom_page_title = CustomPageTitles::where('custom_page_title_code', 'product')->first();
                    $page_title = "";
                    if (isset($custom_page_title->custom_page_title_name) && $custom_page_title->custom_page_title_name != "") {
                        $page_title = $custom_page_title->custom_page_title_name;
                        $page_title = str_replace("{#category}", $category_name, $page_title);
                        $page_title = str_replace("{#subcategory}", $subcategory_name, $page_title);
                        $page_title = str_replace("{#childcategory}", $sub_subcategory_name, $page_title);
                        $page_title = str_replace("{#childcategorydescription}", $sub_subcategory_description, $page_title);
                        $product_details_title = $page_title;
                    } else {
                        $product_details_title = $sub_subcategory_name . " for " . $category_name . " - Shop " . $category_name . " " . $sub_subcategory_name . " Online in India | Dadreeios";
                    }
                }
                if (Auth()->check()) {
                    $checkproduct = RecentlyViewed::where(['user_id' => Auth()->user()->id, 'product_id' => $product->product_id])->first();

                    if (!$checkproduct) {
                        $recentlyviewedproduct = new RecentlyViewed();
                        $recentlyviewedproduct->user_id = Auth()->user()->id;
                        $recentlyviewedproduct->product_id = $product->product_id;
                        $recentlyviewedproduct->save();
                    }
                    $recentlyViews = DB::table('recentlyviewed')
                        ->join('products', 'products.product_id', '=', 'recentlyviewed.product_id')
                        ->leftjoin('brands', 'brands.brand_id', '=', 'products.brand_id')
                        ->where('recentlyviewed.product_id', '!=', $product->product_id)
                        ->where('recentlyviewed.user_id', Auth()->user()->id)
                        ->latest('recentlyviewed.created_at')
                        ->take(10)
                        ->get();
                    //$recentlyViews = RecentlyViewed::where(['user_id'=> Auth()->user()->id,'product_id','!=',$product->product_id])->latest()->take(10)->get();

                    foreach ($recentlyViews as $recentlyView) {
                        $productImages = ProductImages::where('product_id', $recentlyView->product_id)->first();
                        $recentlyViewsimage[$recentlyView->product_id] = $productImages->image_name;
                    }

                    return view(
                        'frontend.product.viewproduct',
                        compact(
                            'product',
                            'size_chart',
                            'size_chart_types',
                            'color_list',
                            'reviews',
                            'countReviews',
                            'avgrates',
                            'calstar',
                            'percentage',
                            'relatedProducts',
                            'imageList',
                            'twoReviews',
                            'frequently_boughts',
                            'frequently_bought_image',
                            'recentlyViews',
                            'recentlyViewsimage',
                            'size_list',
                            'coupon_data',
                            'order_delivery',
                            'breadcrumb',
                            'product_details_title'
                        )
                    );
                }
                return view(
                    'frontend.product.viewproduct',
                    compact(
                        'product',
                        'size_chart',
                        'size_chart_types',
                        'color_list',
                        'reviews',
                        'countReviews',
                        'avgrates',
                        'calstar',
                        'percentage',
                        'relatedProducts',
                        'imageList',
                        'twoReviews',
                        'frequently_boughts',
                        'frequently_bought_image',
                        'size_list',
                        'coupon_data',
                        'order_delivery',
                        'breadcrumb',
                        'product_details_title'
                    )
                );
            } else {
                return redirect('/');
            }
        }
    }

    public function getcolors(Request $request)
    {
        $data = $request->all();
        $color_id = $data['color_id'];
        $color = Colors::where('color_id', $color_id)->first();
        $color_name = ($color->color_name) ? strtoupper($color->color_name) : '';
        // dd($color);
        return $color_name;
    }

    public function getvariantsizelist(Request $request)
    {
        $response = [];
        $data = $request->all();
        $content = '';
        $color_id = $data['color_id'];
        $product_id = $data['product_id'];
        $products = ProductVariants::where('product_id', $product_id)->where('color_id', $color_id)->with(['product'])->get();
        // dd($products);
        $size_list = Sizes::pluck('size_name', 'size_id')->all();
        $product_size_ids = array_unique(array_column($products->toArray(), 'size_id'));
        $var_size_inc = 0;
        foreach ($product_size_ids as $size) {
            $size_checked = ($var_size_inc == 0) ? 'Checked' : '';
            $size_name = isset($size_list[$size]) ? $size_list[$size] : '';
            $content .= '<div data-value="' . $size . '" class="swatch-element-size plain s available">
          <input id="size-' . $size . '" type="radio" name="size_id" value="' . $size . '" class="size_checked" ' . $size_checked . ' />
          <label for="size-' . $size . '">
            ' . $size_name . '
          </label>
        </div>';
            $var_size_inc++;
        }
        $product_images = ProductVariantImages::where('product_id', $product_id)->where('color_id', $color_id)->limit(6)->get();
        $slidcount = 0;
        $carousel_div = '';
        $carousel_thumb_div = '';

        if (isset($product_images) && count($product_images) > 0) {
            $product_images = $product_images->pluck('image_name');
            $path_type = 'product_variant_images_original';
            // $path_type = 'product_variant_images';
        } else {
            $product_main = $products->take(1);
            $product_images = $product_main[0]->product->product_images->take(6)->pluck('image_name');
            $path_type = 'product_images_original';
            // $path_type = 'product_images';
        }


        if (isset($product_images) && count($product_images) > 0) {
            foreach ($product_images as $product_image) {
                $active_flag = ($slidcount == 0) ? "active" : "";
                $product_image_path_name = url('backend-assets/uploads/' . $path_type . '/') . '/' . $product_image;
                $carousel_thumb_div .= '
            <div class="carousel-item ' . $active_flag . '">
               <div class="wrapper">
                  <div class="block">
                     <img src="' . $product_image_path_name . '" alt="Image To Zoom" class="cloudzoom" >
                  </div>
               </div>
            </div>
          ';
                //   block__pic
                if ($slidcount == 0) {
                    $carousel_div .= '
              <ul class="carousel-indicators1">
            ';
                }
                if ($slidcount == 3) {
                    $carousel_div .= '
              </ul>
              <ul class="carousel-indicators2">
            ';
                }
                $thumb_active = ($slidcount == 0) ? 'active' : '';
                $thumb_active1 = ($slidcount == 0) ? 'active1' : '';
                $image_mt = ($slidcount == 2 || $slidcount == 5) ? 'image-mt' : '';
                $image_mb = ($slidcount == 0 || $slidcount == 3) ? 'image-mb' : '';
                $carousel_div .= '
            <li data-target="#carousel-thumb " class="' . $image_mb . ' ' . $image_mt . ' img-li ' . $thumb_active . '" data-slide-to="' . $slidcount . '">
              <img class="img-fluid ' . $thumb_active1 . ' img-hover-shadow" src="' . $product_image_path_name . '" >
            </li>
          ';
                $slidcount++;
            }
        }

        $response['sizes'] = $content;
        $response['product_thumbs'] = $carousel_thumb_div;
        $response['product_images'] = $carousel_div;
        // dd($color);
        return ['success', $response];
    }

    public function getproductvariants(Request $request)
    {
        // var_dump('teststw stestes');
        // $this->layout->title = 'My title';

        $data = $request->all();
        $color_id = $data['color_id'];
        $product_id = $data['product_id'];
        $size_id = $data['size_id'];

        $products = ProductVariants::where('product_id', $product_id)->where('color_id', $color_id)->where('size_id', $size_id)->with(['product', 'product_variant_images'])->first();
        // dd($products);
        if ($products) {
            $response = [];
            $response['product_variant_id'] = $products->product_variant_id;
            $response['product_title'] = $products->product_title;
            $response['product_sub_title'] = isset($products->product->brands) ? $products->product->brands->brand_name : '&nbsp;';
            $response['product_price'] = $products->product_price;
            $response['product_discounted_price'] = $products->product_discounted_price;
            $response['product_discount'] = $products->product_discount;
            $response['product_discount_type'] = $products->product_discount_type;
            $response['product_qty'] = $products->product_qty;
            // if (isset($products->product_variant_images)&& count($products->product_variant_images)>0)
            // {
            //   $product_images = $products->product_variant_images->pluck('image_name');
            //   // $slidcount = 0;
            //   // $carousel_div = '';
            //   // if(isset($product_variant_images) && count($product_variant_images)>0)
            //   // {
            //   //   foreach($product_variant_images as $product_image)
            //   //   {
            //   //     $active_flag = ($slidcount==0)?"active":"";
            //   //     $product_image_path_name = url('backend-assets/uploads/product_variant_images/').'/'.$product_image;
            //   //     $carousel_div .= '
            //   //       <div class="carousel-item '.$active_flag.'">
            //   //          <div class="wrapper">
            //   //             <div class="block">
            //   //                <img src="'.$product_image_path_name.'" alt="Image To Zoom" class="block__pic" >
            //   //             </div>
            //   //          </div>
            //   //       </div>
            //   //     ';
            //   //     $slidcount++;
            //   //   }
            //   // }
            //   $path_type = 'product_variant_images';
            //   $response['product_images_type'] = 'product_variant_images';
            // }
            // else
            // {
            //   $product_images = $products->product->product_images->pluck('image_name');
            //   $path_type = 'product_images';
            //   $response['product_images_type'] = 'product_images';
            // }
            //
            // $slidcount = 0;
            // $carousel_div = '';
            // $carousel_thumb_div = '';
            // if(isset($product_images) && count($product_images)>0)
            // {
            //   foreach($product_images as $product_image)
            //   {
            //     $active_flag = ($slidcount==0)?"active":"";
            //     $product_image_path_name = url('backend-assets/uploads/'.$path_type.'/').'/'.$product_image;
            //     $carousel_thumb_div .= '
            //       <div class="carousel-item '.$active_flag.'">
            //          <div class="wrapper">
            //             <div class="block">
            //                <img src="'.$product_image_path_name.'" alt="Image To Zoom" class="block__pic" >
            //             </div>
            //          </div>
            //       </div>
            //     ';
            //     if($slidcount == 0)
            //     {
            //       $carousel_div .= '
            //         <ul class="carousel-indicators1">
            //       ';
            //     }
            //     if($slidcount == 3)
            //     {
            //       $carousel_div .= '
            //         </ul>
            //         <ul class="carousel-indicators2">
            //       ';
            //     }
            //     $thumb_active = ($slidcount==0)?'active':'';
            //     $thumb_active1 = ($slidcount==0)?'active1':'';
            //     $image_mt = ($slidcount==2 || $slidcount==5)?'image-mt':'';
            //     $image_mb = ($slidcount==0 || $slidcount==3)?'image-mb':'';
            //     $carousel_div .= '
            //       <li data-target="#carousel-thumb " class="'.$image_mb.' '.$image_mt.' img-li '.$thumb_active.'" data-slide-to="'.$slidcount.'">
            //         <img class="img-fluid '.$thumb_active1.' img-hover-shadow" src="'.$product_image_path_name.'" >
            //       </li>
            //     ';
            //     $slidcount++;
            //   }
            // }
            // $response['product_thumbs'] = $carousel_thumb_div;
            // $response['product_images'] = $carousel_div;
            return ['success', $response];
        } else {
            return ['error', 'NO record Found'];
        }
        // return "test now";
    }

    public function test()
    {
        echo "give me soe";
    }

    public function getproducts(Request $request)
    {
        $data = $request->all();
        // $color_id = $data['color_id'];
        // $product_id = $data['product_id'];
        // $size_id = $data['size_id'];
        // $value = $request->route()->getActionMethod();
        // dd(Route::getCurrentRoute()->getActionMethod() );
        $search = '';
        $sort_type = $data['sort_order'];
        $filter_check = isset($data['filter_check']) ? $data['filter_check'] : ['none'];
        $price_array = isset($data['price_array']) ? $data['price_array'] : [];

        $category_slug = $data['category_slug'];
        $sub_category_slug = $data['sub_category_slug'];
        $sub_sub_category_slug = $data['sub_sub_category_slug'];
        // dd($filter_check);
        // dd($data);

        /************************************************ to get first variant id of product */
        $firstVariants = DB::table('product_variants')
            ->select('product_id', 'product_variant_id', 'color_id', DB::raw('MIN(product_variant_id) as first_variant_id'))
            ->whereNotNull('color_id')
            ->groupBy('product_id', 'color_id');
        /************************************************ */
        $product_id = [];
        $price_filer_ids = [];
        $discount_filter_ids = [];
        $ratings_filter_ids = [];
        $size_filter_ids = [];
        $color_filter_ids = [];
        $desired_ids = [];
        $filter_ids_combo = [];
        if (isset($filter_check) && count($filter_check) > 0) {
            //seperate price filter ids from
            $price_filter_values = FilterValues::whereIn('filter_value_id', $filter_check)->where('filter_type', 'price')->get();
            $price_filer_ids = $price_filter_values->pluck('filter_value_id')->toArray();

            //seperate discount filter ids from
            $discount_filter_values = FilterValues::whereIn('filter_value_id', $filter_check)->where('filter_type', 'discount')->get();
            $discount_filter_ids = $discount_filter_values->pluck('filter_value_id')->toArray();

            //seperate discount filter ids from
            $ratings_filter_values = FilterValues::whereIn('filter_value_id', $filter_check)->where('filter_type', 'ratings')->get();
            $ratings_filter_ids = $ratings_filter_values->pluck('filter_value_id')->toArray();

            // dd($discount_filer_ids);
            //seperate size filter ids from
            $size_filter_values = FilterValues::whereIn('filter_value_id', $filter_check)->where('filter_type', 'size')->get();
            $size_filter_ids = $size_filter_values->pluck('filter_value_id')->toArray();
            // dd("colors");
            //seperate color filter ids from
            $color_filter_values = FilterValues::whereIn('filter_value_id', $filter_check)->where('filter_type', 'color')->get();
            $color_filter_ids = $color_filter_values->pluck('filter_value_id')->toArray();

            $filter_ids_combo = array_merge($price_filer_ids, $size_filter_ids, $color_filter_ids, $discount_filter_ids, $ratings_filter_ids);
            // dd($color_filter_ids);
            $desired_ids = array_diff($filter_check, $filter_ids_combo);
            // dd($desired_ids);
            $filter_values = ProductFilters::whereIn('filter_value_id', $desired_ids)->get();
            $product_ids = $filter_values->pluck('product_id')->toArray();
            // dd($product_ids);
        }
        // dd($product_ids);

        $post_url = url('/');

        if (isset($data['search_query']) && $data['search_query'] != '') {
            $search_query = $data['search_query'];
            // $filter_gender = (isset($data['filter_gender']) && $data['filter_gender']=='male')?1
            if (!isset($products)) {
                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->leftJoin('categories', 'categories.category_id', '=', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.subcategory_id', '=', 'products.sub_category_id')
                    ->leftJoin('sub_subcategories', 'sub_subcategories.sub_subcategory_id', '=', 'products.sub_sub_category_id')
                    ->leftJoin('brands', 'brands.brand_id', '=', 'products.brand_id')

                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size']);
                // ->leftJoin('product_variants','product_variants.product_id','=','products.product_id');
            } else {
                $products = $products->select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->leftJoin('categories', 'categories.category_id', '=', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.subcategory_id', '=', 'products.sub_category_id')
                    ->leftJoin('sub_subcategories', 'sub_subcategories.sub_subcategory_id', '=', 'products.sub_sub_category_id')
                    ->leftJoin('brands', 'brands.brand_id', '=', 'products.brand_id')

                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size']);
                // ->leftJoin('product_variants','product_variants.product_id','=','products.product_id');
            }
            if (isset($data['filter_gender']) && $data['filter_gender'] != '') {
                $products = $products->where('products.category_id', $data['filter_gender']);
            }
            $products = $products->when($search_query, function ($query, $search_query) {
                return $query->whereRaw('(products.product_title LIKE "%' . $search_query . '%" OR categories.category_name LIKE "%' . $search_query . '%" OR subcategories.subcategory_name LIKE "%' . $search_query . '%" OR sub_subcategories.sub_subcategory_name LIKE "%' . $search_query . '%" OR brands.brand_name LIKE "%' . $search_query . '%")');
            });
            // ->orWhere('categories.category_name', 'LIKE', '%'.$search_query.'%')
            //                     ->orWhere('subcategories.subcategory_name', 'LIKE', '%'.$search_query.'%')
            //                     ->orWhere('sub_subcategories.sub_subcategory_name', 'LIKE', '%'.$search_query.'%')
            //                     ->orWhere('brands.brand_name', 'LIKE', '%'.$search_query.'%');
            if (isset($data['filter_gender']) && $data['filter_gender'] != '') {
                $products = $products->where('products.category_id', $data['filter_gender']);
            }

            $post_url .= '/search/' . $search_query;
        }
        if (!isset($products)) {
            if (isset($product_ids) && count($product_ids) > 0) {
                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])
                    ->whereIn('products.product_id', $product_ids);
            } else if (isset($filter_check) && count($filter_check) > 0 && $filter_check[0] != 'none' && (isset($product_ids) && count($product_ids) <= 0) && (isset($price_filer_ids) && count($price_filer_ids) <= 0) && (isset($size_filter_ids) && count($size_filter_ids) <= 0) && (isset($color_filter_ids) && count($color_filter_ids) <= 0) && (isset($discount_filter_ids) && count($discount_filter_ids) <= 0) && (isset($ratings_filter_ids) && count($ratings_filter_ids) <= 0)) {
                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])
                    ->where('products.product_id', 0);
                // dd($products->get());
            } else {
                $products = Products::select('products.*', 'product_variants.first_variant_id', 'product_variants.product_variant_id', 'product_variants.color_id as variant_color_id')
                    ->leftJoinSub($firstVariants, 'product_variants', function ($join) {
                        $join->on('products.product_id', '=', 'product_variants.product_id');
                    })
                    ->groupBy('products.product_id', 'product_variants.color_id', 'product_variants.product_variant_id')
                    ->with(['variant'])
                    ->with(['variant_size'])
                    ->with(['combined_size'])
                    ->where('products.product_id', '!=', 0);
                // ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.product_id')

                // dd($products);
            }
        } else {
            // dd($product_ids);
            if (isset($product_ids) && count($product_ids) > 0) {
                $products = $products->whereIn('products.product_id', $product_ids);
            } else if (isset($filter_check) && count($filter_check) > 0 && $filter_check[0] != 'none' && (isset($product_ids) && count($product_ids) <= 0) && count($price_filer_ids) <= 0 && (isset($size_filter_ids) && count($size_filter_ids) <= 0) && (isset($color_filter_ids) && count($color_filter_ids) <= 0) && (isset($discount_filter_ids) && count($discount_filter_ids) <= 0) && (isset($ratings_filter_ids) && count($ratings_filter_ids) <= 0)) {
                $products = $products->where('products.product_id', 0); //->where('products.category_slug',$category_slug)
                // dd($products);
            }
        }
        if (isset($products)) {
            $products = $products->where('products.visibility', 1);
        }
        //filtering products based on price
        if (isset($price_filer_ids) && count($price_filer_ids) > 0) {
            $price_between = '';
            foreach ($price_filter_values as $price_filter_value) {
                if ($price_between != '') {
                    $price_between .= ' OR ';
                } else {
                    if (isset($price_filter_value->filter_min_value) && isset($price_filter_value->filter_max_value)) {
                        $price_between = '(';
                    }
                }
                if (isset($price_filter_value->filter_min_value) && isset($price_filter_value->filter_max_value)) {
                    $price_between .= 'products.product_discounted_price between ' . $price_filter_value->filter_min_value . ' and ' . $price_filter_value->filter_max_value;
                }
            }
            if ($price_between != '') {
                $price_between .= ')';
            }
            $products = $products->whereRaw($price_between);
        }
        // dd($products->get());
        // dd($price_array);
        if (isset($price_array) && count($price_array) > 0) {
            $price_array_between = 'products.product_discounted_price between ' . $price_array[0] . ' and ' . $price_array[1];

            $products = $products->whereRaw($price_array_between);
        }
        //filtering products based on size
        $ex_size_ids = [];
        if (isset($size_filter_ids) && count($size_filter_ids) > 0) {
            $ex_size_ids = $size_filter_values->pluck('reference_id')->toArray();
            // dd($ex_size_ids);
            // $em_ex_size_ids = implode(',',$ex_size_ids);
            $size_variant_in = '';
            foreach ($ex_size_ids as $ex_size_id) {
                if ($size_variant_in != '' && $ex_size_id != '') {
                    $size_variant_in .= ' OR ';
                }
                $size_variant_in .= 'FIND_IN_SET("' . $ex_size_id . '", products.`filter_size_ids`) OR (products.size_id =' . $ex_size_id . ')';
                // find_in_set("'.$ex_size_id.'",`products`.`filter_size_ids`
            }
            // $size_variant_in = '(products.size_id IN('.$em_ex_size_ids.'))'; // OR product_variants.size_id IN('.$em_ex_size_ids.')
            // dd($size_variant_in);
            // $products = $products->whereRaw($size_variant_in);
            $products = $products->whereRaw("(" . $size_variant_in . ")");
            // $products = $products->whereIn('products.filter_size_ids',$ex_size_ids);
            // $products = $products->when($ex_size_ids, function($q) use($ex_size_ids) {
            //                 return $q->whereIn('products.size_id', $ex_size_ids);
            //             });
            // $products = $products->when($ex_size_ids, function($q) use($ex_size_ids) {
            //                 return $q->whereIn('product_variants.size_id', $ex_size_ids);
            //             });
        }
        //filtering products based on size
        $ex_color_ids = [];
        if (isset($color_filter_ids) && count($color_filter_ids) > 0) {
            $ex_color_ids = $color_filter_values->pluck('reference_id')->toArray();
            $color_variant_in = '';
            foreach ($ex_color_ids as $ex_color_id) {
                if ($color_variant_in != '' && $ex_color_id != '') {
                    $color_variant_in .= ' OR ';
                }
                $color_variant_in .= 'FIND_IN_SET("' . $ex_color_id . '", products.`filter_color_ids`) OR (products.color_id =' . $ex_color_id . ')';
            }
            $products = $products->whereRaw("(" . $color_variant_in . ")");
        }
        //filtering products based on discount
        $ex_discount_ids = [];
        if (isset($discount_filter_ids) && count($discount_filter_ids) > 0) {
            $ex_discount_ids = $discount_filter_values->pluck('filter_min_value', 'filter_value_id')->toArray();
            $discount_variant_in = '';
            foreach ($ex_discount_ids as $ex_discount_id) {

                $discount_variant_in .= '`filter_discount` >= ' . $ex_discount_id;
            }
            $products = $products->whereRaw("(" . $discount_variant_in . ")");
            // dd($products->get());
        }

        //filtering products based on ratings
        $ex_ratings_ids = [];
        if (isset($ratings_filter_ids) && count($ratings_filter_ids) > 0) {
            $ex_ratings_ids = $ratings_filter_values->pluck('filter_min_value', 'filter_value_id')->toArray();
            $ratings_variant_in = '';
            foreach ($ex_ratings_ids as $ex_ratings_id) {

                $ratings_variant_in .= '`rating` >= ' . $ex_ratings_id;
            }
            $products = $products->whereRaw("(" . $ratings_variant_in . ")");
            // dd($products->get());
        }
        // dd($products->get());
        // dd($color_variant_in);

        if ($data['filter_level'] == 'first') {
            $post_url .= '/sf/' . $category_slug;
            $products = $products->where('products.category_slug', $category_slug);
        } else if ($data['filter_level'] == 'second') {
            $post_url .= '/ss/' . $category_slug . '/' . $sub_category_slug;
            $products = $products->where('products.sub_category_slug', $sub_category_slug);
        } else if ($data['filter_level'] == 'third') {
            $post_url .= '/s/' . $category_slug . '/' . $sub_category_slug . '/' . $sub_sub_category_slug;
            $products = $products->where('products.sub_category_slug', $sub_category_slug)
                ->where('products.sub_sub_category_slug', $sub_sub_category_slug);
        }


        if ($sort_type == 'new-arrivals') {
            //   $products->orderBy(array('product_id'=>'DESC', 'new_arrival' => 'ASC'));
            // $homepagefeaturedproducts = FeaturedProducts::where('home_page_featured_product_code', 'new-arrivals')->pluck('product_id')->toArray();
            // $arrival_product_ids = $homepagefeaturedproducts[0];
            // if (isset($arrival_product_ids)) {
            //     $products->orderByRaw(DB::raw("FIELD(products.product_id, $arrival_product_ids) DESC"));
            // }
            $products->orderBy('new_arrival', 'DESC');
            // $products->where('new_arrival',1);
        } else if ($sort_type == 'recommended') {
            // $homepagefeaturedproducts = FeaturedProducts::where('home_page_featured_product_code', 'recommended')->pluck('product_id')->toArray();
            // $recommended_product_ids = $homepagefeaturedproducts[0];
            // // dd($recommended_product_ids);
            // $products->orderByRaw(DB::raw("FIELD(products.product_id, $recommended_product_ids) DESC"));
            // // $products->where('new_arrival',1);
            $products->orderBy('recommended', 'DESC');
        } else if ($sort_type == 'popularity') {
            // $products->where('new_arrival',1);
            //   $products->orderBy(array('product_id'=>'DESC', 'popularity' => 'ASC'));
            $products->orderBy('popularity', 'DESC');
        } else if ($sort_type == 'highest-discount') {
            //   $products->orderBy(array('product_id'=>'DESC', 'products.filter_discount' => 'DESC'));
            $products->orderBy('products.filter_discount', 'DESC');
        } else if ($sort_type == 'low-to-high') {
            //   $products->orderBy(array('product_id'=>'DESC', 'products.product_discounted_price' => 'ASC'));
            $products->orderBy('products.product_discounted_price', 'ASC');
        } else if ($sort_type == 'high-to-low') {
            //   $products->orderBy(array('product_id'=>'DESC', 'products.product_discounted_price' => 'DESC'));
            $products->orderBy('products.product_discounted_price', 'DESC');
        }
        // $products->groupBy('products.product_id');
        // dd($products->get());
        $product_count = 0;

        $products = $products->with(['product_images', 'size', 'product_variants', 'brands']);
        // => function ($query) use ($ex_size_ids)
        // {
        //                 if(count($ex_size_ids)>0)
        //                 {
        //                   $query->whereIn('size_id',$ex_size_ids);
        //                 }
        //             }
        $product_count = $products->get()->count();
        // if ($product_count > 40) {
        //     $products = $products->orderBy('products.product_id', 'desc')->paginate(40);
        // } else {
        //     $products = $products->orderBy('products.product_id', 'desc')->get();
        // }
        // $products = $products->orderBy('products.product_id', 'desc')->get
        $products = $products->orderBy('products.product_id', 'desc')->paginate(40);

        // $search .= '<span class="product-count" id="product-count"> ('.$product_count.')</span>';
        $size_list = Sizes::all();
        $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
            return [$item['size_id'] => $item['size_name']];
        });
        if (isset($products) && $product_count > 0) {

            $content = view('frontend.product.product_card', compact('products', 'size_list', 'sort_type'))->render();
            // $content = View::make('frontend.product.product_card')
            //             ->with('products', $products)->render();
            // $content = @include('frontend.product.product_card',compact('products'));

            // dd($content);

            return ['success', $content, $product_count, $post_url];
        } else {
            $content = view('frontend.product.product_not_found')->render();
            return ['error', $content, $product_count, $post_url];
        }
    }

    public function getproductvariantsget()
    {
        // $posts = $this->loginOptions();
        return true;
        // $this->layout->title = 'My title';
        // $content = View::make('frontend.product.test')
        //     ->with('title', $this->layout->title)
        //     ->with('posts', []);
        //
        // if (Request::header('X-PJAX'))
        //     return $content;
        // else
        //     $this->layout->content = $content;
    }

    public function deleteAll()
    {
        $recentViewProductDeleteAll = RecentlyViewed::where('user_id', Auth()->user()->id)->delete();
        return back()->with('success', 'Recently Viewed Products Removed');
    }

    public function verifypincode(Request $request)
    {
        $data = $request->all();
        $pincode = $data['shipping_pincode'];
        $cod_management = CODManagement::first();

        $pin_response = json_decode(verify_pincode($pincode), true);
        // dd($pin_response);
        if (isset($pin_response['delivery_codes'][0])) {
            if ($cod_management->status == 1) {
                $cod_response = $pin_response['delivery_codes'][0]['postal_code']['cod'];
            } else {
                $cod_response = 'C';
            }
        } else {
            $cod_response = 'N';
        }
        // dd($pin_response['delivery_codes'][0]['postal_code']['cod']);
        return [$cod_response];
    }

    public function allReviews($category_slug, $sub_category_slug, $sub_sub_category_slug, $product_slug)
    {
        // $allreviews=Review::where(['product_id'=>$product->product_id,'approval'=>1])->skip(2)->take(PHP_INT_MAX)->get();
        $product = Products::where('category_slug', $category_slug)->where('sub_category_slug', $sub_category_slug)->where('sub_sub_category_slug', $sub_sub_category_slug)->where('product_slug', $product_slug)->with(['product_images', 'country', 'seller', 'packer', 'importer', 'manufacturer', 'product_variants'])->first();

        $allreviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->get();
        $reviews = Review::where(['product_id' => $product->product_id, 'approval' => 1])->get();
        $countReviews = $reviews->count();
        $avgrates = $reviews->avg('rating');
        $calstar = DB::table('reviews')
            ->select('rating', DB::raw('count(*) as total'))
            ->where('product_id', $product->product_id)
            ->where('approval', 1)
            ->groupBy('rating')
            ->get();
        $percentage = array();
        foreach ($calstar as $cal) {
            if ($cal->rating == 1) {
                $percentage[1] = $cal->total / $countReviews * 100;
            }

            if ($cal->rating == 2) {
                $percentage[2] = $cal->total / $countReviews * 100;
            }
            if ($cal->rating == 3) {
                $percentage[3] = $cal->total / $countReviews * 100;
            }
            if ($cal->rating == 4) {
                $percentage[4] = $cal->total / $countReviews * 100;
            }
            if ($cal->rating == 5) {
                $percentage[5] = $cal->total / $countReviews * 100;
            }
        }

        return view('frontend.allratings.index', compact('allreviews', 'product', 'avgrates', 'countReviews', 'percentage'));
    }

    public function getfilters(Request $request)
    {
        $gender = $request->filter_gender;
        if (isset($gender) && $gender != '') {
            $assign_category_filters = AssignCategoryFilters::where(['category_id' => $gender, 'filter_level' => 'first'])->first();
            $products = Products::where('category_id', 1);
        }
        // else if($gender == 'female')
        // {
        //   $assign_category_filters = AssignCategoryFilters::where(['category_id'=>2,'filter_level'=>'first'])->first();
        //   $products = Products::where('category_id',2);
        // }
        else {
            $products = Products::all();
        }
        $filter_value_ids = [];
        $filter_ids = [];
        if (isset($assign_category_filters) && $assign_category_filters) {
            $filter_value_ids = explode(',', $assign_category_filters->filter_value_ids);
            $filter_ids = explode(',', $assign_category_filters->filter_ids);
        }
        $filters = Filters::with([
            'filtervalues' => function ($query) use ($filter_value_ids) {
                $query->whereIn('filter_value_id', $filter_value_ids);
            }
        ])->whereIn('filter_id', $filter_ids)->where('visibility', 1)->orderBy('sort_order', 'ASC')->get();
        // dd($filters);
        $filter_values_ids = [];
        $size_list = Sizes::all()->pluck('size_name', 'size_id');
        $content = view('frontend.product.product_filters', compact('filters', 'size_list', 'filter_values_ids'))->render();

        $response = ['filter_list' => $content]; //,'product_listing'=>$,'product_count'=>$

        return $content;
    }
}
