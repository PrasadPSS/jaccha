<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Products;
use App\Models\frontend\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function index()
   {
        $data['cart'] = Cart::where('user_id', auth()->user()->id)->with('products')->get();


        return Inertia::render('Frontend/Cart/Index', $data);
   }

   public function increaseQuantity(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->first();
        $product = Products::where('product_id', $request->item_id)->first();
        Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->update(['qty'=> $cart->qty + 1, 'price' => $product->product_price * ($cart->qty + 1)]);



        return response()->json(['updated_quantity' => 111]);
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->first();
    
        if (!$cart || $cart->qty <= 1) {
            return response()->json(['error' => 'Quantity cannot be decreased further'], 400);
        }
    
        $product = Products::where('product_id', $request->item_id)->first();
    
        Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $request->item_id)
            ->update([
                'qty' => $cart->qty - 1,
                'price' => $product->product_price * ($cart->qty - 1),
            ]);
    
        return response()->json(['updated_quantity' => $cart->qty - 1]);
    }
    

    public function removeItem(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->delete();


        return response()->json(['message' => 'Item removed']);
    }
}
