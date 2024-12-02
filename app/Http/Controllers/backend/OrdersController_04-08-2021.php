<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

use App\Models\backend\Orders;
use App\Models\backend\PaymentInfo;
use App\Models\backend\Shipping;
use App\Models\backend\OrdersProductDetails;
use App\Models\backend\Products;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Orders::with(['users'])->orderBy('order_id', 'DESC')->get();
        //join("users","users.id","=","orders.user_id")->
        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $gst = Gst::get();
      $gst_list = [];
      if($gst)
      {
        $gst_list = collect($gst)->mapWithKeys(function ($item, $key) {
          return [$item['gst_percent'] => $item['gst_name']];
        });
      }
        return view('backend.products.create',compact('gst_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        Products::create($request->all());

        Session::flash('message', 'Products added!');
        Session::flash('status', 'success');

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orders = Orders::where('order_id',$id)->join("payment_info","payment_info.payment_tracking_code","=","orders.payment_tracking_code")->orderBy('order_id', 'DESC')->first();
        //->join("users","users.id","=","orders.user_id")
        $products = Orders::selectRaw('orders.*,orders_product_details.*,product.name')->leftJoin('orders_product_details', function($join) {
        $join->on('orders_product_details.order_id', '=', 'orders.order_id');
      })->join('product', 'product.product_id', '=', 'orders_product_details.product_id')->Where('orders.order_id',$id)->get();
        $payment = PaymentInfo::where('payment_tracking_code',$orders->payment_tracking_code)->first();
        return view('backend.orders.show', compact('orders','products','payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $gst = Gst::get();
        $gst_list = [];
        if($gst)
        {
          $gst_list = collect($gst)->mapWithKeys(function ($item, $key) {
            return [$item['gst_percent'] => $item['gst_name']];
          });
        }
        return view('backend.products.edit', compact('product','gst_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $orders = Orders::findOrFail($id);
        if($orders)
        {
          $payment = PaymentInfo::where('payment_tracking_code',$orders->payment_tracking_code)->first();
          if($payment)
          {
            if($payment->status != $request->status and $orders->manual_order == '')
            {
              $payment->status = $request->status;
              $payment->save();
            }

            // if manual payment
            if($orders->manual_order == 1)
            {
              $payment->status = 'complete';
              $payment->manual_payment_type = $request->manual_payment_type;
              $payment->cheque_no = $request->cheque_no;
              $payment->bank_name = $request->bank_name;
              $payment->cheque_dated = $request->cheque_dated;
              $payment->transaction_no = $request->transaction_no;
              $payment->save();
            }
          }

        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orders = Orders::findOrFail($id);
        $order_id = $orders->order_id;
        $product_orders = OrdersProductDetails::where('order_id', '=', $order_id)->get();
        foreach ($product_orders as $products)
        {
          $product = Products::where('product_id',$products->product_id)->first();
          $product->qty = $product->qty + $products->qty;
          $product->save();
        }
        DB::table('orders_product_details')->where('order_id', '=', $order_id)->delete();
        $orders->delete();

        return redirect('admin/orders');
    }

}
