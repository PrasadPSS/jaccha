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
        $company = Company::first();
        return view('backend.orders.viewinvoice',compact('orders','shipping_address','company'));
    }

    public function downloadInvoice($id)
    {
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();

        $company = Company::first();
        $pdf=PDF::loadView('backend.orders.downloadinvoice',['orders'=>$orders,'company'=>$company]);
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
        //diable progress checkbox
        $shipped_disable = false;
        if ($orders->shipped_stage == 1)
        {
          $shipped_disable = true;
        }
        if ($orders->confirmed_stage == 1 && $shipped_disable == false)
        {
          $preparing_order_stage = false;
        }
        else
        {
          $preparing_order_stage = true;
        }
        if ($orders->preparing_order_stage == 1 && $shipped_disable == false)
        {
          $shipped_stage = false;
        }
        else
        {
          $shipped_stage = true;
        }
        if ($orders->shipped_stage == 1)
        {
          $out_for_delivery_stage = false;
        }
        else
        {
          $out_for_delivery_stage = true;
        }
        if ($orders->out_for_delivery_stage == 1)
        {
          $delivered_stage = false;
        }
        else
        {
          $delivered_stage = true;
        }

        return view('backend.orders.viewdetails',compact('orders','shipping_address','payment_details','shipped_disable','preparing_order_stage','shipped_stage','out_for_delivery_stage','delivered_stage'));
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
      $date_time = date('Y-m-d h:i:s');
      $date_time = date('Y-m-d h:i:s', strtotime($date_time));

      $order = Orders::where('order_id',$order_id)->first();
      //dates
      $order->confirmed_date = (isset($request->confirmed_stage)&&$order->confirmed_date==""&&$order->confirmed_stage==0)?$date_time:$order->confirmed_date;
      $order->preparing_order_date = (isset($request->preparing_order_stage)&&$order->preparing_order_date==""&&$order->preparing_order_stage==0)?$date_time:$order->preparing_order_date;
      $order->shipped_date = (isset($request->shipped_stage)&&$order->shipped_date==""&&$order->shipped_stage==0)?$date_time:$order->shipped_date;
      $order->out_for_delivery_date = (isset($request->out_for_delivery_stage)&&$order->out_for_delivery_date==""&&$order->out_for_delivery_stage==0)?$date_time:$order->out_for_delivery_date;
      $order->delivered_date = (isset($request->delivered_stage)&&$order->delivered_date==""&&$order->delivered_stage==0)?$date_time:$order->delivered_date;

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
