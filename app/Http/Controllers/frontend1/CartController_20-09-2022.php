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
use App\Models\backend\MissingPayments;
use App\Models\backend\MissingPaymentProducts;
use App\Models\frontend\PariwarCustomers;
use App\Models\frontend\Wallet;
use App\Models\frontend\WalletPayments;
use App\Models\frontend\WalletTransactions;
use App\Models\frontend\CartCoupons;
use App\Models\backend\Coupons;
use Session;
require 'mailer/PHPMailerAutoload.php';
use App\Models\frontend\Schemes;
use App\Models\frontend\Wishlists;
use App\Models\frontend\ShippingAddresses;
use App\Models\backend\CODManagement;
use PHPMailer\PHPMailer;
use App\Models\backend\Company;
use App\Models\backend\ShippingChargesManagement;
use PDF;
use App\Models\backend\OrderDeliveryManagement;
use App\Models\backend\ProductVariants;
use App\Models\frontend\Newsletters;
use Illuminate\Database\Eloquent\Collection;

class CartController extends Controller
{
    public function __construct()
    {
      //$this->middleware('auth');
     $this->middleware('auth',
     ['except' => ['addtocart','payment','paymentsuccess',
     'paymentfailure','addMissingPayment','checkout1','deleteitem','updatecart','SendInvoice','Sendneworder',
     'addWalletMissingPayment','applycoupon','reviewaddress','movetowishlist','removecoupon','addshippingaddress',
     'getcodcollectioncharges','testapi', 'moveguesttocart' ,'goguestcart','removeguestitem','updateguestcart' ]]);
    }

    public function index()
    {

      if(!auth()->user())
      {
          if( empty(session('cart')) ){
            return redirect('/guest/emptycart');
          }

        return redirect('/guestcart');
            //     return back()->withErrors([
            //   'message' => 'Please login to view Cart !'
            // ]);

      }else{
        if(isset(auth()->user()->id))
        {
          $user_id = auth()->user()->id;
        }
        $cart = Cart::where('user_id',$user_id)->with(['products','product_images','product_variant'])->get();
        $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
        // $cart = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->join('product_images', 'products.product_id', '=', 'product_images.product_id')->select('cart.id','cart.qty','products.product_price','products.product_title','products.product_id', 'product_images.image_name','cart.schemes_id')->groupby('product_images.product_id')->get();
        // dd($cart);
        $shipping_charge_management = ShippingChargesManagement::first();
        $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('default_address_flag',1)->first();
        if (!$shipping_address)
        {
          // exit;
          $shipping_address = ShippingAddresses::where('user_id',$user_id)->first();
        }
        if ($shipping_address)
        {
          $company = Company::first();
          $product_wt = get_cart_product_weight();
          $shipping_charge = get_shipping_charges('S',$product_wt,$company->pincode,'Delivered',$shipping_address->shipping_pincode);
          $shipping_charge = json_decode($shipping_charge,true);
          $shipping_charges = isset($shipping_charge[0])?$shipping_charge[0]:[];
          $shipping_amount = isset($shipping_charge[0]['total_amount'])?$shipping_charge[0]['total_amount']:0;
        }
        else
        {
          $shipping_amount = 0;
        }
        $get_cart_total = get_cart_amounts();
        $cart_total_with_discount = $get_cart_total->cart->cart_discounted_total-$get_cart_total->coupon_discount;
        if($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit)
        {
          $shipping_amount = 0;
        }
        // dd($cart_total_with_discount);
        if (isset($cart) && count($cart)==0)
        {
          return view('frontend.cart.empty_cart');
        }
        $coupon_data = Coupons::get();
        return view('frontend.cart.index', compact('cart','cart_coupon','shipping_address','coupon_data','shipping_amount','shipping_charge_management'));
      }

    }


    public function addtocart(Request $request)
    {
      // dd($request);
      $this->validate(request(), [
        'product_id' => 'required',
        'quantity' => 'required',
        'color_id' => 'required',
        'size_id' => 'required',
        'product_type' => 'required',
      ],[
        'size_id.required' => 'Please Select Size',
        'color_id.required' => 'Please Select Color',
      ]);


      // dd($request->all());


      $product_id = $request->product_id;
      $color_id = $request->color_id;
      $size_id = $request->size_id;
      $product_variant_id = '';
      if ($request->product_type =='simple')
      {
        $product = Products::where('product_id',$product_id)->first();
      }
      elseif ($request->product_type =='configurable')
      {
        $product_variant_id = $request->product_variant_id;
        $product = ProductVariants::where('product_id',$product_id)->where('product_variant_id',$product_variant_id)->where('color_id',$color_id)->where('size_id',$size_id)->first();
      }
      // check if product is in stock
      if($product->product_qty <= 0)
      {
        return back()->with([
            'error' => 'Product is out of stock'
        ]);
      }
      if($product->out_of_stock_flag == 0)
      {
        return back()->with([
            'error' => 'Product is out of stock'
        ]);
      }
      if($product->product_qty < $request->quantity)
      {
        return back()->with([
            'error' => 'Only '.$product->product_qty.' Product left (Please select quantity upto '.$product->product_qty.')'
        ]);
      }

      if(!auth()->user())
      {
          //put values in the session
        session()->put('cart.cart_'.$request->product_id.'_'.$request->product_variant_id,$request->all());
        if (isset($request->addto) && $request->addto == 'addtobuy')
        {
          return redirect()->to('/cart')->with('success','Product Added To Buy Now!');
        }

        return back()->with('success','Product Added To The Cart Successfully !');
    }


    $user_distributor_id = auth()->user()->distributor_id;
    $user_table = 'users';
      $added_by = auth()->user()->id;

      $quantity = 1;
      if(isset($request->quantity))
      {
        $quantity = $request->quantity;
      }

      $user_id = auth()->user()->id;
      // $user_id = auth()->user()->id;

      if ($request->product_type =='simple')
      {
        $product_exist_in_cart = Cart::where('user_id',$user_id)->Where('product_id',$product_id)->first();
      }
      elseif ($request->product_type =='configurable')
      {
        $product_exist_in_cart = Cart::where('user_id',$user_id)->Where('product_id',$product_id)->where('product_variant_id',$product_variant_id)->first();
      }

      if(isset($product_exist_in_cart) && $product_exist_in_cart->qty >= $product->product_qty)
      {
        return back()->with([
            'error' => 'Product already in cart'
        ]);
      }

      if($product_exist_in_cart)
      {
        $product_qty = (int)$product_exist_in_cart->qty;
        $product_qty = $product_qty+$quantity;
        $product_exist_in_cart->qty = $product_qty;


        // check if there is any scheme active on selected product, apply if active
        // $cart_product = Cart::where('id',$product_exist_in_cart->id)->first();
        // $product = Products::where('product_id',$cart_product->product_id)->first();
        // if($product and $product_exist_in_cart->schemes_id == '' or $product_exist_in_cart->schemes_id == NULL)
        // {
          // $scheme = Schemes::where('schemes_id',$product->schemes_id)->first();

          // if($product->schemes_id != "" and $product_exist_in_cart->qty >= $scheme->min_product_qty)
          // {
          //   $current_date = date("Y-m-d");
          //   $scheme_end_date = $product->scheme_end_date;
          //   if($scheme_end_date >= $current_date){
          //     Cart::where('id',$product_exist_in_cart->id)->update(['schemes_id' => $product->schemes_id]);
          //   }else{
          //     Cart::where('id',$product_exist_in_cart->id)->update(['schemes_id' => NULL]);
          //   }
          // }
          // else{
          //     Cart::where('id',$product_exist_in_cart->id)->update(['schemes_id' => NULL]);
          //   }
        // }
        // ends

        $product_exist_in_cart->save();
        if (isset($request->page_name) && $request->page_name == 'wishlist')
        {
          $wishlist=Wishlists::where('wishlist_id',$request->wishlistid)->delete();
        }
        if (isset($request->addto) && $request->addto == 'addtobuy')
        {
          return redirect()->to('/cart')->with('success','Product Added To Buy Now!');
        }
        return back()->with('success','Product Added To The Cart Successfully !');
      }
      else
      {
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->product_type = $request->product_type;
        if ($request->product_type =='configurable')
        {
          $cart->product_variant_id = $product_variant_id;
        }
        //$cart->price = ($quantity*$product->price);
        $cart->qty = $quantity;
        $cart->discount = $product->product_discount;
        // $cart->referral_id = $added_by;
        $cart->currency = 'INR';
        // $cart->distributor_id = $user_distributor_id;
        // $cart->account_type = $account_type;

        // check if there is any scheme active on selected product, apply if active
        // $product = Products::where('product_id',$product_id)->first();
        // if($product)
        // {
        //   $scheme = Schemes::where('schemes_id',$product->schemes_id)->first();
        //
        //   if($product->schemes_id != "" and $quantity >= $scheme->min_product_qty){
        //     $current_date = date("Y-m-d");
        //     $scheme_end_date = $product->scheme_end_date;
        //     if($scheme_end_date >= $current_date){
        //       $cart->schemes_id = $product->schemes_id;
        //     }
        //   }
        // }
        // ends
        $cart->save();
        if (isset($request->page_name) && $request->page_name == 'wishlist')
        {
          $wishlist=Wishlists::where('wishlist_id',$request->wishlistid)->delete();
        }
        if (isset($request->addto) && $request->addto == 'addtobuy')
        {
          return redirect()->to('/cart')->with('success','Product Added To Buy Now!');
        }
        return back()->with('success','Product Added To The Cart Successfully !');
      }
    }  //end add to cart function




    // public function reviewcart()
    public function checkout()
    {
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;

        $user = auth()->user();
      }
      $cart = Cart::where('user_id',$user_id)->with(['products','product_images','product_variant'])->get();
      if (count($cart)<=0)
      {
        // dd($cart);
        return back()->with('error','Your Cart is empty');
      }
      $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('default_address_flag',1)->first();
      if (!$shipping_address)
      {
        // exit;
        $shipping_address = ShippingAddresses::where('user_id',$user_id)->first();
      }
      if (!$shipping_address)
      {
        return back()->with('error','Please add Delivery Address First');
      }
      // $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$_GET['shipping_address_id'])->first();
      //   $user = auth()->user();
      // $gst = Gst::Where('default_gst',1)->first();
      $payment_mode = PaymentMode::Where('status',1)->get();
      $increment_id = substr(md5(microtime()),rand(0,20),20);
      // $discount_setting = DiscountSetting::first();
      // $shipping=Shipping::where('shipping_method_status',1)->first();
      // $existing_wallet = Wallet::where('user_id',$user_id)->Where('account_type',$account_type)->first();
      //calculate shipping charge for each item
      $shipping_charges = [];
      $shipping_amount = 0;
      $product_wt = 0;
      // foreach ($cart as $cart_item)
      // {
      //   $product_wt = $product_wt+$cart_item->products->product_weight;
      //
      // }
      $product_wt = get_cart_product_weight();

