<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\Coupons;

class CouponController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $coupons = Coupons::orderBy('coupon_id', 'desc')->get();
      // dd($coupons);
      return view('backend.coupon.index', compact('coupons'));
  }

  public function create()
  {
      return view('backend.coupon.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'coupon_code' => 'required',
        'coupon_title' => 'required',
        'value' => 'required',
      ]);

      $coupon = new Coupons;
      $coupon->fill($request->all());

      if ($coupon->save())
      {
        return redirect()->route('admin.coupon')->with('success', 'New Coupon Added!');
      }
      else
      {
        return redirect()->route('admin.coupon')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $coupon = Coupons::findOrFail($id);
    $coupon->delete();
    return redirect()->route('admin.coupon')->with('success', 'Coupon Deleted!');
  }

  public function edit($id)
  {
      $coupon = Coupons::findOrFail($id);
      return view('backend.coupon.edit', compact('coupon'));
  }

  public function update(Request $request)
  {
    $coupon_id = $request->input('coupon_id');
    $this->validate( $request, [
      'coupon_code' => 'required',
      'coupon_title' => 'required',
      'value' => 'required',
    ]);
    // echo "string".$coupon_id;exit;
    // dd($request->all());
    // $coupon = new Colors();
    $coupon = Coupons::findOrFail($coupon_id);
    $coupon->fill($request->all());

    if ($coupon->update())
    {
      return redirect()->route('admin.coupon')->with('success', 'New Coupon Updated!');
    }
    else
    {
      return redirect()->route('admin.coupon')->with('error', 'Something went wrong!');
    }
  }
}
