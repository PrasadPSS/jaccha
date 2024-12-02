<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\CODManagement;
use App\Models\frontend\PaymentMode;

class CodmanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $cod_managements = CODManagement::orderBy('cod_management_id', 'desc')->get();
      // dd($cod_managements);
      return view('backend.codmanagement.index', compact('cod_managements'));
  }

  public function create()
  {
      return view('backend.codmanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'status' => 'required',
        'cod_purchase_min_limit' => 'required',
        'cod_purchase_max_limit' => 'required',
      ]);

      $cod_management = new CODManagement;
      $cod_management->fill($request->all());
      if ($cod_management->save())
      {
        return redirect()->route('admin.codmanagement')->with('success', 'New COD Setting Added!');
      }
      else
      {
        return redirect()->route('admin.codmanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $cod_management = CODManagement::findOrFail($id);
    $cod_management->delete();
    return redirect()->route('admin.codmanagement')->with('success', 'COD Setting Deleted!');
  }

  public function edit($id)
  {
      $cod_management = CODManagement::findOrFail($id);
      return view('backend.codmanagement.edit', compact('cod_management'));
  }

  public function update(Request $request)
  {
    $cod_management_id = $request->input('cod_management_id');
    $this->validate( $request, [
      'status' => 'required',
      'cod_purchase_min_limit' => 'required',
      'cod_purchase_max_limit' => 'required',
    ]);
    // echo "string".$cod_management_id;exit;
    // dd($request->all());
    // $cod_management = new Colors();
    $cod_management = CODManagement::findOrFail($cod_management_id);
    $cod_management->fill($request->all());
    if ($cod_management->update())
    {
      $payment_mode = PaymentMode::Where('payment_mode_code','cod')->first();
      if ($payment_mode)
      {
        // dd($cod_management->status);
        $payment_mode->status = $cod_management->status;
        $payment_mode->update();
      }
      return redirect()->route('admin.codmanagement')->with('success', 'New COD Setting Updated!');
    }
    else
    {
      return redirect()->route('admin.codmanagement')->with('error', 'Something went wrong!');
    }
  }
}
