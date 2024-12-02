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
        $orders=DB::table('orders')
            ->join('users','users.id','=','orders.user_id')
            ->select('users.name','users.email','orders.orders_counter_id','orders.total',
               'orders.payment_tracking_code','orders.created_at','orders.order_id')
            ->get();
        return view('backend.orders.index', compact('orders'));
    }

    public function viewInvoice($id){
        $orders = Orders::where('order_id',$id)->with(['orderproducts'])->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        return view('backend.orders.viewinvoice',compact('orders','shipping_address'));
    }

    public function downloadInvoice($id){
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        $pdf=PDF::loadView('backend.orders.downloadinvoice',['orders'=>$orders,'shipping_address'=>$shipping_address]);
        return $pdf->download('dadreeiosinvoice.pdf');
    }

    public function details($id){
        $orders=Orders::where('order_id',$id)->with('orderproducts')->first();
        $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
            $shipping_address = ShippingAddresses::where('user_id',$orders->user_id)->first();
        }
        return view('backend.orders.viewdetails',compact('orders','shipping_address'));
    }



}
