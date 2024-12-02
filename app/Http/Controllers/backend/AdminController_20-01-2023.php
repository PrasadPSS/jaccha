<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\backend\Orders;
use App\Models\backend\Products;
use App\Models\frontend\User;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

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

    //fetching data from data base and count
   $products = count(Products::all());
   $user = count(User::all());
   $order = count(Orders::all());
   $orderlist = Orders::orderby('order_id', 'desc')->limit(5)->get();
   $customerlist = User::orderby('id', 'desc')->limit(5)->get();

   $orderpanding = count(Orders::where('confirmed_stage', 0)->get());
   $orderproccesing = count(Orders::where('preparing_order_stage', 1)->get());
   $orderdeliverd = count(Orders::where('delivered_stage', 1)->get());
   $ordercancel = count(Orders::where('cancel_order_flag', 1)->get());
   $orderreturn = count(Orders::where('order_return_flag', 1)->get());
   $totalsales = Orders::where('cancel_order_flag', 0)->where('order_return_flag', 0)->sum('total');

    // dd($orderlist);
   //got last 3 order products from table
   $order_id = DB::table('products')->orderBy('product_id', 'desc')->limit(3)->get(['product_title','created_at']);

  //only got todays order
   $records = DB::table('orders')->select(DB::raw('*'))
   ->whereRaw('Date(created_at) = CURDATE()')->count();




  return view('backend.admin.dashboard',compact('products','user','order','order_id','records','orderlist','customerlist', 'orderpanding', 'orderproccesing', 'orderdeliverd', 'ordercancel', 'orderreturn', 'totalsales'));
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
    $adminid = Auth::guard('admin')->user()->admin_user_id;
    // dd($adminid);
    $adminuser = DB::table('admin_users')->where('admin_user_id',$adminid)->first();
    return view('backend.admin.myprofile',compact('adminuser'));
  }

  public function updateProfile(Request $request)
  {
    $admin_user_id = Auth::guard('admin')->user()->admin_user_id;
    $this->validate($request, [
      'first_name' => ['required'],
      'last_name' => ['required'],
      'mobile_no' => ['required'],
    ]);

    $adminuser = AdminUsers::findOrFail($admin_user_id);
    $adminuser->fill($request->all());

    if ($adminuser->update())
    {
        return redirect()->route('admin.profile')->with('success', 'Profile Successfully updated!');
    }
    else
    {
        return redirect()->route('admin.profile')->with('error', 'Something went wrong!');
    }
  }

  public function changePassword()
  {
    return view('backend.admin.changepassword');
  }

  public function updatePassword(Request $request)
  {
    $this->validate($request,[
      'current_password' => 'required',
      'new_password' => 'required|confirmed|min:6',
      'new_password_confirmation' => 'required',
      ]);
    $userid = Auth::guard('admin')->user()->admin_user_id;
    $userdata = DB::table('admin_users')->where('admin_user_id',$userid)->first();
    $adminpassword = $userdata->password;
    $userpassword = $request->input('current_password');
    if(Hash::check($userpassword, $adminpassword))
    {
      $new_password = $request->input('new_password');
      $newpassword = Hash::make($new_password);
      DB::table('admin_users')
        ->where('admin_user_id', $userid)
        ->update(array(
          'password' => $newpassword,

        ));
        return redirect('admin')->with('success', "Password Changed Successfully.");

    }
    else
    {
    //   return redirect('admin/changepassword')->with('error', "Your current password is missing or incorrect");
        return back()->withErrors([
            'message' => 'Your current password is missing or incorrect !'
          ]);//->with('error','Your current password is missing or incorrect!')
    }
  }

  public function externaluser($id){
    $externaluser = User::findOrFail($id);
    return view('backend.admin.updatestatus',compact('externaluser'));
  }






}
