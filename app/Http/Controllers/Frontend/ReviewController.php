<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\HomePageSections;
use App\Models\backend\Products;

use App\Models\backend\ProductVariants;
use App\Models\CartItem;

use App\Models\frontend\Cart;
use App\Models\frontend\Review;
use Illuminate\Http\Request;

use Inertia\Inertia;


class ReviewController extends Controller
{
    public function store(Request $request)
    {
        Review::insert([
            'product_id' => $request->product_id,
        	'user_id'	=> auth()->user()->id,
        	'username'=>auth()->user()->name,
        	'rating'=>$request->rating,
        	'headline' => '',
        	'comment'	=> $request->comment,
        	'approval' => 0]);

        return response()->json(['success'=>true]);
    }

    public function update(Request $request)
    {
        Review::where('user_id' , auth()->user()->id)->where('product_id', $request->product_id)
        ->update([
            'product_id' => $request->product_id,
        	'user_id'	=> auth()->user()->id,
        	'username'=>auth()->user()->name,
        	'rating'=>$request->rating,
        	'headline' => '',
        	'comment'	=> $request->comment,
        	'approval' => 0]);

        return response()->json(['success'=>true]);
    }

}
