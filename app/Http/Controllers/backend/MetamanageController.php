<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\backend\Dailycodlimit;
use DB;
use Session;
use Validator;
use App\Models\backend\FakeOrderManagement;
use App\Models\backend\Metamanage;
use App\Models\frontend\PaymentMode;
use App\Models\frontend\User;

class MetamanageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $order_cancels = Metamanage::get();
    $users = User::get();
    // dd($order_cancels);
    return view('backend.metamanage.index', compact('order_cancels', 'users'));
  }

  public function create()
  {
    $users = User::get();
    // dd($users);
    $user_list = collect($users)->mapWithKeys(function ($item, $key) {
      return [$item['id'] => $item['email']];
    });
    // dd($user_list);
    return view('backend.metamanage.create', compact('user_list'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'meta_title' => 'required',
      'meta_desc' => 'required',
      'meta_keywords' => 'required',
      'og_title' => 'required',
      'og_desc' => 'required',
    ]);

    $order_cancel = new Metamanage();
    $order_cancel->fill($request->all());
    if ($order_cancel->save()) {
      return redirect()->route('admin.metamanage')->with('success', 'Meta Data Limit Added!');
    } else {
      return redirect()->route('admin.metamanage')->with('error', 'Something went wrong!');
    }
  }

  public function destroy($id)
  {
    $order_cancel = Metamanage::findOrFail($id);
    $order_cancel->delete();
    return redirect()->route('admin.metamanage')->with('success', 'Meta Data Deleted!');
  }

  public function edit($id)
  {

    $users = User::get();
    // dd($users);
    $user_list = collect($users)->mapWithKeys(function ($item, $key) {
      return [$item['id'] => $item['email']];
    });
    $order_cancel = Metamanage::findOrFail($id);
    return view('backend.metamanage.edit', compact('order_cancel', 'user_list'));
  }

  public function update(Request $request)
  {
    $order_cancel_days_id = $request->meta_id;
    // dd($order_cancel_days_id);

    $this->validate($request, [
        'meta_title' => 'required',
        'meta_desc' => 'required',
        'meta_keywords' => 'required',
        'og_title' => 'required',
        'og_desc' => 'required',
    ]);
    $order_cancel = Metamanage::findOrFail($order_cancel_days_id);

    $order_cancel->fill($request->all());
    if ($order_cancel->update()) {
      return redirect()->route('admin.metamanage')->with('success', 'Meta Data Updated!');
    } else {
      return redirect()->route('admin.metamanage')->with('error', 'Something went wrong!');
    }
  }
}
