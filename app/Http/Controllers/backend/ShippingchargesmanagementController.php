<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\ShippingChargesManagement;

class ShippingchargesmanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $shipping_charges_managements = ShippingChargesManagement::orderBy('shipping_charges_management_id', 'desc')->get();
      // dd($shipping_charges_managements);
      return view('backend.shippingchargesmanagement.index', compact('shipping_charges_managements'));
  }

  public function create()
  {
      return view('backend.shippingchargesmanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'status' => 'required',
        'purchase_min_limit' => 'required',
      ]);

      $shipping_charges_management = new ShippingChargesManagement;
      $shipping_charges_management->fill($request->all());
      if ($shipping_charges_management->save())
      {
        return redirect()->route('admin.shippingchargesmanagement')->with('success', 'New Shipping Charge Added!');
      }
      else
      {
        return redirect()->route('admin.shippingchargesmanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $shipping_charges_management = ShippingChargesManagement::findOrFail($id);
    $shipping_charges_management->delete();
    return redirect()->route('admin.shippingchargesmanagement')->with('success', 'Shipping Charge Deleted!');
  }

  public function edit($id)
  {
      $shipping_charges_management = ShippingChargesManagement::findOrFail($id);
      return view('backend.shippingchargesmanagement.edit', compact('shipping_charges_management'));
  }

  public function update(Request $request)
  {
    $shipping_charges_management_id = $request->input('shipping_charges_management_id');
    $this->validate( $request, [
      'status' => 'required',
      'purchase_min_limit' => 'required',
    ]);
    // echo "string".$shipping_charges_management_id;exit;
    // dd($request->all());
    // $shipping_charges_management = new Colors();
    $shipping_charges_management = ShippingChargesManagement::findOrFail($shipping_charges_management_id);
    $shipping_charges_management->fill($request->all());

    if ($shipping_charges_management->update())
    {
      return redirect()->route('admin.shippingchargesmanagement')->with('success', 'Shipping Charge Updated!');
    }
    else
    {
      return redirect()->route('admin.shippingchargesmanagement')->with('error', 'Something went wrong!');
    }
  }
}
