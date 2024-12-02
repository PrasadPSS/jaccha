<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Footer;
use App\Models\backend\FooterIds;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
       $reviews=DB::table('reviews')
           ->join('products','products.product_id','=','reviews.product_id')
           ->select('products.product_title','reviews.*')
           ->get();
       return view('backend.reviews.index',compact('reviews'));
    }

    public function action($id){
        $review=Review::where('id',$id)->first();
        if($review->approval==0) {
            $review = DB::table('reviews')
                ->where('id', $id)
                ->update(array(
                    'approval' => 1
                ));
            return redirect()->route('admin.reviews')->with('success', 'Review Approved!!!');

        }

        else{
            $review = DB::table('reviews')
                ->where('id', $id)
                ->update(array(
                    'approval' => 0
                ));
            return redirect()->route('admin.reviews')->with('success', 'Review Disapproved!!!');

        }
    }

}