      $company = Company::first();
      $shipping_charge = get_shipping_charges('S',$product_wt,$company->pincode,'Delivered',$shipping_address->shipping_pincode);
      $shipping_charge = json_decode($shipping_charge,true);
      // dd($shipping_charge);
      $shipping_charges = isset($shipping_charge[0])?$shipping_charge[0]:[];
      $shipping_amount = isset($shipping_charge[0]['total_amount'])?$shipping_charge[0]['total_amount']:0;
      // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;
      // dd($shipping_charge[0]['total_amount']);
      // dd($shipping_amount);
      $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
      //pincode verification and COD
      $pin_response = json_decode(verify_pincode($shipping_address->shipping_pincode),true);
      // dd($pin_response);
      // echo "<pre>"; print_f($pin_response);exit;
      if (isset($pin_response['delivery_codes']) && count($pin_response['delivery_codes'])>0)
      {
        $cod_response = $pin_response['delivery_codes'][0]['postal_code']['cod'];
        $pin_response =false;
      }
      else
      {
        $cod_response ='N';
        $pin_response =true;
      }
      //cart amounts
      $cart_amounts = get_cart_amounts();
      $cart_total_with_discount = $cart_amounts->cart->cart_discounted_total-$cart_amounts->coupon_discount;

      $shipping_charge_management = ShippingChargesManagement::first();
      if($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit)
      {
        $shipping_amount = 0;
      }
      $cod_status = true;
      $cod_rmk = '';
      $cod_message = '';
      $cod_management = CODManagement::first();
      if($cod_management)
      {
        $cod_message = 'Cash on Delivery facility is available on min. net order amount of ₹ '.$cod_management->cod_purchase_min_limit.' and max. ₹ '.$cod_management->cod_purchase_max_limit.' ';
      }
      // dd($cod_management);
      if ($cod_response=='Y')
      {
        if ($cod_management->cod_purchase_min_limit <= $cart_total_with_discount && $cod_management->cod_purchase_max_limit >= $cart_total_with_discount)
        {
          $cod_status = false;
          $cod_rmk = 'COD available';
        }
        else
        {
          $cod_status = true;
          $cod_rmk = 'Cash on Delivery facility is available on min. net order amount of ₹ '.$cod_management->cod_purchase_min_limit.' and max. ₹ '.$cod_management->cod_purchase_max_limit.' ';
        //   Cash on Delivery facility is available on min. net order amout of ₹799 and max. ₹2500
        //   $cod_rmk = 'Your cart amount needs to be between ₹'.$cod_management->cod_purchase_min_limit.' and ₹'.$cod_management->cod_purchase_max_limit.' to avail this offer!';
        }
      }
      else
      {
        $cod_status = true;
        $cod_rmk = 'COD not available';
      }
      $order_delivery = OrderDeliveryManagement::first();

