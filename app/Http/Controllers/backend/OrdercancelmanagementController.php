<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\OrderCancelManagement;
use App\Models\frontend\PaymentMode;

class OrdercancelmanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $order_cancels = OrderCancelManagement::orderBy('order_cancel_days_id', 'desc')->get();
      // dd($order_cancels);
      return view('backend.ordercancelmanagement.index', compact('order_cancels'));
  }

  public function create()
  {
      return view('backend.ordercancelmanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'order_cancel_max_days' => 'required',
        'order_cancel_max_hours' => 'required',
      ]);

      $order_cancel = new OrderCancelManagement;
      $order_cancel->fill($request->all());
      if ($order_cancel->save())
      {
        return redirect()->route('admin.ordercancelmanagement')->with('success', 'Order Cancel Settings Added!');
      }
      else
      {
        return redirect()->route('admin.ordercancelmanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $order_cancel = OrderCancelManagement::findOrFail($id);
    $order_cancel->delete();
    return redirect()->route('admin.ordercancelmanagement')->with('success', 'COD Setting Deleted!');
  }

  public function edit($id)
  {
      $order_cancel = OrderCancelManagement::findOrFail($id);
      return view('backend.ordercancelmanagement.edit', compact('order_cancel'));
  }

  public function update(Request $request)
  {
    $order_cancel_days_id = $request->input('order_cancel_days_id');
    $this->validate( $request, [
      'order_cancel_max_days' => 'required',
      'order_cancel_max_hours' => 'required',
    ]);
    // echo "string".$order_cancel_days_id;exit;
    // dd($request->all());
    // $order_cancel = new Colors();
    $order_cancel = OrderCancelManagement::findOrFail($order_cancel_days_id);
    $order_cancel->fill($request->all());
    if ($order_cancel->update())
    {
      return redirect()->route('admin.ordercancelmanagement')->with('success', 'Order Cancel Settings Updated!');
    }
    else
    {
      return redirect()->route('admin.ordercancelmanagement')->with('error', 'Something went wrong!');
    }
  }
}
