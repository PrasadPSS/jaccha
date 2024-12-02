<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\frontend\OrderCancellationReasons;
use App\Models\frontend\PaymentMode;

class OrdercancelreasonsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $order_cancels = OrderCancellationReasons::orderBy('order_cancellation_reason_id', 'asc')->get();
      // dd($order_cancels);
      return view('backend.ordercancelreasons.index', compact('order_cancels'));
  }

  public function create()
  {
    return view('backend.ordercancelreasons.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'order_cancellation_reason_desc' => 'required',
      ]);

      $order_cancel = new OrderCancellationReasons;
      $order_cancel->fill($request->all());
      if ($order_cancel->save())
      {
        return redirect()->route('admin.ordercancelreasons')->with('success', 'Order Cancel Reason Added!');
      }
      else
      {
        return redirect()->route('admin.ordercancelreasons')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $order_cancel = OrderCancellationReasons::findOrFail($id);
    $order_cancel->delete();
    return redirect()->route('admin.ordercancelreasons')->with('success', 'Order Cancel Reason Deleted!');
  }

  public function edit($id)
  {
      $order_cancel = OrderCancellationReasons::findOrFail($id);
      return view('backend.ordercancelreasons.edit', compact('order_cancel'));
  }

  public function update(Request $request)
  {
    $order_cancellation_reason_id = $request->input('order_cancellation_reason_id');
    $this->validate( $request, [
      'order_cancellation_reason_desc' => 'required',
    ]);
    // echo "string".$order_cancellation_reason_id;exit;
    // dd($request->all());
    // $order_cancel = new Colors();
    $order_cancel = OrderCancellationReasons::findOrFail($order_cancellation_reason_id);
    $order_cancel->fill($request->all());
    if ($order_cancel->update())
    {
      return redirect()->route('admin.ordercancelreasons')->with('success', 'Order Cancel Reason Updated!');
    }
    else
    {
      return redirect()->route('admin.ordercancelreasons')->with('error', 'Something went wrong!');
    }
  }
}
