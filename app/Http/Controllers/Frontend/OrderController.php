<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Inertia\Inertia;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function checkout()
   {
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $order = Order::create(['user_id'=>auth()->user()->id, 'total'=> $cart->total]);
        $paymentDetail = PaymentDetail::create(['order_id'=>$order->id, 'amount'=>$order->total, 'status'=> PaymentDetail::PAYMENT_INCOMPLETE]);
        Order::where('id', $order->id)->update(['payment_id'=>$paymentDetail->id]);
        $orderItems= [];
        foreach($cartItems as $cartItem)
        {
            $orderItems[] = ['order_id' => $order->id, 'product_id' => $cartItem->product_id, 'quantity'=> $cartItem->quantity];
        }
        OrderItem::insert($orderItems);
        CartItem::where('cart_id', $cart->id)->delete();
        Cart::where('user_id', auth()->user()->id)->update(['total'=>0]);

        return redirect()->route('order.index');
   }

   public function index()
   {
        $data['orders'] = Order::where('user_id', auth()->user()->id)->with('order_items', 'order_items.product', 'payment_details')->get();

        return Inertia::render('Frontend/Orders/ViewOrder', $data);
   }
}
