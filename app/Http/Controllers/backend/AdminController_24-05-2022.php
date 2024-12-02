<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use App\Http\Models\frontend\User;
use Carbon\Carbon;
use Auth;
use Hash;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // echo "string";exit;
    return view('backend.admin.dashboard');
  }


  public function dashboardfinancesummary()
  {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $orders = Orders::get();
    $all_orders = collect($orders)->count();
    $all_sale = collect($orders)->sum('discounted_value');
    $all_distributors = User::count();
    $todays_collection = DB::select('select * from orders where DATE(created_at) Between :startdate and :enddate', ['startdate' => $start_date,'enddate'=>$end_date]);
    if($todays_collection){
      $todays_collection = collect($todays_collection)->sum('discounted_value');
    }else{
      $todays_collection = 0;
    }


    $todays_online_orders_collection = DB::select('select * from orders where manual_order=0 and DATE(created_at) Between :startdate and :enddate', ['startdate' => $start_date,'enddate'=>$end_date]);
    if($todays_online_orders_collection){
      $todays_online_orders_collection = collect($todays_online_orders_collection)->sum('discounted_value');
    }else{
      $todays_online_orders_collection = 0;
    }

    $todays_manual_orders_collection = DB::select('select * from orders where manual_order=1 and DATE(created_at) Between :startdate and :enddate', ['startdate' => $start_date,'enddate'=>$end_date]);
    if($todays_manual_orders_collection){
      $todays_manual_orders_collection = collect($todays_manual_orders_collection)->sum('discounted_value');
    }else{
      $todays_manual_orders_collection = 0;
    }

    $todays_orders = DB::select('select * from orders where manual_order=0 and DATE(created_at) Between :startdate and :enddate', ['startdate' => $start_date,'enddate'=>$end_date]);
    if($todays_orders){
      $todays_orders = count($todays_orders);
    }else{
      $todays_orders = 0;
    }
    $todays_manual_orders = DB::select('select * from orders where manual_order=1 and DATE(created_at) Between :startdate and :enddate', ['startdate' => $start_date,'enddate'=>$end_date]);
    if($todays_manual_orders){
      $todays_manual_orders = count($todays_manual_orders);
    }else{
      $todays_manual_orders = 0;
    }

    $response_data = [];
    $response_data['todays_collection'] = format_currency(round($todays_collection,1));
    $response_data['todays_orders'] = round($todays_orders,1);
    $response_data['todays_manual_orders'] = round($todays_manual_orders,1);
    $response_data['todays_manual_orders_collection'] = format_currency(round($todays_manual_orders_collection,1));
    $response_data['todays_online_orders_collection'] = format_currency(round($todays_online_orders_collection,1));
    return response()->json($response_data);
  }


    public function myProfile()
    {
      $userid = Auth::guard('admin')->user()->id;
      $userdata = DB::table('admin_users')->where('id',$userid)->first();
      return view('backend.admin.myprofile',compact('userdata'));
    }

    public function updateProfile(Request $request)
    {
      $userid = Auth::guard('admin')->user()->id;
      $name = $request->input('name');
      $last_name = $request->input('last_name');
      $mobile_no = $request->input('mobile_no');
      DB::table('admin_users')
        ->where('id', $userid)
        ->update(array(
          'name' => $name,
          'last_name'=>$last_name,
          'mobile_no'=>$mobile_no
        ));

        return redirect('admin');
    }

    public function changePassword()
    {
      return view('backend.admin.changepassword');
    }

    public function updatePassword(Request $request)
    {
      $this->validate($request,[
        'current-password' => 'required',
        'new-password' => 'required|confirmed|min:6',
        'new-password_confirmation' => 'required',
       ]);
      $userid = Auth::guard('admin')->user()->id;
      $userdata = DB::table('admin_users')->where('id',$userid)->first();
      $adminpassword = $userdata->password;
      $userpassword = $request->input('current-password');
      if(Hash::check($userpassword, $adminpassword))
      {
        $new_password = $request->input('new-password');
          $newpassword = Hash::make($new_password);
        DB::table('admin_users')
          ->where('id', $userid)
          ->update(array(
            'password' => $newpassword,

          ));
          return redirect('admin');

      }else{
        return redirect('admin')->with("<h3>Your current password is missing or incorrect</h3>");
      }
    }

}
