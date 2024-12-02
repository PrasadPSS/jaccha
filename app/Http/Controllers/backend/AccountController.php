<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;

class AccountController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest:admin', ['except' => ['logout']]);
  }

  public function showloginform()
  {
      return view('backend.account.loginform');
  }

  public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
      {
        // if successful, then redirect to their intended location
        // return redirect()->back();
        // dd(Auth()->guard('admin')->user());
        if (isset(Auth()->guard('admin')->user()->admin_user_id))
        {
            // dd(Auth()->guard('admin')->user());
            if(Auth()->guard('admin')->user()->account_status == 0)
            {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'message' => 'Your account has been deactivated, Please contact Dadreeios customer care team to reactivate your account.'
                ]);
            }
        }
        return redirect()->intended(route('admin.dashboard'));
        // return redirect()->intended(url()->previous());
      }
      else
      {
        return back()->withErrors([
            'message' => 'The email or password is incorrect, please try again'
        ]);
      }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

}
