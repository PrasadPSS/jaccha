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
        $data['wishlist'] = Wishlists::where('user_id', auth()->user()->id)->with('product')->get();

        return Inertia::render('Frontend/Wishlist/Index', $data);
    }

    public function add($product_id)
    {
        Wishlists::create(['user_id'=> auth()->user()->id, 'product_id' => $product_id]);

        return redirect()->back();
    }

    public function addtocart(Request $request)
    {
       $product_id = $request->product_id;
       $quantity = $request->quantity;
       $product = Product::where('id', $product_id)->first();
       $cart = Cart::where('user_id', auth()->user()->id)->first();
       Cart::where('user_id', auth()->user()->id)->update(['total'=> (int)$cart->total + (int)($product->price * $quantity) ]);
       CartItem::create(['cart_id' => $cart->id, 'product_id' => $product_id, 'quantity' => $quantity]);
 
       return redirect()->route('product.index');
    }
    
    public function delete(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->delete();

        return redirect()->back();
    }
}
