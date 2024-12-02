<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\OrderDeliveryManagement;
use App\Models\frontend\PaymentMode;

class OrderdeliverymanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $order_deliverys = OrderDeliveryManagement::orderBy('order_delivery_management_id', 'desc')->get();
      // dd($order_deliverys);
      return view('backend.orderdeliverymanagement.index', compact('order_deliverys'));
  }

  public function create()
  {
      return view('backend.orderdeliverymanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'order_delivery_max_days' => 'required',
        'order_delivery_max_hours' => 'required',
      ]);

      $order_delivery = new OrderDeliveryManagement;
      $order_delivery->fill($request->all());
      if ($order_delivery->save())
      {
        return redirect()->route('admin.orderdeliverymanagement')->with('success', 'Order Delivery Setting Added!');
      }
      else
      {
        return redirect()->route('admin.orderdeliverymanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $order_delivery = OrderDeliveryManagement::findOrFail($id);
    $order_delivery->delete();
    return redirect()->route('admin.orderdeliverymanagement')->with('success', 'COD Setting Deleted!');
  }

  public function edit($id)
  {
      $order_delivery = OrderDeliveryManagement::findOrFail($id);
      return view('backend.orderdeliverymanagement.edit', compact('order_delivery'));
  }

  public function update(Request $request)
  {
    $order_delivery_management_id = $request->input('order_delivery_management_id');
    $this->validate( $request, [
      'order_delivery_max_days' => 'required',
    ]);
    // echo "string".$order_delivery_management_id;exit;
    // dd($request->all());
    // $order_delivery = new Colors();
    $order_delivery = OrderDeliveryManagement::findOrFail($order_delivery_management_id);
    $order_delivery->fill($request->all());
    if ($order_delivery->update())
    {
      return redirect()->route('admin.orderdeliverymanagement')->with('success', 'Order Delivery Setting Updated!');
    }
    else
    {
      return redirect()->route('admin.orderdeliverymanagement')->with('error', 'Something went wrong!');
    }
  }
}
