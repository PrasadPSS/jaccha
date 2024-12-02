<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Filters;
use App\Models\backend\ProductImages;
use App\Models\backend\Products;
use App\Models\backend\Sizes;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{

  public function index(Request $request)
  {
      $search=$request->q;
    
        // $search = str_replace(" ", "%", $search);
        $products = Products::leftJoin('categories','categories.category_id','=','products.category_id')
                        ->leftJoin('subcategories','subcategories.subcategory_id','=','products.sub_category_id')
                        ->leftJoin('sub_subcategories','sub_subcategories.sub_subcategory_id','=','products.sub_sub_category_id')
                        ->leftJoin('brands','brands.brand_id','=','products.brand_id')
                       
                        ->when($search, function ($query, $search) {
                            return $query->where('products.product_title', 'LIKE', '%'.$search.'%')
                                            ->orWhere('categories.category_name', 'LIKE', '%'.$search.'%')
                                            ->orWhere('subcategories.subcategory_name', 'LIKE', '%'.$search.'%')
                                            ->orWhere('sub_subcategories.sub_subcategory_name', 'LIKE', '%'.$search.'%')
                                            ->orWhere('brands.brand_name', 'LIKE', '%'.$search.'%');
                                            
                        })
                         ->select('products.*','categories.category_name','subcategories.subcategory_name','sub_subcategories.sub_subcategory_name')
                            ->paginate(4);
     
      $filters = Filters::with('filtervalues')->where('visibility',1)->orderBy('sort_order','ASC')->get();
      $size_list = Sizes::all();
      $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
          return [$item['size_id'] => $item['size_name']];
      });
      return view('frontend.product.viewlist',compact('products','filters','size_list','search'));


  }

}
