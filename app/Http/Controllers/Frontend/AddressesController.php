<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\frontend\User;
use App\Models\frontend\UsersApplicant;
use App\Models\frontend\Cart;
use App\Models\backend\Products;
use App\Models\frontend\Orders;
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\OrdersCounter;
use App\Models\frontend\MarkSetting;
use App\Models\frontend\MarkMaster;
use App\Models\frontend\Gst;
use App\Models\frontend\DiscountSetting;
use Illuminate\Support\Facades\DB;
use App\Models\frontend\PaymentMode;
use App\Models\frontend\Shipping;
use App\Models\frontend\PaymentInfo;
use App\Models\frontend\UsersIdproof;
use App\Models\frontend\UsersBankDetails;
use App\Models\frontend\MissingPayments;
use App\Models\frontend\MissingPaymentProducts;
use App\Models\frontend\PariwarCustomers;
use App\Models\frontend\Wallet;
use App\Models\frontend\WalletPayments;
use App\Models\frontend\WalletTransactions;
use App\Models\frontend\CartCoupons;
use App\Models\backend\Coupons;
use Inertia\Inertia;
use Session;
use App\Models\frontend\Schemes;
use App\Models\frontend\Wishlists;
use App\Models\frontend\ShippingAddresses;
use App\Rules\ValidPincode;

class AddressesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

  public function index()
  {
    $user_id = auth()->user()->id;
    $user = User::where('id',$user_id)->first();
    $shipping_addresses = ShippingAddresses::where('user_id',$user_id)->get();
    return Inertia::render('Frontend/Address/Index', ['user'=>$user, 'addresses'=> $shipping_addresses]);
  }

  public function addaddress()
  {
    return Inertia::render('Frontend/Address/AddAddress');
  }

  public function storeaddress(Request $request)
  {

    if(!auth()->user())
    {
      return back()->withErrors([
        'message' => 'Please login before Adding Address !'
      ])->with('error','Please login before Adding Address !');

    }
    $this->validate(request(), [
      'shipping_full_name' => 'required',
      'shipping_mobile_no' => 'required|min_digits:10|max_digits:10|numeric',
      'shipping_address_line1' => 'required',
      'shipping_address_line2' => 'required',
      'shipping_landmark' => 'required',
      'shipping_city' => 'required',
      'shipping_pincode' => ['required', new ValidPincode()],
      'shipping_district' => 'required',
      'shipping_state' => 'required',
      'shipping_address_type' => 'required',
      'shipping_email' => 'required|email:rfc,dns',
    ]);

    // dd($request->all());

    $user_id = auth()->user()->id;


    $add_shipping_address = new ShippingAddresses();
    $add_shipping_address->fill($request->all());
    $add_shipping_address->user_id = $user_id;
    $defaultExists = ShippingAddresses::where('user_id',$user_id)->where('default_address_flag' , 1)->exists();
    if (isset($request->default_address_flag) && $request->default_address_flag==1)
    {
      // dd('in');
      ShippingAddresses::where('user_id',$user_id)->update(['default_address_flag'=>0]);
    }
    else
    {
      $shipping_addresses = ShippingAddresses::where('user_id',$user_id)->first();
      // dd($shipping_addresses);
      if (!$shipping_addresses)
      {
        $add_shipping_address->default_address_flag = 1;
      }
      else
      {
        if($defaultExists)
        {
          $add_shipping_address->default_address_flag = 0;
        }
        else
        {
          $add_shipping_address->default_address_flag = 1;
        }
        
      }
    }

    // dd($add_shipping_address);
    if ($add_shipping_address->save())
    {
       if (isset($request->checkout_flag))
       {
         return redirect()->to('/cart/checkout')->with('success','New Address Added Successfully !');
       }
        
        return redirect()->back()->with('success','New Address Added Successfully !');
    }
    else
    {
      return back()->with('error','Something went Wrong !');
    }

  }

  public function editaddress($id)
  {
    $user_id = auth()->user()->id;
    $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$id)->first();

    return response()->json(['shipping_address' => $shipping_address]);
  }

  public function updateaddress(Request $request)
  {
    // dd('test');
    if (!auth()->user()) {
      return back()->withErrors([
        'message' => 'Please login before Adding Address !'
      ])->with('error', 'Please login before Adding Address !');

    }
    $this->validate(request(), [
      'shipping_full_name' => 'required',
      'shipping_mobile_no' => 'required|min_digits:10|max_digits:10|numeric',
      'shipping_address_line1' => 'required',
      'shipping_address_line2' => 'required',
      'shipping_landmark' => 'required',
      'shipping_city' => 'required',
      'shipping_pincode' => ['required', new ValidPincode()],
      'shipping_district' => 'required',
      'shipping_state' => 'required',
      'shipping_address_type' => 'required',
      'shipping_email' => 'required|email:rfc,dns',
    ]);

    // dd($request->all());
    $shipping_address_id = $request->shipping_address_id;
    $page = $request->page;
    $user_id = auth()->user()->id;

    $update_shipping_address = ShippingAddresses::where('user_id', $user_id)->where('shipping_address_id', $shipping_address_id)->first();
    $update_shipping_address->fill($request->all());
    $update_shipping_address->user_id = $user_id;
    $defaultExists = ShippingAddresses::where('user_id', $user_id)->where('default_address_flag', 1)->exists();
    $currentAddress = ShippingAddresses::where('user_id', $user_id)->where('default_address_flag', 1)->first();
    if($defaultExists && $request->default_address_flag == 1 && $update_shipping_address->shipping_address_id != $currentAddress->shipping_address_id){
    
      ShippingAddresses::where('user_id', $user_id)->update(['default_address_flag' => 0]);
     
      $update_shipping_address->default_address_flag = 1;
      
    
    }
    else if($request->default_address_flag == 0 && $update_shipping_address->shipping_address_id != $currentAddress->shipping_address_id)
    {
      $update_shipping_address->default_address_flag = 0;
    }
   
    else
    {
      $update_shipping_address->default_address_flag = 1;
    }

    if ($update_shipping_address->save()) {
      if ($page == "checkout") {
        return redirect()->back()->with('success', 'Address Updated Successfully !');
      } else {
        return redirect()->back()->with('success', 'Address Updated Successfully !');
      }
    } else {
      return back()->with('error', 'Something went Wrong !');
    }

  }

  public function deleteaddress($id)
  {
    $user_id = auth()->user()->id;
    $delete = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$id)->first();

    if (isset($delete->default_address_flag) && $delete->default_address_flag==1)
    {
      $shipping_addresses = ShippingAddresses::where('user_id',$user_id)->first();
      if ($shipping_addresses)
      {
        $shipping_addresses->default_address_flag = 1;
        $shipping_addresses->save();
      }
    }

    $delete->delete();
    //remove coupon pending
    Session::flash('message', 'Address Deleted Successfully!');
    // Session::flash('status', 'success');

    return back();
  }

  public function selectaddress()
  {
    $user_id = auth()->user()->id;
    $shipping_addresses = ShippingAddresses::where('user_id',$user_id)->get();
    return view('frontend.addresses.select_address',compact('shipping_addresses'));
  }

  public function sotreselectedaddress(Request $request)
  {
    // dd('test');
    if(!auth()->user())
    {
      return back()->withErrors([
        'message' => 'Please login before Adding Address !'
      ])->with('error','Please login before Adding Address !');

    }
    $this->validate(request(), [
      'shipping_address_id' => 'required',
    ]);

    // dd($request->all());
    $shipping_address_id = $request->shipping_address_id;
    $user_id = auth()->user()->id;

    $update_shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$shipping_address_id)->first();
    if (!$update_shipping_address)
    {
      return back()->with('error','Address Not Found !');
    }
    $update_shipping_address->default_address_flag = 1;

    ShippingAddresses::where('user_id',$user_id)->update(['default_address_flag'=>0]);


    if ($update_shipping_address->save())
    {
      return redirect()->to('/cart/checkout')->with('success','Address Selected Successfully !');
    }
    else
    {
      return back()->with('error','Something went Wrong !');
    }

  }

  public function getpincodedata(Request $request)
  {
    $data = $request->all();
    $pincode = $data['shipping_pincode'];
    $pin_response = json_decode(verify_pincode($pincode),true);
    // dd($pin_response);
    if (isset($pin_response['delivery_codes'][0]))
    {
      $cod_response['district'] = $pin_response['delivery_codes'][0]['postal_code']['district'];
      $state = get_state($pin_response['delivery_codes'][0]['postal_code']['state_code']);
      $cod_response['state'] = ($state->state_name)?$state->state_name:'';
    }
    else
    {
      $cod_response = 'N';
    }
    // dd($pin_response['delivery_codes'][0]['postal_code']['cod']);
    return $cod_response;
  }


}
