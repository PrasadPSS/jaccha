<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\frontend\OrderReturnReasons;
use App\Models\frontend\PaymentMode;

class OrderreturnreasonsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $order_returns = OrderReturnReasons::orderBy('order_return_reason_id', 'asc')->get();
      // dd($order_returns);
      return view('backend.orderreturnreasons.index', compact('order_returns'));
  }

  public function create()
  {
    return view('backend.orderreturnreasons.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'order_return_reason_desc' => 'required',
      ]);

      $order_return = new OrderReturnReasons;
      $order_return->fill($request->all());
      if ($order_return->save())
      {
        return redirect()->route('admin.orderreturnreasons')->with('success', 'Order Return Reason Added!');
      }
      else
      {
        return redirect()->route('admin.orderreturnreasons')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $order_return = OrderReturnReasons::findOrFail($id);
    $order_return->delete();
    return redirect()->route('admin.orderreturnreasons')->with('success', 'Order Return Reason Deleted!');
  }

  public function edit($id)
  {
      $order_return = OrderReturnReasons::findOrFail($id);
      return view('backend.orderreturnreasons.edit', compact('order_return'));
  }

  public function update(Request $request)
  {
    $order_return_reason_id = $request->input('order_return_reason_id');
    $this->validate( $request, [
      'order_return_reason_desc' => 'required',
    ]);
    // echo "string".$order_return_reason_id;exit;
    // dd($request->all());
    // $order_return = new Colors();
    $order_return = OrderReturnReasons::findOrFail($order_return_reason_id);
    $order_return->fill($request->all());
    if ($order_return->update())
    {
      return redirect()->route('admin.orderreturnreasons')->with('success', 'Order Return Reason Updated!');
    }
    else
    {
      return redirect()->route('admin.orderreturnreasons')->with('error', 'Something went wrong!');
    }
  }
}
