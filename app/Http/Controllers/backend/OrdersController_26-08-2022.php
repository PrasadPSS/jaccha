<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Company;
use App\Models\backend\MissingPayments;

use App\Models\backend\SubSubCategories;
use App\Models\frontend\Orders;
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\ShippingAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\backend\PaymentInfo;
use App\Models\frontend\OrderCancellationReasons;


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
        $orders=Orders::where('order_id',$id)->with('orderproducts','cancelreason')->first();
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
      if ($order->cancel_order_flag==1)
      {
        return back()->with('error', 'Order already cancelled, unable to update the order status!');
      }
      else if ($order->order_return_flag==1)
      {
        return back()->with('error', 'Order already returing, unable to update the order status!');
      }
      else
      {
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
      }
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

    public function create_package_order($id)
    {
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        if ($orders)
        {
          if ($orders->cancel_order_flag==1)
          {
            return back()->with('error', 'Order already cancelled, unable to create package!');
          }
          if ($orders->package_order_status==0)
          {
            // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
            // $bulk_waybills = create_bulk_waybill($product_qty);
            $order_creation_response = order_creation($orders);
            $order_creation_response = json_decode($order_creation_response,true);
            // dd($order_creation_response);
            if ($order_creation_response['success']==true)
            {
              $orderDate = date('Y-m-d');
              $orderDate = date('Y-m-d', strtotime($orderDate));
              $orders->package_order_status=1;
              $orders->package_order_dump = json_encode($order_creation_response);
              $orders->package_order_date=$orderDate;
              $orders->wbn=$order_creation_response['upload_wbn'];

              if (isset($order_creation_response['packages']) && count($order_creation_response['packages'])>0)
              {
                foreach ($order_creation_response['packages'] as $order_package)
                {
                  // $order_product = OrdersProductDetails::Where('orders_product_details_id',$order_package['refnum'])->first();
                  // if ($order_product)
                  // {
                  //   $order_product->package_waybill = $order_package['waybill'];
                  //   $order_product->package_item_dump = json_encode($order_package);
                  //   $order_product->update();
                  // }
                  //after merging the items
                  $orders->package_waybill=$order_package['waybill'];
                  $orders->package_item_dump=json_encode($order_package);
                }
              }
              if ($orders->update())
              {
                // dd($order_creation_response);
                return back()->with('success', 'Package Order created Successfully!');
              }
              else
              {
                return back()->with('error', 'Something went wrong!');
              }
            }
            else
            {
              // dd($order_creation_response);
              return back()->with('error', 'Something went wrong while creating the package order!');
            }
            // dd($order_creation_response);
          }
          else
          {
            return back()->with('error', 'Package Order already created!');
          }
        }
        else
        {
          return back()->with('error', 'Order Not Found!');
        }

    }

    public function track_order($id)
    {
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        if ($orders)
        {
          if ($orders->package_order_status==0)
          {
            // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
            // $bulk_waybills = create_bulk_waybill($product_qty);
            $order_creation_response = order_creation($orders);
            $order_creation_response = json_decode($order_creation_response,true);
            // dd($order_creation_response);exit;
            if ($order_creation_response['success']==true)
            {
              $orderDate = date('Y-m-d');
              $orderDate = date('Y-m-d', strtotime($orderDate));
              $orders->package_order_status=1;
              $orders->package_order_dump = json_encode($order_creation_response);
              $orders->package_order_date=$orderDate;

              if ($orders->update())
              {
                return back()->with('success', 'Package Order created Successfully!');
              }
              else
              {
                return back()->with('error', 'Something went wrong!');
              }
            }
            else
            {
              // dd($order_creation_response);exit;
              return back()->with('error', 'Something went wrong while creating the package order!');
            }
          }
          else
          {
            return back()->with('error', 'Package Order already created!');
          }
        }
        else
        {
          return back()->with('error', 'Order Not Found!');
        }

    }


    public function generate_pacakge_slips($id)
    {
      $package_slip_responses = [];
      $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
      if ($orders)
      {
        if ($orders->cancel_order_flag==1)
        {
          return back()->with('error', 'Order already cancelled, unable to create slips!');
        }
        // else if ($orders->order_return_flag==1)
        // {
        //   return back()->with('error', 'Order already returing, unable to update the order status!');
        // }
        if ($orders->package_order_status==1)
        {
          // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
          // $bulk_waybills = create_bulk_waybill($product_qty);
          // foreach ($orders->orderproducts as $orderproduct)
          // {
            $package_slip_response = packing_slip($orders->package_waybill);
            $package_slip_responses = json_decode($package_slip_response,true);
            // dd($package_slip_responses);//exit;
          // }
          return view('backend.orders.viewpackageslips',compact('orders','package_slip_responses'));
        }
        else
        {
          return back()->with('error', 'Package Order Not created!');
        }
      }
      else
      {
        return back()->with('error', 'Order Not Found!');
      }

    }

    public function generate_product_labels($id)
    {
      // $package_slip_responses = [];
      $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
      if ($orders)
      {
        if ($orders->preparing_order_stage==1)
        {
          // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
          // $bulk_waybills = create_bulk_waybill($product_qty);
          // foreach ($orders->orderproducts as $orderproduct)
          // {
          //   $package_slip_response = packing_slip($orderproduct->package_waybill);
          //   $package_slip_responses[$orderproduct->orders_product_details_id] = json_decode($package_slip_response,true);
          //   // dd($package_slip_responses);exit;
          // }
          return view('backend.orders.viewproductlabels',compact('orders'));
        }
        else
        {
          return back()->with('error', 'Package Not ready!');
        }
      }
      else
      {
        return back()->with('error', 'Order Not Found!');
      }

    }

    public function updatereturnstatus(Request $request)
    {
      $order_id = $request->input('order_id');
      $this->validate( $request, [
        'order_return_status' => 'required',
      ]);
      $date_time = date('Y-m-d h:i:s');
      $date_time = date('Y-m-d h:i:s', strtotime($date_time));

      $order = Orders::where('order_id',$order_id)->first();
      $order->order_return_status_date = $date_time;
      $order->fill($request->all());
      // dd($order);
      if ($order->update())
      {
        return back()->with('success', 'Order Return Status Updated!');
      }
      else
      {
        return back()->with('error', 'Something went wrong!');
      }
    }

    public function cancelorder($id)
    {
      $orders = Orders::where('order_id',$id)->with('orderproducts')->first();
      if ($orders->cancel_order_flag==1)
      {
        return back()->with('error','Order already cancelled');
      }
      // else if($orders->shipped_stage==1)
      // {
      //   return back()->with('error','Order already Shipped');
      // }
      else if($orders->delivered_stage==1)
      {
        return back()->with('error','Order already Delivered');
      }
      else if($orders->order_return_flag==1)
      {
        return back()->with('error','Order already Returned');
      }
      $reasons = OrderCancellationReasons::where('for_dadreeios',1)->get()->pluck('order_cancellation_reason_desc','order_cancellation_reason_id');
      return view('backend.orders.cancel_order',compact('orders','reasons'));
      // return redirect()->to('/myaccount/profile');
    }

    public function cancelorderstatus(Request $request)
    {
      $id = $request->order_id;
      $user_id = auth()->user()->id;
      $this->validate(request(), [
        'order_id' => 'required',
        'order_cancellation_reason_id' => 'required',
      ]);
      // echo "string";exit;
      $date_time = date('Y-m-d h:i:s');
      $date_time = date('Y-m-d h:i:s', strtotime($date_time));

      $reasons = OrderCancellationReasons::where('order_cancellation_reason_id',$request->order_cancellation_reason_id)->first();
      $orders = Orders::where('order_id',$id)->with('orderproducts')->first();
      if ($orders->cancel_order_flag==1)
      {
        return back()->with('error','Order already cancelled');
      }
      else if($orders->delivered_stage==1)
      {
        return back()->with('error','Order already Delivered');
      }
      else if($orders->order_return_flag==1)
      {
        return back()->with('error','Order already Returned');
      }
      $orders->cancel_order_flag = 1;
      $orders->cancel_order_date = $date_time;
      $orders->order_cancellation_reason_id = $reasons->order_cancellation_reason_id;
      $orders->cancel_reason = $reasons->order_cancellation_reason_desc;
      if($orders->fill($request->all())->update())//->update()
      {
        //cancel delivery order if exists
        if ($orders->package_order_status == 1)
        {
          if (isset($orders->package_waybill) && $orders->package_waybill != "")
          {
            $waybill = $orders->package_waybill;
            if($waybill != '')
            {
              $orderproduct_cancel = order_cancellation($waybill);
              $orderproduct_cancel = simplexml_load_string($orderproduct_cancel);
              $orderproduct_cancel = json_encode($orderproduct_cancel);
              $orderproduct_cancel = json_decode($orderproduct_cancel,true);
              // dd($orderproduct_cancel);
              if($orderproduct_cancel != null && $orderproduct_cancel['status']==true)
              {
                $orders->package_cancel_return_status = 1;
                $orders->package_cancel_return_dump = json_encode($orderproduct_cancel);
              }
              else
              {
                $orders->package_cancel_return_status = 0;
              }
            }
            $orders->update();
          }
        }
        return redirect()->to('admin/orders/details/'.$id)->with('success','Order Cancelled Successfully');
      }
      else
      {
        return back()->with('error', 'Something went wrong!');
      }

    }
    

}