      return view('frontend.cart.checkout', compact('cart','user','increment_id','shipping_address','shipping_charge','shipping_amount',
      'cart_coupon','payment_mode','cod_response','cart_amounts','cod_status','cod_rmk','pin_response','order_delivery','cod_message'));
    }




    public function payment(Request $request)
    {
      $post_data = $request->all();
      $user_session = auth()->user();
      $user_id = auth()->user()->id;
      if($user_session)
      {
        $user_details = $user_session;
        $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$post_data['shipping_id'])->first();
        $mobile_no = $shipping_address->shipping_mobile_no;
        $address = $shipping_address->shipping_address_line1;
        $district = $shipping_address->shipping_district;
        $state = $shipping_address->shipping_state;
        $city = $shipping_address->shipping_city;
        $pincode = $shipping_address->shipping_pincode;
        // if (empty($shipping_address))
        // {
        //   $shipping_address = ShippingAddresses::where('user_id',$user_id)->first();
        // }
        $messages = array();

        if($mobile_no =='' || $pincode == '' || empty($shipping_address))
        {
          // dd($shipping_address);
          $messages['0'] ="Please complete your profile before proceeding to payment !";
        }

        if(count($messages) > 0)
        {
          return back()->withErrors([
            'message' => $messages
          ]);
        }
      }

      //var_dump($post_data);exit;
      $transaction_id = "";
      $payment_mode = $post_data['paymentmode'];


        $surl= url('cart/paymentsuccess');
        $furl= url('cart/paymentfailure');
        $transaction_id = $post_data['txnid'];
        $final_total = 0;
        $cart = Cart::where('user_id',$user_session->id)->with(['products','product_images'])->get();
        // $gst = Gst::Where('default_gst',1)->first();
        // $discount_setting = DiscountSetting::first();
        // $shipping=Shipping::where('shipping_method_status',1)->first();
        // $existing_wallet = Wallet::where('user_id',$user_session->id)->Where('account_type',$account_type)->first();



        //shipping charges
        // $shipping_charges = get_shipping_charges('S',500,'421601','Delivered','421605');
        // $shipping_charges = json_decode($shipping_charges);
        // $shipping_charge = $shipping_charges[0];

        $shipping_charges = [];
        $shipping_amount = 0;
        $product_wt = 0;
        foreach($cart as $item)
        {
          $join_table = 'products';
          if($item->product_type=="configurable")
          {
            $join_table = 'product_variant';
          }
          $final_total = $final_total + ($item->{$join_table}->product_discounted_price*$item->qty);

          //chipping charge calculation
          $product_wt = $product_wt+($item->{$join_table}->product_weight*$item->qty);

        }

        $company = Company::first();
        $shipping_charge = get_shipping_charges('S',$product_wt,$company->pincode,'Delivered',$pincode);
        $shipping_charge = json_decode($shipping_charge,true);
        $shipping_charges = isset($shipping_charge[0])?$shipping_charge[0]:[];
        // $shipping_amount = $shipping_charge[0]->total_amount;
        $shipping_amount = isset($shipping_charge[0]['total_amount'])?$shipping_charge[0]['total_amount']:0;
        // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;
        //coupon discount
        $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
        if(isset($cart_coupon->coupon))
        {
          $paymentDate = date('Y-m-d');
          $paymentDate = date('Y-m-d', strtotime($paymentDate));
          $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
          $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

          if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
          {
            if($cart_coupon->coupon->coupon_type == 'flat')
            {
              $coupon_value = $cart_coupon->coupon->value;
              $discount_value = $coupon_value;
            }
            else
            {
              $coupon_value = $cart_coupon->coupon->value;
              $discount_value = ($final_total*$coupon_value)/100;
            }
          }
          else
          {
            $discount_value = 0;
          }
        }
        else
        {
          $discount_value = 0;
        }
        //cart amounts
        $cart_amounts = get_cart_amounts();
        $cart_total_with_discount = $cart_amounts->cart->cart_discounted_total-$cart_amounts->coupon_discount;

        $shipping_charge_management = ShippingChargesManagement::first();
        if($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit)
        {
            $shipping_amount = 0;
        }
	        // $discount_value = $final_total * $discount_setting->discount_percent/100;
	        $final_discounted_value = $final_total - $discount_value;
	        // $gst_value = $final_discounted_value * $gst->gst_percent/100;
          // $grand_total = $final_discounted_value + $gst_value;
	        $grand_total = $final_discounted_value ;
	        if (!empty($shipping_charge) && $shipping_amount>0)
	        {
	          $grand_total = $grand_total + $shipping_amount;
	        }
	        $grand_total = round($grand_total);

	        $post_data['amount'] = $grand_total;
	        // exit;
	        $this->addMissingPayment($post_data,$transaction_id,$shipping_amount,$shipping_charges);
	        $cart_amount = get_cart_total();
          $user_details = $post_data;

      if($payment_mode == 'payumoney')
      {
        return view('frontend.cart.payment.payment', compact('user_details','cart_amount','surl','furl'));
      }
      else if($payment_mode == 'cod')
      {
        $cod_data = $this->paymentsuccess();

        if ($cod_data)
        {
          $current_order = $cod_data['current_order'];
          return view('frontend.cart.payment.success',compact('current_order'));
        }
        else
        {
          return view('frontend.cart.payment.failure');
        }
        // return view('frontend.cart.payment.payment', compact('user_details','cart_amount','surl','furl'));
      }
    }

    public function paymentsuccess()
    {
      // dd($_POST);exit;
      $order_counter=OrdersCounter::where('orders_counter_id',1)->first();
      // $shipping=Shipping::where('shipping_method_status',1)->first();

      $month = date('m');
      $year = date('Y');

      //updating orderids
      try
      {
        if (empty($order_counter))
        {
          $order_counters=new OrdersCounter();
          // $order_counters->orders_counter=100001;
          $order_counters->orders_counter=1;
          $order_counters->save();
        }
        else
        {
          // $order_counter_val=((int)$order_counter->orders_counter + 1);
          // $order_counter->orders_counter=$order_counter_val;
          // $order_counter->save();
        }

      } catch (Exception $e)
      {

      }

      $amount=$_POST["amount"];
      $txnid=$_POST["txnid"];
      $productinfo=$_POST["productinfo"];
      // $user_session = auth()->user();
      if(isset(auth()->user()->id))
      {
        $user_session = auth()->user();
        $firstname=auth()->user()->name;
        $email=auth()->user()->email;
      }
      else
      {
        $firstname=$_POST["firstname"];
        $email=$_POST["email"];
      }
      if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
      {
        $status='processing';
        $payment_code=$_POST['paymentmode'];
        $date_time = date('Y-m-d h:i:s');
        $date_time = date('Y-m-d h:i:s', strtotime($date_time));
      }
      else
      {
        $status='complete';
        $date_time = $_POST['addedon'];
        $payment_code='payumoney';
      }
      //$guest_unique_id = Yii::$app->functions->getGuestUniqueId();

      $payment_tracking_code = substr(md5(microtime()),rand(0,20),20);
      $existing_payment = PaymentInfo::where('transaction_id',$txnid)->first();
      //&& ($existing_payment->transaction_id == $txnid)
      if (!($existing_payment))
      {
        $payment_info = new PaymentInfo();
        $payment_info->status = $status;
        if($user_session):
          $payment_info->user_id = $user_session->id;
        endif;
        $payment_info->email = $email;
        $payment_info->customer_name = $firstname;
        $payment_info->transaction_id = $txnid;
        $payment_info->amount = $amount;
        $payment_info->payment_date = $date_time;
        $payment_info->data_dump = json_encode($_POST);
        $payment_info->payment_tracking_code = $payment_tracking_code;
        $payment_info->payment_mode = $payment_code;
        if($payment_info->save())
        {
          //var_dump($payment_info);exit;
          $missing_payments = MissingPayments::where('user_id',$user_session->id)->Where('transaction_id',$txnid)->Where('email',$email)->first();
          $missing_payments->payu_response = 'Y';
          $missing_payments->data_dump = $payment_info->data_dump;
          // $missing_payments->shipping_method_code = $shipping->shipping_method_code;
          // $missing_payments->shipping_method_cost = $shipping->shipping_method_cost;
          $missing_payments->save();
          //Yii::$app->runAction('subscription/add',['payment_tracking_code'=>$payment_tracking_code]);

          $company = Company::first();

          $shipping_address = ShippingAddresses::where('user_id',$user_session->id)->where('shipping_address_id',$missing_payments['shipping_address_id'])->first();
          $shipping_charge_management = ShippingChargesManagement::first();
          $gst_type = '';
          if (strcasecmp($company->state,$shipping_address->shipping_state) == 0)
          {
            $gst_type = 'sgst';
          }
          else
          {
            $gst_type = 'igst';
          }
          // dd($company->state.' '.$shipping_address->shipping_state.' '.$gst_type);
          // $cart_remove=Cart::find()->where(['user_id'=>$payment_info->user_id] OR ['guest_unique_id'=>$payment_info->guest_unique_id])->one();

          // $gst = Gst::Where('default_gst',1)->first();
          // $discount_setting = DiscountSetting::first();

          // $user_id = auth()->user()->id;
          if(isset(auth()->user()->id))
          {
            $user_id = auth()->user()->id;
          }
          $cart = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
          $orders_counter = OrdersCounter::first();
          $orders_counter_increment_id = $orders_counter->orders_counter+1;
          $orders_counter->orders_counter = $orders_counter_increment_id;
          $orders_counter->save();
          $order_total = Cart::where('user_id',$user_id)->select(\DB::raw('sum(price*qty) AS total_sales'))->first();
          if($cart)
          {
            $order = new Orders();
            $order->user_id = $user_id;
            $order->orders_counter_id = "DAD".$orders_counter_increment_id;
            $order->payment_tracking_code = $payment_tracking_code;
            $order->transaction_id = $txnid;
            $order->email = $email;
            $order->customer_name = $firstname;
            $order->payment_mode = $payment_code;
            // if(!empty($shipping))
            // {
            //   $order->shipping_method_code = $shipping->shipping_method_code;
            //   $order->shipping_method_cost = $shipping->shipping_method_cost;
            // }
            $order->data_dump = json_encode($_POST);

            if($order->save())
            {
              $final_total = 0;
              $shipping_charges = [];
              $shipping_amount = 0;
              $product_wt = 0;
              $total_mrp = 0;
              $total_mrp_dicount = 0;

              $cod_collection_charge_amount = 0;
              if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
              {
                $cod_management = CODManagement::first();
                $cod_collection_charge = $cod_management->cod_collection_charge;

                if ($gst_type == 'igst')
                {
                  $cod_cgst_percent = 0;
                  $cod_sgst_percent = 0;
                  $cod_igst_percent = $cod_management->cod_igst_percent;
                  $cod_cgst_amount = 0;
                  $cod_sgst_amount = 0;
                  $cod_igst_amount = $cod_management->cod_igst_amount;
                  $cod_collection_charge_amount =  $cod_collection_charge+$cod_igst_amount;
                }
                else
                {
                  $cod_cgst_percent = $cod_management->cod_cgst_percent;
                  $cod_sgst_percent = $cod_management->cod_sgst_percent;
                  $cod_igst_percent = 0;
                  $cod_cgst_amount = $cod_management->cod_cgst_amount;
                  $cod_sgst_amount = $cod_management->cod_sgst_amount;
                  $cod_igst_amount = 0;
                  $cod_collection_charge_amount =  $cod_collection_charge+$cod_cgst_amount+$cod_sgst_amount;
                }
              }
              $order_product_qty = 0;//for total qty of order // 21-07-2022
              $order_product_discount_amount = 0;//for discounted_amount of items for order // 21-07-2022
              $order_product_discount_amount = 0;
              $order_product_taxable_amount = 0;
              $order_product_gst_cgst_amt = 0;
              $order_product_gst_sgst_amt = 0;
              $order_product_gst_igst_amt = 0;

              foreach($cart as $item)
              {
                $product = Products::Where('product_id',$item->product_id)->with(['color','size','brands'])->first();
                $join_table = 'product';
                if($item->product_type=="configurable")
                {
                  $join_table = 'product_variant';
                  $product_variant = ProductVariants::Where('product_id',$item->product_id)->Where('product_variant_id',$item->product_variant_id)->with(['color','size'])->first();
                }

                $order_product = new OrdersProductDetails();
                $order_product->product_id = $item->product_id;
                $order_product->product_variant_id = $item->product_variant_id;
                $order_product->product_type = $item->product_type;
                $order_product->qty = $item->qty;
                $order_product->product_title = ${$join_table}->product_title;
                $order_product->product_sub_title = (isset($product->brands))?$product->brands->brand_name:'';
                $order_product->product_price = ${$join_table}->product_price;
                $order_product->product_discounted_price = ${$join_table}->product_discounted_price;
                $order_product->product_discount = ${$join_table}->product_discount;
                $order_product->product_discount_type = ${$join_table}->product_discount_type;
                $order_product->product_color = (isset(${$join_table}->color))?${$join_table}->color->color_name:${$join_table}->color_id;
                $order_product->product_size = (isset(${$join_table}->size))?${$join_table}->size->size_name:${$join_table}->size_id;
                $order_product->order_id = $order->order_id;
                $order_product->product_weight = ${$join_table}->product_weight;
                $order_product->product_sku = ${$join_table}->product_sku;
                $order_product->product_hsn = (isset($product->hsncode))?$product->hsncode->hsncode_name:'';
                $order_product->country = (isset($product->country))?$product->country->name:'';
                $order_product->seller_name = (isset($product->seller))?$product->seller->seller_name:'';
                $order_product->seller_address = (isset($product->seller))?$product->seller->seller_address:'';
                $order_product->packer_name = (isset($product->packer))?$product->packer->packer_name:'';
                $order_product->packer_address = (isset($product->packer))?$product->packer->packer_address:'';
                $order_product->importer_name = (isset($product->importer))?$product->importer->importer_name:'';
                $order_product->importer_address = (isset($product->importer))?$product->importer->importer_address:'';
                $order_product->manufacturer_name = (isset($product->manufacturer))?$product->manufacturer->manufacturer_name:'';
                $order_product->manufacturer_address = (isset($product->manufacturer))?$product->manufacturer->manufacturer_address:'';
                // $order_product->orders_counter_id = $orders_counter_increment_id;
                // $order_product->referral_id = $item->referral_id;
                // $order_product->distributor_id = $item->distributor_id;
                $product_discount_amount_one = ${$join_table}->product_discounted_amount;
                $product_discount_amount = (${$join_table}->product_discounted_amount*$item->qty);
                $order_product->product_discounted_amount = $product_discount_amount;
                $net_amount = (${$join_table}->product_discounted_price*$item->qty);
                $order_product->net_amount = $net_amount;
                $order_product->product_thumb = isset(${$join_table}->product_thumb)?${$join_table}->product_thumb:$product->product_thumb;

                //reverse calculations for invoice
                //GST Amount = Original Cost – (Original Cost * (100 / (100 + GST% ) ) )
                // Net Price = Original Cost – GST Amount
                $product_gst = Gst::whereRaw('? between gst_min_price and gst_max_price', [$net_amount])->first();

                $gst_igst_amount = 0;
                $gst_cgst_amount = 0;
                $gst_sgst_amount = 0;
                $rev_sell_price = 0;
                $rev_discount = 0;
                $rev_taxable_amount = 0;

                if ($gst_type == 'igst')
                {
                  $gst_igst_amount = $net_amount-($net_amount*(100/(100+$product_gst->gst_igst_percent)));

                  $order_product->gst_cgst_rate = 0;
                  $order_product->gst_cgst_amount = 0;
                  $order_product->gst_sgst_rate = 0;
                  $order_product->gst_sgst_amount = 0;
                  $order_product->gst_igst_rate = $product_gst->gst_igst_percent;
                  $order_product->gst_igst_amount = round($gst_igst_amount,2);
                  $rev_taxable_amount = $net_amount-$gst_igst_amount;
                }
                else
                {
                  $gst_base_amount = $net_amount-($net_amount*(100/(100+$product_gst->gst_cgst_percent+$product_gst->gst_sgst_percent)));
                  // $gst_cgst_amount = $net_amount-($net_amount*(100/(100+$product_gst->gst_cgst_percent)));
                  // $gst_sgst_amount = $net_amount-($net_amount*(100/(100+$product_gst->gst_sgst_percent)));
                  $gst_cgst_amount = ($gst_base_amount/2);
                  $gst_sgst_amount = ($gst_base_amount/2);

                  $order_product->gst_cgst_rate = $product_gst->gst_cgst_percent;
                  $order_product->gst_cgst_amount = round($gst_cgst_amount,2);
                  $order_product->gst_sgst_rate = $product_gst->gst_sgst_percent;
                  $order_product->gst_sgst_amount = round($gst_sgst_amount,2);
                  $order_product->gst_igst_rate = 0;
                  $order_product->gst_igst_amount = 0;
                  $rev_taxable_amount = $net_amount-$gst_cgst_amount-$gst_sgst_amount;
                }
                $rev_sell_price = ($rev_taxable_amount+$product_discount_amount)/$item->qty;
                $order_product->rev_sell_price = round($rev_sell_price,2);
                $order_product->rev_discount = $product_discount_amount;
                $order_product->rev_taxable_amount = round($rev_taxable_amount,2);
                // $product_discount_amount

                $order_product->save();

                $final_total = $final_total + $net_amount;
                if(${$join_table}->product_discounted_price!=null && ${$join_table}->product_discount!=0)
                {
                  $total_mrp = $total_mrp + (${$join_table}->product_price*$item->qty);
                }
                elseif(${$join_table}->product_discounted_price!=null && ${$join_table}->product_discount==0)
                {
                  $total_mrp = $total_mrp + (${$join_table}->product_discounted_price*$item->qty);
                }
                else
                {
                  $total_mrp = $total_mrp + (${$join_table}->product_price*$item->qty);
                }
                // decrement the product QTY
                if($item->product_type=="configurable")
                {
                  $product_variant->product_qty = ${$join_table}->product_qty-$item->qty;
                  $product_variant->save();
                }
                else
                {
                  $product->product_qty = ${$join_table}->product_qty-$item->qty;
                  $product->save();
                }

                //chipping charge calculation
                $product_wt = $product_wt+(${$join_table}->product_weight*$item->qty);


                // check if there is any scheme active on selected product, apply if active
                //   $product = Products::where('product_id',$item->product_id)->first();
                //   if($product and $item->schemes_id != '' or $item->schemes_id != NULL){
                //     $scheme = Schemes::where('schemes_id',$item->schemes_id)->first();
                //
                //     if($product->schemes_id != "" and $item->qty >= $scheme->min_product_qty){
                //       $current_date = date("Y-m-d");
                //       $scheme_end_date = $product->scheme_end_date;
                //       if($scheme_end_date >= $current_date){
                //
                //         $order_product = new OrdersProductDetails();
                // $order_product->product_id = $item->product_id;
                // $order_product->qty = $scheme->free_product_qty;
                // $order_product->product_price = 0;
                // $order_product->schemes_id = $scheme->schemes_id;
                // $order_product->scheme_title = $scheme->scheme_title;
                // $order_product->order_id = $order->order_id;
                // $order_product->orders_counter_id = $orders_counter_increment_id;
                // $order_product->referral_id = $item->referral_id;
                // $order_product->distributor_id = $item->distributor_id;
                // $order_product->save();
                // // decrement the product QTY
                // $product->qty = $product->qty-$scheme->free_product_qty;
                // $product->save();
                //
                //       }
                //     }
                //   }
                  // ends
                $order_product_qty = $order_product_qty + $item->qty;//add all the produt items and save in main order // 21-07-2022
                $order_product_discount_amount = $order_product_discount_amount + $product_discount_amount_one;//add all the produt discount and save in main order // 21-07-2022//with * quantity
                $order_product_taxable_amount = $order_product_taxable_amount + $rev_taxable_amount;//add all the produt taxable amount and save in main order // 21-07-2022
                $order_product_gst_cgst_amt = $order_product_gst_cgst_amt + $gst_cgst_amount;//add all the produt cgst and save in main order // 21-07-2022
                $order_product_gst_sgst_amt = $order_product_gst_sgst_amt + $gst_sgst_amount;//add all the produt sgst and save in main order // 21-07-2022
                $order_product_gst_igst_amt = $order_product_gst_igst_amt + $gst_igst_amount;//add all the produt igst and save in main order // 21-07-2022

              }
              $order->qty = $order_product_qty;//for total qty of order // 21-07-2022
              $order->order_product_discount_amount = $order_product_discount_amount;//for total discount of order // 21-07-2022
              $order->order_product_taxable_amount = $order_product_taxable_amount;//for total taxable amount of order // 21-07-2022
              $order->order_product_gst_cgst_amt = $order_product_gst_cgst_amt;//for total cgst of order // 21-07-2022
              $order->order_product_gst_sgst_amt = $order_product_gst_sgst_amt;//for total sgst of order // 21-07-2022
              $order->order_product_gst_igst_amt = $order_product_gst_igst_amt;//for total igst of order // 21-07-2022
              $order->update();
              $total_mrp_dicount = $total_mrp-$final_total;
              $shipping_charge = get_shipping_charges('S',$product_wt,$company->pincode,'Delivered',$shipping_address->shipping_pincode);
              $shipping_charge = json_decode($shipping_charge,true);
              $shipping_charges = isset($shipping_charge[0])?$shipping_charge[0]:[];
              // $shipping_amount = $shipping_charge[0]->total_amount;
              $shipping_amount = isset($shipping_charge[0]['total_amount'])?$shipping_charge[0]['total_amount']:0;
              // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;


              //coupon discount
              $discount_value = 0;
              $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
              if(isset($cart_coupon->coupon))
              {
                $paymentDate = date('Y-m-d');
                $paymentDate = date('Y-m-d', strtotime($paymentDate));
                $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
                $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

                if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
                {
                  if($cart_coupon->coupon->coupon_type == 'flat')
                  {
                    $coupon_value = $cart_coupon->coupon->value;
                    $discount_value = $coupon_value;
                  }
                  else
                  {
                    $coupon_value = $cart_coupon->coupon->value;
                    $discount_value = ($final_total*$coupon_value)/100;
                  }


                }
                else
                {
                  $discount_value = 0;
                }
              }
              else
              {
                $discount_value = 0;
              }
              // $discount_value = $final_total * $discount_setting->discount_percent/100;
              $final_discounted_value = $final_total - $discount_value;
              //if shipping is free
              if($final_discounted_value < $shipping_charge_management->purchase_min_limit)
              {
                $final_discounted_value = $final_discounted_value+$shipping_amount;
              }
              // $gst_value = $final_discounted_value * $gst->gst_percent/100;
              // $grand_total = $final_discounted_value + $gst_value;
              $grand_total = $final_discounted_value+$cod_collection_charge_amount;

              $current_order = Orders::Where("order_id",$order->order_id)->first();
              //shipping method type flat/free : free if aboove the limit
              if($final_discounted_value < $shipping_charge_management->purchase_min_limit)
              {
                $current_order->shipping_method_code = 'flat';
              }
              else
              {
                $current_order->shipping_method_code = 'free';
              }
              $current_order->total = $grand_total;
              // $current_order->total = $final_total;
              $current_order->shipping_amount = $shipping_amount;
              $current_order->shipping_dump = json_encode($shipping_charges);
              //shipping address details
              // $shipping_address = ShippingAddresses::where('user_id',$user_session->id)->where('shipping_address_id',$missing_payments['shipping_address_id'])->first();
              if ($shipping_address)
              {
                $current_order->shipping_address_id = $shipping_address->shipping_address_id;
                $current_order->shipping_full_name = $shipping_address->shipping_full_name;
                $current_order->shipping_mobile_no = $shipping_address->shipping_mobile_no;
                $current_order->shipping_alt_mobile_no = $shipping_address->shipping_alt_mobile_no;
                $current_order->shipping_address_line1 = $shipping_address->shipping_address_line1;
                $current_order->shipping_address_line2 = $shipping_address->shipping_address_line2;
                $current_order->shipping_landmark = $shipping_address->shipping_landmark;
                $current_order->shipping_city = $shipping_address->shipping_city;
                $current_order->shipping_pincode = $shipping_address->shipping_pincode;
                $current_order->shipping_district = $shipping_address->shipping_district;
                $current_order->shipping_state = $shipping_address->shipping_state;
                $current_order->shipping_address_type = $shipping_address->shipping_address_type;
              }
              // $current_order->gst_percent = $gst->gst_percent;
              // $current_order->discount_percent = $discount_setting->discount_percent;
              // $current_order->gst_value = $gst_value;
              $current_order->total_mrp_dicount = $total_mrp_dicount;
              $current_order->total_mrp = $total_mrp;
              $current_order->confirmed_stage = 0;
              // $current_order->confirmed_date = $date_time;
              if(isset($cart_coupon->coupon))
              {
                $current_order->coupon_type = $cart_coupon->coupon->coupon_type;
                $current_order->coupon_value = $cart_coupon->coupon->value;
                $current_order->coupon_discount = $discount_value;
                $current_order->coupon_code = $cart_coupon->coupon->coupon_code;
                $current_order->cart_coupon_id = $cart_coupon->cart_coupon_id;
              }

              // $current_order->discounted_value = $final_discounted_value;
              // $current_order->mark = ($final_discounted_value/$one_mark_value);
              // $current_order->mark_value = $final_discounted_value;

              // $current_date = date('Y-m-d');
              // $mark_parent_id = mark_parent_data($month,$year);
              // $personal_mark = MarkMaster::whereRaw('mark_value_in_rs=(SELECT max(mark_value_in_rs) FROM `mark_master` where mark_parent_id="'.$mark_parent_id.'" and mark_value_in_rs < "'.$current_order->discounted_value.'")')->first();
              // if($personal_mark)
              // {
              //   $current_order->commission_percent = $personal_mark->mark_value_in_percent;
              // }
              $current_order->package_weight = ($product_wt!=0)?$product_wt:0;

              if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
              {
                $current_order->cod_collection_charge = $cod_collection_charge;
                $current_order->cod_cgst_percent = $cod_cgst_percent;
                $current_order->cod_sgst_percent = $cod_sgst_percent;
                $current_order->cod_igst_percent = $cod_igst_percent;
                $current_order->cod_cgst_amount = $cod_cgst_amount;
                $current_order->cod_sgst_amount = $cod_sgst_amount;
                $current_order->cod_igst_amount = $cod_igst_amount;
                $current_order->cod_collection_charge_amount =  $cod_collection_charge_amount;
              }

              $current_order->save();
              // $bulk_waybills = create_bulk_waybill($cart->sum('qty'));
              // $order_creation_response = order_creation($bulk_waybills,$current_order,$product_wt);
              // dd($order_creation_response);
              $invoicemodel = $current_order;
              // $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
              // $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);


            }
            if (isset($cart_coupon))
            {
              $cart_coupon->delete();
            }
            Cart::where('user_id',$user_id)->delete();
            if(isset($current_order) && $current_order->confirmed_stage == 1)
            {
              self::SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
            }
            // $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
            // $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);
            // dd($cod_collection_charge_amount);
            if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
            {
              return ['flag'=>true,'current_order'=>$current_order];
            }
            return view('frontend.cart.payment.success',compact('current_order'));
          }

        }
        else
        {
          if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
          {
            return ['flag'=>false,'current_order'=>[]];
          }
          return view('frontend.cart.payment.failure');
        }
      }
      $current_order = Orders::Where("transaction_id",$txnid)->first();
      if (isset($_POST['paymentmode']) && $_POST['paymentmode']=='cod')
      {
        return ['flag'=>true,'current_order'=>$current_order];
      }
	    return view('frontend.cart.payment.success',compact('current_order'));
    }

    public function paymentfailure()
    {

      // $shipping=Shipping::where('shipping_method_status',1)->first();
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        $user_session = auth()->user();
      }
      $cart_items = Cart::where('user_id',$user_id)->get();
      $status='failure';
      $firstname=$_POST["firstname"];
      $amount=$_POST["amount"];
      $txnid=$_POST["txnid"];
      $productinfo=$_POST["productinfo"];
      $email=$_POST["email"];
      //$user_session = auth()->user();
      $date_time = $_POST['addedon'];
      if($user_session):
      $missing_payments = MissingPayments::where('user_id',$user_session->id)->Where('transaction_id',$txnid)->Where('email',$email)->first();
    endif;

      if($missing_payments):
      //$missing_payments->payu_response = 'N';
      $missing_payments->payu_response = 'F';
      $missing_payments->status = "Failure";
      // $missing_payments->shipping_method_code = $shipping->shipping_method_code;
      // $missing_payments->shipping_method_cost = $shipping->shipping_method_cost;
      // $missing_payments->discount=$cart->discount;
      $missing_payments->data_dump = json_encode($_POST);
      $missing_payments->save();
      endif;
      //return $this->render('payment/failure');
      return view('frontend.cart.payment.failure');
    }


    public function addMissingPayment($post_data,$transaction_id,$shipping_amount,$shipping_charges)
    {
      // add missing payments data
      // $shipping=Shipping::where('shipping_method_status',1)->first();
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        $user_session = auth()->user();
      }
      $cart_items = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
      $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
      if(isset($cart_coupon->coupon))
      {
        $paymentDate = date('Y-m-d');
        $paymentDate = date('Y-m-d', strtotime($paymentDate));
        $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
        $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

        if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
        {
          if($cart_coupon->coupon->coupon_type == 'flat')
          {
            $coupon_value = $cart_coupon->coupon->value;
            $discount_value = $coupon_value;
          }
          else
          {
            $coupon_value = $cart_coupon->coupon->value;
            $final_total = get_cart_mrp_total();
            $discount_value = ($final_total->cart_total*$coupon_value)/100;
          }


        }
        else
        {
          $discount_value = 0;
        }
      }
      else
      {
        $discount_value = 0;
      }

      $payment_info = new MissingPayments();
      $payment_info->status = 'initiated';
      if($user_session):
        $user_details = User::where('id',$user_session->id)->first();
        $payment_info->user_id = $user_details->id;
      endif;
      //     if (!empty($coupon_code)) {
      //   $payment_info->coupon_cart_id = $coupon_code->coupon_cart_id;
      //   $payment_info->coupon_code = $coupon_code->coupon_code;
      //     $payment_info->coupon_commission = $coupon_code->coupon_commission;
      //             $payment_info->coupon_code_id = $coupon_code->coupon_code_id;
      //
      // }

      //       if (!empty($pickup_check)) {
      //   $payment_info->pickup_flag = 1;
      //       $payment_info->pickup_address_id = $pickup_check->pickup_address_id;
      //
      //       }
      // else{
      $payment_info->pickup_flag = 0;
      $payment_info->shipping_method_code = '';
      $payment_info->shipping_method_cost = $shipping_amount;
      //  }
      if(isset(auth()->user()->id))
      {
        $payment_info->email = auth()->user()->email;
        $payment_info->customer_name = auth()->user()->name;
      }
      else
      {
        $payment_info->email = $post_data['email'];
        $payment_info->customer_name = $post_data['firstname'];
      }
      $payment_code=$post_data['paymentmode'];
      $payment_info->transaction_id = $transaction_id;
      $payment_info->amount = $post_data['amount'];
      $payment_info->payment_date = date('Y-m-d H:i:s');
      $payment_info->data_dump = json_encode($post_data);
      $payment_info->shipping_amount = $shipping_amount;
      $payment_info->shipping_dump = json_encode($shipping_charges);
      $payment_info->payment_mode = $payment_code;
      // $payment_info->shipping_address_id = $post_data['shipping_id'];
      if(isset($cart_coupon->coupon))
      {
        $payment_info->cart_coupon_id = $cart_coupon->cart_coupon_id;
        $payment_info->coupon_id = $cart_coupon->coupon_id;
        $payment_info->coupon_code = $cart_coupon->coupon_code;
        $payment_info->coupon_type = $cart_coupon->coupon->coupon_type;
        $payment_info->coupon_value = $cart_coupon->coupon->value;
        $payment_info->coupon_discount = $discount_value;

      }
      $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$post_data['shipping_id'])->first();
      if ($shipping_address)
      {
        $payment_info->shipping_address_id = $shipping_address->shipping_address_id;
        $payment_info->shipping_full_name = $shipping_address->shipping_full_name;
        $payment_info->shipping_mobile_no = $shipping_address->shipping_mobile_no;
        $payment_info->shipping_alt_mobile_no = $shipping_address->shipping_alt_mobile_no;
        $payment_info->shipping_address_line1 = $shipping_address->shipping_address_line1;
        $payment_info->shipping_address_line2 = $shipping_address->shipping_address_line2;
        $payment_info->shipping_landmark = $shipping_address->shipping_landmark;
        $payment_info->shipping_city = $shipping_address->shipping_city;
        $payment_info->shipping_pincode = $shipping_address->shipping_pincode;
        $payment_info->shipping_district = $shipping_address->shipping_district;
        $payment_info->shipping_state = $shipping_address->shipping_state;
        $payment_info->shipping_address_type = $shipping_address->shipping_address_type;
      }
      $payment_info->save();

      $total_mrp = 0;
      $total_mrp_dicount = 0;
      $product_wt = 0;
      foreach ($cart_items as $cart)
      {
        $join_table = 'products';
        if($cart->product_type=="configurable")
        {
          $join_table = 'product_variant';
        }
        $missing_payment_product=new MissingPaymentProducts();
        //var_dump($missing_payment_product);exit;
          $missing_payment_product->product_id=$cart->product_id;
          $missing_payment_product->product_variant_id=$cart->product_variant_id;
          $missing_payment_product->product_type=$cart->product_type;
          $missing_payment_product->qty=$cart->qty;
          //         if (!empty($coupon_code)) {
          //   $discounted_product=CouponCodeProducts::find()->where(['coupon_code_id'=>$coupon_code->coupon_code,'product_id'=>$cart->product_id])->one();
          //
          //   if ($discounted_product) {
          //     $missing_payment_product->product_price=$discounted_product->discounted_price;
          //   }
          //   else {
          //     $missing_payment_product->product_price=$cart->product->price;
          //   }
          //
          // }
          // else {
          // $missing_payment_product->product_price=$cart->products->product_discounted_price;
          $missing_payment_product->product_title = $cart->{$join_table}->product_title;
          $missing_payment_product->product_sub_title = isset($cart->products->brands)?$cart->products->brands->brand_name:'';
          $missing_payment_product->product_price = $cart->{$join_table}->product_price;
          $missing_payment_product->product_discounted_price = $cart->{$join_table}->product_discounted_price;
          $missing_payment_product->product_discount = $cart->{$join_table}->product_discount;
          $missing_payment_product->product_discount_type = $cart->{$join_table}->product_discount_type;
          $missing_payment_product->product_color = (isset($cart->{$join_table}->color))?$cart->{$join_table}->color->color_name:$cart->{$join_table}->color_id;
          $missing_payment_product->product_size = (isset($cart->{$join_table}->size))?$cart->{$join_table}->size->size_name:$cart->{$join_table}->size_id;
          $missing_payment_product->product_weight = $cart->{$join_table}->product_weight;
          $missing_payment_product->product_sku = $cart->{$join_table}->product_sku;
          $missing_payment_product->product_hsn = (isset($cart->products->hsncode))?$cart->products->hsncode->hsncode_name:'';

          //}
          $missing_payment_product->discount=$cart->discount;
          $missing_payment_product->currency=$cart->currency;
       //    if (empty($pickup_check)) {
       // $missing_payment_product->shipping_method_code=$shipping->shipping_method_code;
       //    $missing_payment_product->shipping_method_cost=$shipping->shipping_method_cost;
       //      }
          //$missing_payment_product->shipping_method_code=$shipping->shipping_method_code;
          //$missing_payment_product->shipping_method_cost=$shipping->shipping_method_cost;
          //var_dump($missing_payment_product->payment_id);exit;
          $missing_payment_product->payment_id=$payment_info->payment_id;
          // $orders_product->orders_counter_id=$ordercounter->orders_counter;
        //var_dump($orders_product);exit;
        $product_discount_amount = ($cart->{$join_table}->product_discounted_amount*$cart->qty);
        $missing_payment_product->product_discounted_amount = $product_discount_amount;
        $net_amount = ($cart->{$join_table}->product_discounted_price*$cart->qty);
        $missing_payment_product->net_amount = $net_amount;

        $missing_payment_product->save();
        $payment_info->total_mrp = $total_mrp;
        $total_mrp = $total_mrp + ($cart->{$join_table}->product_price*$cart->qty);
        $product_wt = $product_wt+($cart->{$join_table}->product_weight*$cart->qty);
    }

    $total_mrp_dicount = $total_mrp-$post_data['amount'];
    $payment_info->total_mrp_dicount = $total_mrp_dicount;
    $payment_info->total_mrp = $total_mrp;
    $payment_info->package_weight = ($product_wt!=0)?$product_wt:0;
    $payment_info->save();
  return;
  }



    public function checkout1()
    {

      $month = date('m');
      $year = date('Y');
      // $gst = Gst::Where('default_gst',1)->first();
      $discount_setting = DiscountSetting::first();
      $one_mark_value = mark_setting_data($month,$year);

      $user_id = auth()->user()->id;
      $cart = Cart::where('user_id',$user_id)->get();
      $orders_counter = OrdersCounter::first();
      $orders_counter_increment_id = $orders_counter->orders_counter+1;
      $orders_counter->orders_counter = $orders_counter_increment_id;
      $orders_counter->save();
      $order_total = Cart::where('user_id',$user_id)->select(\DB::raw('sum(price*qty) AS total_sales'))->first();
      if($cart)
      {
        $order = new Orders();
        $order->user_id = $user_id;
        $order->orders_counter_id = $orders_counter_increment_id;
        $order->one_mark_value = $one_mark_value;

        if($order->save())
        {
          $final_total = 0;
        foreach($cart as $item)
        {
          $product = Products::Where('product_id',$item->product_id)->first();
            $order_product = new OrdersProductDetails();
            $order_product->product_id = $item->product_id;
            $order_product->qty = $item->qty;
            $order_product->product_price = $product->price;
            $order_product->order_id = $order->order_id;
            $order_product->orders_counter_id = $orders_counter_increment_id;
            $order_product->referral_id = $item->referral_id;
            $order_product->distributor_id = $item->distributor_id;
            $order_product->save();

            $final_total = $final_total + ($product->price*$item->qty);
          }

          $discount_value = $final_total * $discount_setting->discount_percent/100;
          $final_discounted_value = $final_total - $discount_value;
          // $gst_value = $final_discounted_value * $gst->gst_percent/100;
          // $grand_total = $final_discounted_value + $gst_value;
          $grand_total = $final_discounted_value;

          $current_order = Orders::Where("order_id",$order->order_id)->first();
          $current_order->total = $final_total;
          // $current_order->gst_percent = $gst->gst_percent;
          $current_order->discount_percent = $discount_setting->discount_percent;
          $current_order->gst_value = $grand_total;
          $current_order->discounted_value = $final_discounted_value;
          $current_order->mark = ($final_discounted_value/$one_mark_value);
          $current_order->mark_value = $final_discounted_value;

          // $current_date = date('Y-m-d');
      $mark_parent_id = mark_parent_data($month,$year);

          $personal_mark = MarkMaster::whereRaw('mark_value_in_rs=(SELECT max(mark_value_in_rs) FROM `mark_master` where mark_parent_id="'.$mark_parent_id.'" and mark_value_in_rs < "'.$current_order->discounted_value.'")')->first();
          if($personal_mark)
          {
            $current_order->commission_percent = $personal_mark->mark_value_in_percent;
          }

          $current_order->save();
        }
        Cart::where('user_id',$user_id)->delete();
        return redirect()->to('/')->with('success','Order Placed Successfully !');;
      }
    }

    public function deleteitem($id)
    {
      $delete = Cart::where('id',$id)->delete();
      //remove coupon pending
      Session::flash('message', 'Product Deleted Successfully!');
      // Session::flash('status', 'success');

      return redirect()->to('cart');
    }

    public function updatecart(Request $request)
    {
      $this->validate(request(), [
        'cart_data' => 'required',
      ]);
      // dd($_POST);
      if (isset($_POST))
      {
        $cart_data = $_POST['cart_data'];

        foreach($cart_data as $key=>$values)
        {
          $value = $values['qty'];
          $product_type = $values['product_type'];
          if( $value > 0)
          {
            // check if there is any scheme active on selected product, apply if active
            $cart_product = Cart::where('id',$key)->first();
            // $product = Products::where('product_id',$cart_product->product_id)->first();
            if ($product_type =='simple')
            {
              $product = Products::where('product_id',$cart_product->product_id)->first();
            }
            elseif ($product_type =='configurable')
            {
              $product_variant_id = $values['product_variant_id'];
              $product = ProductVariants::where('product_id',$cart_product->product_id)->where('product_variant_id',$product_variant_id)->first();
            }

            if($product->product_qty <= 0)
            {
              Session::flash('error', 'Something went wrong!');
            }
            else if($product->out_of_stock_flag == 0)
            {
              Session::flash('error', 'Something went wrong!');
            }
            else if($product->product_qty < $value)
            {
              // Session::flash('error', 'Please Change Quantity Only '.$product->product_qty.' left!');
              Session::flash('error', 'Please Change Quantity of product '.$product->product_title.' Only '.$product->product_qty.' left!');
            }
            else
            {
              $cart_items = Cart::where('id',$key)->update(['qty' => $value]);
              Session::flash('success', 'Cart Updated Successfully!');
            }


            if($product)
            {
              // $scheme = Schemes::where('schemes_id',$product->schemes_id)->first();

              if(isset($product->schemes_id) && $product->schemes_id != "" and $cart_product->qty >= $scheme->min_product_qty)
              {
                $current_date = date("Y-m-d");
                $scheme_end_date = $product->scheme_end_date;
                if($scheme_end_date >= $current_date)
                {
                  Cart::where('id',$key)->update(['schemes_id' => $product->schemes_id]);
                }
                else
                {
                  Cart::where('id',$key)->update(['schemes_id' => NULL]);
                }
              }
              else
              {
                Cart::where('id',$key)->update(['schemes_id' => NULL]);
              }
            }
            // ends

          }
        }


        return redirect()->to('cart');
      }
      else
      {
        Session::flash('error', 'Something went wrong!');
        // Session::flash('status', 'success');

        return redirect()->to('cart');
      }
    }


    public function SendInvoice($invoicemodel,$email,$date,$payment_mode)
    {
      //var_dump($email);exit;
      try
      {
        $mail = new \PHPMailer();
        $mail->IsSMTP();

        $mail->CharSet = "utf-8";// set charset to utf8
        //          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

        // $mail->SMTPAuth = true; // authentication enabled
        // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        // $mail->Host = "smtp.gmail.com";
        // $mail->Port = 587; // or 465

        //for live start
        $mail->Host       = "localhost";
        $mail->SMTPSecure = "tls";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = false;
        $mail->Mailer     ="smtp";
        $mail->Port       = 25;
        $mail->Username = "";
        $mail->Password = '';
        //for live end

        //for local start
        // $mail->SMTPAuth = true; // authentication enabled
        // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        // $mail->Host = "smtp.gmail.com";
        // $mail->Port = 587; // or 465
        // $mail->Username = "testesatwat@gmail.com";
        // $mail->Password = 'Esatwat@0000';
        //for local end

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // $mail->isHTML(true);
        $mail->SetFrom(' info@dadreeios.com', 'Dadreeios');
        $mail->AddBCC("maheshm@parasightsolutions.com");
        $mail->AddAddress($email);
        $mail->Subject = "Order Invoice";
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

        $id = $invoicemodel->order_id;
        $orders = Orders::where('order_id',$id)->join("users","users.id","=","orders.user_id")->join("payment_info","payment_info.payment_tracking_code","=","orders.payment_tracking_code")->orderBy('order_id', 'DESC')->first();
        // $products = Orders::selectRaw('orders.*,orders_product_details.*,products.product_title')->leftJoin('orders_product_details', function($join) {
        // $join->on('orders_product_details.order_id', '=', 'orders.order_id');
        // })->join('products', 'products.product_id', '=', 'orders_product_details.product_id')->Where('orders.order_id',$id)->get();
        $company = Company::first();
        $pdf=PDF::loadView('frontend.orders.invoice_card',['orders'=>$orders,'company'=>$company]);
        $invoice_msg = view('frontend.orders.invoice_card', compact('orders','company'))->render();
        $newsletter = Newsletters::where('email',$invoicemodel->email)->first();
        $unsubscribe_data = "";
        if(isset($newsletter) && $newsletter->token != '')
        {
            $unsub_token = $newsletter->token;
            $unsubscribe_url = url('/newsletter/unsubscribe',$unsub_token);
            $unsubscribe_data = "<p style='font-size:12px;line-height:normal;font-family:arial;text-align:center;'>--<br><a href='".$unsubscribe_url."' target='_blank' >Click Here</a> to unsubscribe from this newsletter.<br><br></p>";
        }

        // $unsubscribe_url = URL::to('/').'/newsletter/unsubscribe/'.$unsub_token;
        // $unsubscribe_url = '';
        //$invoive_msg=$this->renderPartial('invoice',['invoicemodel'=>$invoicemodel,'date'=>$date,'payment_mode'=>$payment_mode]);
        $message = "
        <html>
        <head>
        <style>
        table{width:100%;}
        table,td{
          border:1px solid #ccc;
          border-collapse: collapse;
        }
        td{
          padding:8px;
          font-size:15px;
        }
        h1{
          font-size:16px;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        th{
            background-color:rgba(127,82,53, 0.85);
        }
        </style>
        </head>
        <body><div style='margin:auto;'><a href='http://dadreeios.com/'><img src='http://parasightdemo.com/dadreeios/frontend-assets/images/logoparwani.png' width='120'></a></div>
        <h2 style='color:#333;'>Dadreeios</h2><h4 style='color:#333;'>Thank you for shoping at Dadreeios. You order is under process and hopefully will be delivered in <span styly='font-weight:bold;'>7 to 8 days.</span></h4>".$invoice_msg."
        ".$unsubscribe_data."</body></html>
        " ;
        $mail->MsgHTML($message);
        //echo $message;
        // var_dump($message);
        $mail->IsHTML(true);
        // $pdf->output();
        $mail->addStringAttachment($pdf->output('S'), "Invoice.pdf");
        $mail->Send();
        //echo "Message Sent OK</p>\n";
      }
      catch (phpmailerException $e)
      {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
      }
      catch (Exception $e)
      {
        echo $e->getMessage(); //Boring error messages from anything else!
      }
      // end try catch block

    }


    public function Sendneworder($invoicemodel,$payment_mode,$name){

    //var_dump($email);exit;

      try {
      //$to = "vijay@parasightsolutions.com";
    $to = "info@dadreeios.com";

        $mail = new \PHPMailer(true);
        $mail->IsSMTP();

          $subject="New Order Update";
          // $from = "enquiry@triveniinfra.in";
          // $from = "hr@triveniinfra.in";
          $from = "info@dadreeios.com";

          $mail->Host       = "localhost";
                  //$mail->SMTPSecure = "tls";
                  $mail->SMTPDebug  = 0;
                  $mail->SMTPAuth   = false;
                  $mail->Mailer     ="smtp";
                  $mail->Port       = 25;
                      $mail->SMTPOptions = array(
              'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              )
          );
                  $mail->Username = "";
                  $mail->Password = '';


          $mail->AddAddress($to);
          $mail->SetFrom($from);
          $mail->AddBCC("maheshm@parasightsolutions.com");
        //   $mail->AddBCC("vijay@parasightsolutions.com");
        //   $mail->AddBCC("info@parasightsolutions.com");
          $mail->Subject = $subject;
          $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

          $id = $invoicemodel->order_id;
          $orders = Orders::where('order_id',$id)->join("users","users.id","=","orders.user_id")->join("payment_info","payment_info.payment_tracking_code","=","orders.payment_tracking_code")->orderBy('order_id', 'DESC')->first();
        //   $products = Orders::selectRaw('orders.*,orders_product_details.*,products.product_title')->leftJoin('orders_product_details', function($join) {
        //   $join->on('orders_product_details.order_id', '=', 'orders.order_id');
        // })->join('product', 'products.product_id', '=', 'orders_product_details.product_id')->Where('orders.order_id',$id)->get();
          $company = Company::first();
          $neworder_msg = view('frontend.orders.invoice_card', compact('orders','company'));

          $message = "
          <html>
          <head>
          <style>
          table{width:100%;}
          table,td{
            border:1px solid #ccc;
            border-collapse: collapse;
          }
          td{
            padding:8px;
            font-size:15px;
          }
          h1{
            font-size:16px;
          }
          tr:nth-child(even) {background-color: #f2f2f2;}
          th{
              background-color:rgba(127,82,53, 0.85);
          }
          </style>
          </head>
          <body><div style='margin:auto;'><a href='http://holyhanspariwar.com/'><img src='http://parasightdemo.com/dadreeios/frontend-assets/images/logoparwani.png' width='120'></a></div>
        <h4 style='color:#333;'>You have received a new order from <span styly='padding:0 5px;'>".$name."</span>.</h4><p style='color:#333;'>Order Details are as follows:</p>".$neworder_msg."</body></html>
          " ;
          $mail->MsgHTML($message);
          //echo $message;
          $mail->IsHTML(true);
          $mail->Send();
          //echo "Message Sent OK</p>\n";
        } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
          echo $e->getMessage(); //Boring error messages from anything else!
        }
        // end try catch block

    }
public function addWalletMissingPayment($post_data,$transaction_id,$wallet_id,$wallet_reduction)
{
  // add missing payments data
  if(isset(auth()->user()->id))
  {
    $user_id = auth()->user()->id;
    $account_type = 'D';
    $user_session = auth()->user();
  }
  if(isset(auth()->guard('pariwar_customer')->user()->id))
  {
    $user_id = auth()->guard('pariwar_customer')->user()->id;
    $account_type = 'P';
    $user_session = auth()->guard('pariwar_customer')->user();
  }


  $payment_info = new WalletPayments();
  $payment_info->status = 'initiated';
  if($user_session):
    if ($account_type == 'D')
    {
      $user_details = User::where('id',$user_session->id)->first();
    }
    if ($account_type == 'P')
    {
      $user_details = PariwarCustomers::where('id',$user_session->id)->first();
    }
  $payment_info->user_id = $user_details->id;
  endif;

  $payment_info->email = $post_data['email'];
  $payment_info->customer_name = $post_data['firstname'];
  $payment_info->transaction_id = $transaction_id;
  $payment_info->amount = $post_data['amount'];
  $payment_info->payment_date = date('Y-m-d H:i:s');
  $payment_info->data_dump = json_encode($post_data);
  $payment_info->account_type = $account_type;
  $payment_info->wallet_id = $wallet_id;
  $payment_info->wallet_reduction_amount = $wallet_reduction;
  $payment_info->save();

  return;
}
// public function walletpaymentsuccess($post_data,$transaction_id,$wallet_id,$wallet_reduction)
// {
//   //var_dump($_SESSION);exit;
//   // $order_counter=OrdersCounter::find()->max('orders_counter_id')->one();
//   $order_counter=OrdersCounter::where('orders_counter_id',1)->first();
//   $shipping=Shipping::where('shipping_method_status',1)->first();
//
//   $month = date('m');
//   $year = date('Y');
//   try {
//     if (empty($order_counter)) {
//       $order_counters=new OrdersCounter();
//       $order_counters->orders_counter=100001;
//       $order_counters->save();
//
//     }
//     else {
//     // $order_counter_val=((int)$order_counter->orders_counter + 1);
//     // $order_counter->orders_counter=$order_counter_val;
//     //   $order_counter->save();
//
//     }
//
//   } catch (Exception $e) {
//
//   }
//
//   $status='processing';
//   $firstname=$_POST["firstname"];
//   $amount=$_POST["amount"];
//   $txnid=$_POST["txnid"];
//   $productinfo=$_POST["productinfo"];
//   $email=$_POST["email"];
//   // $user_session = auth()->user();
//   if(isset(auth()->user()->id))
//   {
//     $user_session = auth()->user();
//     $account_type = 'D';
//   }
//   if(isset(auth()->guard('pariwar_customer')->user()->id))
//   {
//     $user_session = auth()->guard('pariwar_customer')->user();
//     $account_type = 'P';
//   }
//   $date_time = date('Y-m-d H:m:s');
//   // $payment_code="payumoney";
//   //$guest_unique_id = Yii::$app->functions->getGuestUniqueId();
//
//   $payment_tracking_code = substr(md5(microtime()),rand(0,20),20);
//   // ALTER TABLE `payment_info` ADD `account_type` VARCHAR(20) NULL AFTER `user_id`;
//   // UPDATE payment_info SET `account_type`='D' WHERE 1
//   $existing_wallet = Wallet::where('user_id',$user_session->id)->Where('account_type',$account_type)->first();
//   $wallet_id = isset($existing_wallet->wallet_id)?$existing_wallet->wallet_id:'';
//   // $wallet_missing_payments = WalletPayments::where('user_id',$user_session->id)->Where('account_type',$account_type)->Where('transaction_id',$txnid)->Where('email',$email)->Where('wallet_id',$wallet_id)->first();
//   $payment_amount = $wallet_reduction;
//   $wallet_payment_code = 'wallet';
//   $wallet_payment_info = new PaymentInfo();
//   $wallet_payment_info->status = $status;
//   if($user_session):
//   $wallet_payment_info->user_id = $user_session->id;
//   endif;
//   $wallet_payment_info->email = $email;
//   $wallet_payment_info->customer_name = $firstname;
//   $wallet_payment_info->transaction_id = $txnid;
//   $wallet_payment_info->amount = $payment_amount;
//   $wallet_payment_info->payment_date = $date_time;
//   $wallet_payment_info->data_dump = json_encode($_POST);
//   $wallet_payment_info->payment_tracking_code = $payment_tracking_code;
//   $wallet_payment_info->payment_mode = $wallet_payment_code;
//   $wallet_payment_info->account_type = $account_type;
//   if($wallet_payment_info->save())
//   {
//     // $wallet_missing_payments->wallet_response = 'Y';
//     // $wallet_missing_payments->data_dump = $wallet_payment_info->data_dump;
//     // $wallet_missing_payments->save();
//     $existing_wallet_balance = $existing_wallet->wallet_balance;
//     $existing_wallet->wallet_balance = $existing_wallet->wallet_balance - $payment_amount;
//     if($existing_wallet->save())
//     {
//       //wallet transaction
//       $wallet_transaction = new WalletTransactions();
//       $wallet_transaction->wallet_id = $wallet_id;
//       if($user_session):
//       $wallet_transaction->user_id = $user_session->id;
//       endif;
//       $wallet_transaction->account_type = $account_type;
//       $wallet_transaction->transaction_points = $payment_amount;
//       $wallet_transaction->wallet_points_before = $existing_wallet_balance;
//       $wallet_transaction->wallet_points_after = $existing_wallet->wallet_balance;
//       $wallet_transaction->transaction_description = $productinfo;
//       $wallet_transaction->transaction_type = 'DEBITED';
//       $wallet_transaction->transaction_date = date('Y-m-d H:m:s');
//       $wallet_transaction->save();
//       // echo "<pre>";print_r($existing_wallet);//exit;
//       // exit;
//     }
//
//     // $cart_remove=Cart::find()->where(['user_id'=>$payment_info->user_id] OR ['guest_unique_id'=>$payment_info->guest_unique_id])->one();
//
//     // $gst = Gst::Where('default_gst',1)->first();
//     $discount_setting = DiscountSetting::first();
//     $one_mark_value = mark_setting_data($month,$year);
//
//     // $user_id = auth()->user()->id;
//     if(isset(auth()->user()->id))
//     {
//       $user_id = auth()->user()->id;
//       $account_type = 'D';
//     }
//     if(isset(auth()->guard('pariwar_customer')->user()->id))
//     {
//       $user_id = auth()->guard('pariwar_customer')->user()->id;
//       $account_type = 'P';
//     }
//     $cart = Cart::where('user_id',$user_id)->Where('account_type',$account_type)->get();
//     $orders_counter = OrdersCounter::first();
//     $orders_counter_increment_id = $orders_counter->orders_counter+1;
//     $orders_counter->orders_counter = $orders_counter_increment_id;
//     $orders_counter->save();
//     $order_total = Cart::where('user_id',$user_id)->Where('account_type',$account_type)->select(\DB::raw('sum(price*qty) AS total_sales'))->first();
//     if($cart)
//     {
//       $order = new Orders();
//       $order->user_id = $user_id;
//       $order->orders_counter_id = $orders_counter_increment_id;
//       $order->one_mark_value = $one_mark_value;
//       $order->payment_tracking_code = $payment_tracking_code;
//       if(!empty($shipping))
//       {
//         $order->shipping_method_code = $shipping->shipping_method_code;
//         $order->shipping_method_cost = $shipping->shipping_method_cost;
//       }
//       $order->data_dump = json_encode($_POST);
//       $order->account_type = $account_type;
//
//       if($order->save())
//       {
//         $final_total = 0;
//       foreach($cart as $item)
//       {
//         $product = Products::Where('product_id',$item->product_id)->first();
//           $order_product = new OrdersProductDetails();
//           $order_product->product_id = $item->product_id;
//           $order_product->qty = $item->qty;
//           $order_product->product_price = $product->price;
//           $order_product->order_id = $order->order_id;
//           $order_product->orders_counter_id = $orders_counter_increment_id;
//           $order_product->referral_id = $item->referral_id;
//           $order_product->distributor_id = $item->distributor_id;
//           $order_product->save();
//
//           $final_total = $final_total + ($product->price*$item->qty);
//           // decrement the product QTY
//           $product->qty = $product->qty-$item->qty;
//           $product->save();
//         }
//
//         $discount_value = $final_total * $discount_setting->discount_percent/100;
//         $final_discounted_value = $final_total - $discount_value;
//         // $gst_value = $final_discounted_value * $gst->gst_percent/100;
//         // $grand_total = $final_discounted_value + $gst_value;
//         $grand_total = $final_discounted_value;
//
//         $current_order = Orders::Where("order_id",$order->order_id)->first();
//         $current_order->total = $final_total;
//         // $current_order->gst_percent = $gst->gst_percent;
//         $current_order->discount_percent = $discount_setting->discount_percent;
//         $current_order->gst_value = $grand_total;
//         $current_order->discounted_value = $final_discounted_value;
//         $current_order->mark = ($final_discounted_value/$one_mark_value);
//         $current_order->mark_value = $final_discounted_value;
//
//         // $current_date = date('Y-m-d');
//         $mark_parent_id = mark_parent_data($month,$year);
//         $personal_mark = MarkMaster::whereRaw('mark_value_in_rs=(SELECT max(mark_value_in_rs) FROM `mark_master` where mark_parent_id="'.$mark_parent_id.'" and mark_value_in_rs < "'.$current_order->discounted_value.'")')->first();
//         if($personal_mark)
//         {
//           $current_order->commission_percent = $personal_mark->mark_value_in_percent;
//         }
//
//         $current_order->save();
//
//         $invoicemodel = $current_order;
//         // $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
//         // $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);
//
//         //order commission
//         $commission_existing_wallet = Wallet::where('user_id',$user_session->id)->Where('account_type',$account_type)->first();
//         $commission_wallet_id = isset($commission_existing_wallet->wallet_id)?$commission_existing_wallet->wallet_id:'';
//
//         $order_amount = $current_order->total;
//         $comission_earn = ($order_amount * 5)/100;
//         // echo $order_amount;
//         // echo " string ".$comission_earn;//exit;
//         // echo "<pre>";print_r($order);exit;
//
//         $commission_existing_wallet_balance = $commission_existing_wallet->wallet_balance;
//         $commission_existing_wallet->wallet_balance = $commission_existing_wallet->wallet_balance + $comission_earn;//add comissioin
//         if($commission_existing_wallet->save())
//         {
//           //wallet transaction for commission
//           $creditinfo = 'Commission earn agiants order for '.$productinfo.' of amount '.$order_amount.' .';
//           $commission_wallet_transaction = new WalletTransactions();
//           $commission_wallet_transaction->wallet_id = $commission_wallet_id;
//           if($user_session):
//           $commission_wallet_transaction->user_id = $user_session->id;
//           $commission_wallet_transaction->distributor_id = $user_session->distributor_id;
//           endif;
//           $commission_wallet_transaction->account_type = $account_type;
//           $commission_wallet_transaction->order_id = $current_order->order_id;
//           $commission_wallet_transaction->transaction_points = $comission_earn;
//           $commission_wallet_transaction->wallet_points_before = $commission_existing_wallet_balance;
//           $commission_wallet_transaction->wallet_points_after = $commission_existing_wallet->wallet_balance;
//           $commission_wallet_transaction->transaction_description = $creditinfo;
//           $commission_wallet_transaction->transaction_type = 'BONUS';
//           $commission_wallet_transaction->transaction_date = date('Y-m-d H:m:s');
//           $commission_wallet_transaction->save();
//         }
//       }
//       Cart::where('user_id',$user_id)->Where('account_type',$account_type)->delete();
//       $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
//       $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);
//       return true;
//       // return view('frontend.cart.wallet.success');
//     }
//
//   }
//   else{
//     return false;
//     // return view('frontend.cart.wallet.failure');
//   }
// }
  public function applycoupon(Request $request)
  {
    $data = $request->all();

    $user_id = auth()->user()->id;
    $get_cart_total = get_cart_total();
    // $get_cart_total = get_cart_mrp_total();
    // dd($get_cart_total->cart_total);
    $coupon_code = $request->coupon_code;
    $total_mrp_price = $get_cart_total->cart_total;
    // dd($total_mrp_price);
    $user = User::where('id',$user_id)->first();

    $coupon_data = Coupons::where('coupon_code',$coupon_code)->first();

    if($coupon_data)
    {
      $paymentDate = date('Y-m-d');
      $paymentDate = date('Y-m-d', strtotime($paymentDate));
      $contractDateBegin = date('Y-m-d', strtotime($coupon_data->start_date));
      $contractDateEnd = date('Y-m-d', strtotime($coupon_data->end_date));

      if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
      {

        $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
        if ($cart_coupon)
        {
          $cart_coupon->delete();
        }
        if ($total_mrp_price >= $coupon_data->coupon_purchase_limit)
        {
          $coupon_usage_count = get_coupon_usage_count($coupon_code);
          // dd($coupon_usage_count);
          if ($coupon_usage_count < $coupon_data->coupon_usage_limit)
          {
            $add_cart_coupon = new CartCoupons();
            $add_cart_coupon->user_id = $user_id;
            $add_cart_coupon->coupon_id = $coupon_data->coupon_id;
            $add_cart_coupon->coupon_code = $coupon_data->coupon_code;
            $add_cart_coupon->save();

            return ['success','Coupon Code Applied Successfully !'];
          }
          else
          {
            return ['error','You have reached maximum copoun usage limit!'];
          }
        }
        else
        {
          return ['error','Your cart amount needs to be above ₹ '.$coupon_data->coupon_purchase_limit.' to avail this offer!'];
        }
      }
      else
      {
        return ['error','Coupon Code has been Expired !'];
      }
    }
    else
    {
      return ['error','Invalid Coupon Code'];
    }
  }

  public function reviewaddress()
  {
    $user_id = auth()->user()->id;
    $user = User::where('id',$user_id)->first();
    $shipping_addresses = ShippingAddresses::where('user_id',$user_id)->get();
    return view('frontend.cart.shipping_address',compact('user','shipping_addresses'));
  }


  public function movetowishlist($id)
  {
    $delete_cart = Cart::where('id',$id)->first();

    $user_id = auth()->user()->id;
    // dd($request->all());
    $product_id = $delete_cart->product_id;
    $product = Products::where('product_id',$product_id)->first();

    $product_exist_in_wishlist = Wishlists::where('user_id',$user_id)->Where('product_id',$product_id)->first();
    if($product_exist_in_wishlist)
    {
      // dd('in');
      // return ['success','Product is alredy in your Wishlist !'];
      Session::flash('message', 'Product is alredy in your Wishlist !');
    }
    else
    {
      $add_wishlist = new Wishlists();
      $add_wishlist->user_id = $user_id;
      $add_wishlist->product_id = $product_id;

      $add_wishlist->save();
      // dd($add_wishlist);
      // return ['success','Product Added To The Wishlist !'];
      Session::flash('message', 'Product Added To The Wishlist !');
    }

    $delete_cart->delete();
    //remove coupon pending
    Session::flash('message', 'Product Moved Successfully!');
    // Session::flash('status', 'success');

    return redirect()->to('cart');
  }

  public function removecoupon(Request $request)
  {
    $data = $request->all();

    $user_id = auth()->user()->id;
    $user = User::where('id',$user_id)->first();

    $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();
    if ($cart_coupon)
    {
      $cart_coupon->delete();
      return ['success','Coupon Code Removed Successfully !'];
    }
    else
    {
      return ['error','Something went wrong !'];
    }
  }


  public function addshippingaddress(Request $request)
  {
    // dd('test');
    if(!auth()->user())
    {
      return back()->withErrors([
        'message' => 'Please login before Adding Shipping Address !'
      ])->with('error','Please login before Adding Shipping Address !');

    }
    $this->validate(request(), [
      'shipping_full_name' => 'required',
      'shipping_mobile_no' => 'required',
      'shipping_address_line1' => 'required',
      'shipping_address_line2' => 'required',
      'shipping_landmark' => 'required',
      'shipping_city' => 'required',
      'shipping_pincode' => 'required',
      'shipping_district' => 'required',
      'shipping_state' => 'required',
      'shipping_address_type' => 'required',
    ]);

    // dd($request->all());

    $user_id = auth()->user()->id;

    $add_shipping_address = new ShippingAddresses();
    $add_shipping_address->fill($request->all());
    $add_shipping_address->user_id = $user_id;
    if ($add_shipping_address->save())
    {
      return back()->with('success','New Shipping Address Added Successfully !');
    }
    else
    {
      return back()->with('error','Something went Wrong !');
    }

  }

  public function getcodcollectioncharges(Request $request)
  {
    $data = $request->all();
    $grand_total = $data['grand_total'];
    $shipping_state = $data['shipping_state'];

    $company = Company::first();
    $seller_state = $company->state;
    $cod_collection_charge = 0;
    $cod_charges = CODManagement::first();
    if ($cod_charges)
    {
      if ($seller_state == $shipping_state)
      {
        $cod_collection_charge = $cod_charges->cod_collection_charge+$cod_charges->cod_cgst_amount+$cod_charges->cod_sgst_amount;
        $grand_total = $grand_total+$cod_collection_charge;
      }
      else
      {
        $cod_collection_charge = $cod_charges->cod_collection_charge+$cod_charges->cod_igst_amount;
        $grand_total = $grand_total+$cod_collection_charge;
      }
      return ['success',$cod_collection_charge,$grand_total];
    }
    else
    {
      return ['error','Something went wrong while getting COD data!'];
    }
  }

  public function testapi()
  {
    // dd(track_order('5016410014792'));
    dd(packing_slip('5016410014792'));
    return view('frontend.cart.test_apis');
  }

  // public function addtobuy(Request $request)
  // {
  //   // dd($request);
  //   if(!auth()->user())
  //   {
  //     return back()->withErrors([
  //       'message' => 'Please login before purchasing any product !'
  //     ])->with('error','Please login before purchasing any product !');
  //
  //   }
  //   $this->validate(request(), [
  //     'product_id' => 'required',
  //     'quantity' => 'required',
  //     'color_id' => 'required',
  //     'size_id' => 'required',
  //   ]);
  //
  //   // dd($request->all());
  //   $product_id = $request->product_id;
  //   $product = Products::where('product_id',$product_id)->first();
  //   // check if product is in stock
  //   if($product->product_qty <= 0)
  //   {
  //     return back()->with([
  //         'error' => 'Product is out of stock'
  //     ]);
  //   }
  //   if($product->out_of_stock_flag == 0)
  //   {
  //     return back()->with([
  //         'error' => 'Product is out of stock'
  //     ]);
  //   }
  //
  //   $added_by = auth()->user()->id;
  //
  //   $quantity = 1;
  //   if(isset($request->quantity))
  //   {
  //     $quantity = $request->quantity;
  //   }
  //
  //   $user_id = auth()->user()->id;
  //   // $user_id = auth()->user()->id;
  //
  //
  //   $product_exist_in_cart = Cart::where('user_id',$user_id)->Where('product_id',$product_id)->first();
  //   if($product_exist_in_cart)
  //   {
  //     $product_qty = (int)$product_exist_in_cart->qty;
  //     $product_qty = $product_qty+$quantity;
  //     $product_exist_in_cart->qty = $product_qty;
  //
  //     $product_exist_in_cart->save();
  //     return rediret()->to('/checkout')->with('success','Product Added To Buy Now!');
  //   }
  //   else
  //   {
  //     $cart = new Cart();
  //     $cart->user_id = $user_id;
  //     $cart->product_id = $product_id;
  //     //$cart->price = ($quantity*$product->price);
  //     $cart->qty = $quantity;
  //     $cart->discount = $product->product_discount;
  //     // $cart->referral_id = $added_by;
  //     $cart->currency = 'INR';
  //
  //     $cart->save();
  //     return rediret()->to('/checkout')->with('success','Product Added To Buy Now !');
  //   }
  // }


  //dadreeio_dadreeios
  //dadreeios12@#
  //
public function goguestcart(){


$product_id = array();
$varient_id = array();

if( session('cart')== NULL){
    return redirect('/guest/emptycart');
}

$cart = new Collection();
    foreach(session('cart') as $item){
        // print_r($item);
        // die();
       $product_id[] = $item['product_id'];
        $cart_details = new Cart();
        $cart_details->fill($item);
        $cart_details->qty = $item['quantity'];
        $cart->push($cart_details);
    }
    // $cart_coupon = array();
    $shipping_address = new Collection();
    $coupon_data = array();
    $shipping_amount = 0;
    $shipping_charge_management = array();


    //$cart = Cart::where('user_id',$user_id)->with(['products','product_images','product_variant'])->get();
    return view('frontend.cart.guest_cart', compact('cart','shipping_address','coupon_data','shipping_amount','shipping_charge_management'));
    //return view('frontend.cart.index', compact('cart','cart_coupon','shipping_address','coupon_data','shipping_amount','shipping_charge_management'));
}//end of function

//remove Item from session
public function removeguestitem($id)
{
    if(session()->has('cart'))
    {
        foreach(session('cart') as $name => $item)
        {
            if($item['product_id'] == $id)
            {
                session()->forget('cart.'.$name);
                return redirect('/guestcart')->with(['message' => 'Product Has Beem Removed']);
            }
        }
    }
}   //End of function Remove


public function updateguestcart(Request $request){
foreach($request['cart_data'] as $index => $value){
    if(isset($value['product_variant_id'])){
        $product_variant_id = $value['product_variant_id'];
    }else{
        $product_variant_id = NULL;
    }
//echo $index;
    //  if('cart'.'_'.$index.'_'.$product_variant_id == session('cart')               ){}
    // session('cart.'.$index.'_')
    foreach(session('cart') as $cartname => $cartdetails ){

        if($cartname == 'cart_'.$index.'_'.$product_variant_id){
           if(session()->get('cart')){
           // echo "Key found";
            $cartdetails['quantity'] = $value['qty'];
            session()->put('cart.'.$cartname,$cartdetails);
           }
        }

    }

}
return redirect('/guestcart')->with(['message' => 'Cart Has been Updated']);
}// END Of Function



}// END of class
