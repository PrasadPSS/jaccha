<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

        $cartItem = CartItem::findOrFail($request->item_id);
        $cartItem->quantity += 1;
        $cartItem->save();

        // Update the total in the cart
        $cart = Cart::findOrFail($cartItem->cart_id);
        $cart->total += $cartItem->product->price;
        $cart->save();

        return response()->json(['updated_quantity' => $cartItem->quantity]);
    }

    public function decreaseQuantity(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->item_id);
        
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();

            // Update the total in the cart
            $cart = Cart::findOrFail($cartItem->cart_id);
            $cart->total -= $cartItem->product->price;
            $cart->save();
        }

        return response()->json(['updated_quantity' => $cartItem->quantity]);
    }

    public function removeItem(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->item_id);
        $cart = Cart::findOrFail($cartItem->cart_id);

        // Update the total in the cart
        $cart->total -= $cartItem->quantity * $cartItem->product->price;
        $cart->save();

        // Delete the cart item
        $cartItem->delete();

        return response()->json(['message' => 'Item removed']);
    }
}
