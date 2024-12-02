<?php

namespace App\Http\Controllers\frontend;

use App\Models\backend\Faqs;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Products;
use App\Http\Controllers\Controller;
use App\Models\backend\SpecialDeals;
use App\Models\backend\ProductImages;
use App\Models\backend\DealsProductId;
use Carbon\Carbon;

class DealsController extends Controller
{

  public function index()
  {
    $today=date('M d,Y',strtotime(Carbon::now()));
     $specialdeals=SpecialDeals::first();
     $dealsproductsid = DealsProductId::where('specialdealsid', $specialdeals->id)->get();
     foreach($dealsproductsid as $dealsproductid){
       $products[]=Products::where('product_id',$dealsproductid->product_id)->first();
       $productImages = ProductImages::where('product_id', $dealsproductid->product_id)->first();
       if($productImages) {
        $imageList[$dealsproductid->product_id] = $productImages->image_name;
        }
     }
    //  dd($dealsproductsid, $imageList);

    return view('frontend.deals.index',compact('specialdeals','products','imageList','today'));
  }
}
