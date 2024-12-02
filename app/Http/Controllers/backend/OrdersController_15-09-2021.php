<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Company;
use App\Models\backend\MissingPayments;

use App\Models\backend\SubSubCategories;
use App\Models\frontend\Orders;
use App\Models\frontend\ShippingAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\backend\PaymentInfo;


class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
      $orders=Orders::orderBy('order_id','DESC')->get();
        // $orders=DB::table('orders')
        //     ->join('users','users.id','=','orders.user_id')
        //     ->select('users.name','users.email','orders.orders_counter_id','orders.total',
        //        'orders.payment_tracking_code','orders.created_at','orders.order_id')
        //     ->get();
        return view('backend.orders.index', compact('orders'));
    }

    public function viewInvoice($id)
    {
        $orders = Orders::where('order_id',$id)->with(['orderproducts'])->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        return view('backend.orders.viewinvoice',compact('orders','shipping_address'));
    }

    public function downloadInvoice($id)
    {
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        $pdf=PDF::loadView('backend.orders.downloadinvoice',['orders'=>$orders,'shipping_address'=>$shipping_address]);
        return $pdf->download('dadreeiosinvoice.pdf');
    }

    public function details($id)
    {
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        $payment_details = PaymentInfo::where('transaction_id',$orders->transaction_id)->first();
        return view('backend.orders.viewdetails',compact('orders','shipping_address','payment_details'));
    }

    public function updatecodstatus(Request $request)
    {
      $payment_id = $request->input('payment_id');
      $this->validate( $request, [
        'status' => 'required',
      ]);
      $payment_details = PaymentInfo::where('payment_id',$payment_id)->first();
      $payment_details->fill($request->all());
      // dd($payment_details);
      if ($payment_details->update())
      {
        return back()->with('success', 'COD Payment Status Updated!');
      }
      else
      {
        return back()->with('error', 'Something went wrong!');
      }
    }

    public function updateprogress(Request $request)
    {
      $order_id = $request->input('order_id');
      $this->validate( $request, [
        'order_id' => 'required',
      ]);
      $order = Orders::where('order_id',$order_id)->first();
      $order->fill($request->all());
      $order->confirmed_stage = isset($request->confirmed_stage)?1:0;
      $order->preparing_order_stage = isset($request->preparing_order_stage)?1:0;
      $order->shipped_stage = isset($request->shipped_stage)?1:0;
      $order->out_for_delivery_stage = isset($request->out_for_delivery_stage)?1:0;
      $order->delivered_stage = isset($request->delivered_stage)?1:0;
      // dd($order);
      if ($order->update())
      {
        return back()->with('success', 'Order Progress Updated!');
      }
      else
      {
        return back()->with('error', 'Something went wrong!');
      }
    }


}
