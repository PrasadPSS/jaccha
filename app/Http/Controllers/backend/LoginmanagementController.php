<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Models\backend\LoginManagement;
use App\Models\frontend\PaymentMode;

class LoginmanagementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index()
  {
      $login_managements = LoginManagement::orderBy('login_management_id', 'desc')->get();
      // dd($login_managements);
      return view('backend.loginmanagement.index', compact('login_managements'));
  }

  public function create()
  {
      return view('backend.loginmanagement.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'status' => 'required',
      ]);

      $login_management = new LoginManagement;
      $login_management->fill($request->all());
      if ($login_management->save())
      {
        return redirect()->route('admin.loginmanagement')->with('success', 'New Login Setting Added!');
      }
      else
      {
        return redirect()->route('admin.loginmanagement')->with('error', 'Something went wrong!');
      }
  }

  public function destroy($id)
  {
    $login_management = LoginManagement::findOrFail($id);
    $login_management->delete();
    return redirect()->route('admin.loginmanagement')->with('success', 'Login Setting Deleted!');
  }

  public function edit($id)
  {
      $login_management = LoginManagement::findOrFail($id);
      return view('backend.loginmanagement.edit', compact('login_management'));
  }

  public function update(Request $request)
  {
    $login_management_id = $request->input('login_management_id');
    $this->validate( $request, [
      'login_management_id' => 'required',
    ]);
    $login_management = LoginManagement::findOrFail($login_management_id);
    $login_management->fill($request->all());

    if ($login_management->update())
    {
      return redirect()->route('admin.loginmanagement')->with('success', 'New Login Setting Updated!');
    }
    else
    {
      return redirect()->route('admin.loginmanagement')->with('error', 'Something went wrong!');
    }
  }
}
