<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\FakeOrderManagement;
use App\Models\frontend\PaymentMode;
use App\Models\frontend\User;

class FakeordermanagementController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $order_cancels = FakeOrderManagement::get();
    $users = User::get();
    // dd($order_cancels);
    return view('backend.fakeordermanagement.index', compact('order_cancels', 'users'));
  }

  public function create()
  {
    $users = User::get();
    // dd($users);
    $user_list = collect($users)->mapWithKeys(function ($item, $key) {
      return [$item['id'] => $item['email']];
    });
    // dd($user_list);
    return view('backend.fakeordermanagement.create', compact('user_list'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'status' => 'required',
      // 'count' => 'required',
    ]);

    $order_cancel = new FakeOrderManagement;
    $order_cancel->fill($request->all());
    if ($order_cancel->save()) {
      return redirect()->route('admin.fakeordermanagement')->with('success', 'Cod Limit Added!');
    } else {
      return redirect()->route('admin.fakeordermanagement')->with('error', 'Something went wrong!');
    }
  }

  public function destroy($id)
  {
    $order_cancel = FakeOrderManagement::findOrFail($id);
    $order_cancel->delete();
    return redirect()->route('admin.fakeordermanagement')->with('success', 'COD Setting Deleted!');
  }

  public function edit($id)
  {

    $users = User::get();
    // dd($users);
    $user_list = collect($users)->mapWithKeys(function ($item, $key) {
      return [$item['id'] => $item['email']];
    });
    $order_cancel = FakeOrderManagement::findOrFail($id);
    return view('backend.fakeordermanagement.edit', compact('order_cancel', 'user_list'));
  }

  public function update(Request $request)
  {
    $order_cancel_days_id = $request->fake_order_id;
    // dd($order_cancel_days_id);

    $this->validate($request, [
      'user_id' => 'required',
      'status' => 'required',
      // 'count' => 'required',
    ]);
    $order_cancel = FakeOrderManagement::findOrFail($order_cancel_days_id);

    $order_cancel->fill($request->all());
    if ($order_cancel->update()) {
      return redirect()->route('admin.fakeordermanagement')->with('success', 'Cod Limit Updated!');
    } else {
      return redirect()->route('admin.fakeordermanagement')->with('error', 'Something went wrong!');
    }
  }
}
