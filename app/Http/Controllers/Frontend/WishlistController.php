<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Wishlists;
use Inertia\Inertia;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $data['wishlist'] = Wishlists::where('user_id', auth()->user()->id)->with('products')->get();

        return Inertia::render('Frontend/Wishlist/Index', $data);
    }

    public function add(Request $request)
    {
      $user_id = auth()->user()->id;

      // dd($request->all());


      $product_id = $request->product_id;


      $product_exist_in_wishlist = Wishlists::where('user_id',$user_id)->Where('product_id',$product_id)->first();
      if($product_exist_in_wishlist)
      {
        return back()->with('error','Product is alredy in your Wishlist !');
      }
      else
      {
        $add_wishlist = new Wishlists();
        $add_wishlist->user_id = $user_id;
        $add_wishlist->product_id = $product_id;

        $add_wishlist->save();
        return redirect()->back()->with('success', 'Product Added to Wishlist');
      }
    }

    public function addtocart(Request $request)
    {
       $product_id = $request->product_id;
       $quantity = $request->quantity;
       
       return redirect()->route('product.index');
    }
    
    public function delete(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        Wishlists::where('user_id', $user_id)->where('product_id', $product_id)->delete();

        return redirect()->back()->with('success', 'Product Removed from wishlist');
    }
}
