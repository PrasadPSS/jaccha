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
        info('worked44');

        info('worked2');
        $photoPath = null;
        if ($request->hasFile('photo')) {
            
            $photoPath = $request->file('photo')->store('reviews', 'public');
            info('hasphoto' . $photoPath);
        }
        info('worked3');
        Review::create([
            'product_id' => $request['product_id'],
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->name,
            'rating' => $request['rating'],
            'headline' => $request['headline'],
            'comment' => $request['comment'],
            'photo' => $photoPath,
        ]);
        info('worked4');

        return response()->json(['message' => 'Review submitted successfully!'], 201);
        // Review::insert([
        //     'product_id' => $request->product_id,
        // 	'user_id'	=> auth()->user()->id,
        // 	'username'=>auth()->user()->name,
        // 	'rating'=>$request->rating,
        // 	'headline' => '',
        // 	'comment'	=> $request->comment,
        // 	'approval' => 0]);

        // return response()->json(['success'=>true]);
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
