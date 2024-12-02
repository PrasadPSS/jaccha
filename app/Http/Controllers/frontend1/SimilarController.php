<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProductImages;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;
use Illuminate\Support\Facades\DB;


class SimilarController extends Controller
{

  public function index($product_id)
  {
      $relatedProducts=DB::table('related_products')
          ->join('products','products.product_id','=','related_products.related_product_list_id')
          ->leftjoin('brands','brands.brand_id','=','products.brand_id')
          ->where('related_products.product_id',$product_id)
          ->get();


      $imageList = [];
      foreach ($relatedProducts as $relatedProduct) {
          $productImages = ProductImages::where('product_id', $relatedProduct->related_product_list_id)->first();
          if($productImages) {
              $imageList[$relatedProduct->related_product_list_id] = $productImages->image_name;
          }
      }
    return view('frontend.similar.index',compact('relatedProducts','imageList'));
  }

}
