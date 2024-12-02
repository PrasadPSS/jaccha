<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\OrderReturnManagement;
use App\Models\frontend\PaymentMode;

class OrderreturnmanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $order_returns = OrderReturnManagement::orderBy('order_return_id', 'desc')->get();
      // dd($order_returns);
      return view('backend.orderreturnmanagement.index', compact('order_returns'));
  }

  public function create()
  {
      return view('backend.orderreturnmanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'order_return_max_days' => 'required',
        'order_return_max_hours' => 'required',
      ]);

      $order_return = new OrderReturnManagement;
      $order_return->fill($request->all());
      if ($order_return->save())
      {
        return redirect()->route('admin.orderreturnmanagement')->with('success', 'Order Return Setting Added!');
      }
      else
      {
        return redirect()->route('admin.orderreturnmanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $order_return = OrderReturnManagement::findOrFail($id);
    $order_return->delete();
    return redirect()->route('admin.orderreturnmanagement')->with('success', 'COD Setting Deleted!');
  }

  public function edit($id)
  {
      $order_return = OrderReturnManagement::findOrFail($id);
      return view('backend.orderreturnmanagement.edit', compact('order_return'));
  }

  public function update(Request $request)
  {
    $order_return_id = $request->input('order_return_id');
    $this->validate( $request, [
      'order_return_max_days' => 'required',
    ]);
    // echo "string".$order_return_id;exit;
    // dd($request->all());
    // $order_return = new Colors();
    $order_return = OrderReturnManagement::findOrFail($order_return_id);
    $order_return->fill($request->all());
    if ($order_return->update())
    {
      return redirect()->route('admin.orderreturnmanagement')->with('success', 'Order Return Setting Updated!');
    }
    else
    {
      return redirect()->route('admin.orderreturnmanagement')->with('error', 'Something went wrong!');
    }
  }
}
