<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Orders;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\frontend\Schemes;
use App\Models\frontend\Wishlists;
use App\Models\frontend\ShippingAddresses;
use App\Models\backend\CODManagement;
use PHPMailer\PHPMailer;
use App\Models\backend\Company;
use App\Models\backend\Dailycodlimit;
use App\Models\backend\FakeOrderManagement;
use App\Models\backend\ShippingChargesManagement;
use PDF;
use App\Models\backend\OrderDeliveryManagement;
use App\Models\backend\ProductVariants;
use App\Models\frontend\Newsletters;
use Illuminate\Database\Eloquent\Collection;

use App\Models\frontend\User;
use App\Models\frontend\UsersApplicant;
use App\Models\frontend\Cart;
use App\Models\backend\Products;
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

class OrderController extends Controller
{
   public function checkout()
    {
  
        if (isset(auth()->user()->id)) {
            $user_id = auth()->user()->id;

            $user = auth()->user();
        }
       
        $cart = Cart::where('user_id', $user_id)->with(['products', 'product_images', 'product_variant'])->get();
        
        // dd($cart);
        if (count($cart) <= 0) {
            // dd($cart);
            return back()->with('error', 'Your Cart is empty');
        } 
        $shipping_address = ShippingAddresses::where('user_id', $user_id)->where('default_address_flag', 1)->first();
        // dd($shipping_address);
       
        if (!$shipping_address) {
            // exit;
            $shipping_address = ShippingAddresses::where('user_id', $user_id)->first();
        }
        
        if (!$shipping_address) {
            // return back()->with('error', 'Please add Delivery Address First');
            return redirect()->to('/cart')->with('error', 'Please add Delivery Address First');
        }
        
        // $shipping_address = ShippingAddresses::where('user_id',$user_id)->where('shipping_address_id',$_GET['shipping_address_id'])->first();
        //   $user = auth()->user();
        // $gst = Gst::Where('default_gst',1)->first();
        $payment_mode = PaymentMode::Where('status', 1)->orderby('priority','asc')->get();
        // dd($payment_mode);
        $increment_id = substr(md5(microtime()), rand(0, 20), 20);
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
        // dd($company);
        $shipping_charge = get_shipping_charges('S', $product_wt, $company->pincode, 'Delivered', $shipping_address->shipping_pincode);
        // dd($shipping_charge);
        $shipping_charge = json_decode($shipping_charge, true);
        // dd($shipping_charge);
        // dd($shipping_charge);
        $shipping_charges = isset($shipping_charge[0]) ? $shipping_charge[0] : [];
        $shipping_amount = json_decode(check_pincode($shipping_address->shipping_pincode))->data->available_courier_companies[0]->rate;

        // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;
        // dd($shipping_charge[0]['total_amount']);
        // dd($shipping_amount);
        $cart_coupon = CartCoupons::where('user_id', $user_id)->with('coupon')->first();
        //pincode verification and COD
        $pin_response = json_decode(verify_pincode($shipping_address->shipping_pincode), true);
        // dd($pin_response);
        // echo "<pre>"; print_f($pin_response);exit;
        if (isset($pin_response['delivery_codes']) && count($pin_response['delivery_codes']) > 0) {
            $cod_response = $pin_response['delivery_codes'][0]['postal_code']['cod'];
            $pin_response = false;
        } else {
            $cod_response = 'N';
            $pin_response = true;
        }

        //check cod limit
        $todays_date = date('Y-m-d');
        $orders_data = count(Orders::where(['user_id' => $user_id, 'payment_mode' => 'cod'])->whereRaw('Date(created_at) = CURDATE()')->get());
        // dd($orders_data);
        $fake_orders = FakeOrderManagement::where(['user_id' => $user_id])->get()->toArray();
        // dd($fake_orders);
        $daily_cod_limit = Dailycodlimit::where(['status' => 'active'])->get()->toArray();
        // dd($daily_cod_limit);

        // $orders_data = Orders::where(['user_id' => $user_id, 'payment_mode' => 'cod'])->whereRaw('Date(created_at) = CURDATE()')->get();

        // dd($orders_data);

        $order_date = strtok(!empty($fake_orders[0]['order_date']) ? $fake_orders[0]['order_date'] : '', ' ');
        // dd($order_date);


        // dd($daily_cod_limit);


        //cart amounts
        $cart_amounts = get_cart_amounts();


        $cart_total_with_discount = $cart_amounts->cart->cart_discounted_total - $cart_amounts->coupon_discount;

        $shipping_charge_management = ShippingChargesManagement::first();
        // dd($shipping_charge_management);

        if ($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit) {
            $shipping_amount = 0;
        }
        // dd($daily_cod_limit[0]['count']);
        // dd($orders_data);

        $cod_status = true;
        $cod_rmk = '';
        $cod_message = '';
        $cod_management = CODManagement::first();
        // dd($cod_management);
        if ($cod_management) {
            if (!($cod_management->cod_purchase_min_limit <= $cart_total_with_discount && $cod_management->cod_purchase_max_limit >= $cart_total_with_discount)) {
                $cod_message = 'Cash on Delivery facility is available on min. net order amount of ₹ ' . $cod_management->cod_purchase_min_limit . ' and max. ₹ ' . $cod_management->cod_purchase_max_limit . ' ';
            } else if (!empty($fake_orders) && $fake_orders[0]['status'] != 'active') {
                $cod_message = 'Cash on Delivery facility is restricted for now';
            } else if (!empty($daily_cod_limit) && ($daily_cod_limit[0]['count'] <= $orders_data)) {
                $cod_message = 'Cash on Delivery Limit Reached!';
            }
        }



        // dd($payment_mode);


        // && ($todays_date == $order_date) && ($fake_orders[0]['count'] > $orders_data) && ($fake_orders[0]['status'] == 'active')

        if ($cod_response == 'Y') {

            if (!($cod_management->cod_purchase_min_limit <= $cart_total_with_discount && $cod_management->cod_purchase_max_limit >= $cart_total_with_discount)) {
                $cod_message = 'Cash on Delivery facility is available on min. net order amount of ₹ ' . $cod_management->cod_purchase_min_limit . ' and max. ₹ ' . $cod_management->cod_purchase_max_limit . ' ';
            } else if (!empty($fake_orders) && $fake_orders[0]['status'] != 'active') {
                $cod_message = 'Cash on Delivery facility is restricted for now';
            } else if (!empty($daily_cod_limit) && ($daily_cod_limit[0]['count'] <= $orders_data)) {
                $cod_message = 'Cash on Delivery Limit Reached!';
            } else {
                $cod_status = false;
                $cod_rmk = 'COD available';
            }

            // if(!(!empty($daily_cod_limit) && ($daily_cod_limit[0]['count'] <= $orders_data))){
            //   $cod_status = false;
            //   $cod_rmk = 'COD available';
            // }
            // if(!empty($fake_orders) && $fake_orders[0]['status'] == 'active'){

            //     $cod_status = false;
            //     $cod_rmk = 'COD available';
            //   }

            //   if ($cod_management->cod_purchase_min_limit <= $cart_total_with_discount && $cod_management->cod_purchase_max_limit >= $cart_total_with_discount ) {
            //     $cod_status = false;
            //     $cod_rmk = 'COD available';
            //   } else {
            //     $cod_status = true;
            //     $cod_rmk = 'Cash on Delivery facility is available on min. net order amount of ₹ ' . $cod_management->cod_purchase_min_limit . ' and max. ₹ ' . $cod_management->cod_purchase_max_limit . ' ';
            //   }


        } else {
            $cod_status = true;
            $cod_rmk = 'COD not available';
        }
        $order_delivery = OrderDeliveryManagement::first();

        return Inertia::render('Frontend/Orders/OrderCheckout', ['data'=>compact(
            'cart',
            'user',
            'increment_id',
            'shipping_address',
            'shipping_charge',
            'shipping_charges',
            'shipping_amount',
            'cart_coupon',
            'payment_mode',
            'cod_response',
            'cart_amounts',
            'cod_status',
            'cod_rmk',
            'pin_response',
            'order_delivery',
            'cod_message'
        )]);

        // dd(compact(
        //     'cart',
        //     'user',
        //     'increment_id',
        //     'shipping_address',
        //     'shipping_charge',
        //     'shipping_amount',
        //     'cart_coupon',
        //     'payment_mode',
        //     'cod_response',
        //     'cart_amounts',
        //     'cod_status',
        //     'cod_rmk',
        //     'pin_response',
        //     'order_delivery',
        //     'cod_message'
        // ));

        // $post_data = $request ?? NULL;
        // $post_data['txn_id'] = $increment_id;
        // $user_session = auth()->user();
        // $user_id = auth()->user()->id;
        // if ($user_session) {
        //     $user_details = $user_session;
        //     $shipping_address = ShippingAddresses::where('user_id', $user_id)->where('shipping_address_id',$shipping_address->shipping_address_id)->first();
        //     $mobile_no = $shipping_address->shipping_mobile_no;
        //     $address = $shipping_address->shipping_address_line1;
        //     $district = $shipping_address->shipping_district;
        //     $state = $shipping_address->shipping_state;
        //     $city = $shipping_address->shipping_city;
        //     $pincode = $shipping_address->shipping_pincode;
        //     // if (empty($shipping_address))
        //     // {
        //     //   $shipping_address = ShippingAddresses::where('user_id',$user_id)->first();
        //     // }
        //     $messages = array();

        //     if ($mobile_no == '' || $pincode == '' || empty($shipping_address)) {
        //         // dd($shipping_address);
        //         $messages['0'] = "Please complete your profile before proceeding to payment !";
        //     }

        //     if (count($messages) > 0) {
        //         return back()->withErrors([
        //             'message' => $messages
        //         ]);
        //     }
        // }

        // //var_dump($post_data);exit;
        // $transaction_id = "";
        // $payment_mode = 'cod';

        // // dd($payment_mode);
        // $surl = url('cart/paymentsuccess');
        // $furl = url('cart/paymentfailure');
        // $purl = url('cart/paymentstatus');
        // $transaction_id = $post_data['txn_id'];
        // $final_total = 0;
        // $cart = Cart::where('user_id', $user_session->id)->with(['products', 'product_images'])->get();
        // // $gst = Gst::Where('default_gst',1)->first();
        // // $discount_setting = DiscountSetting::first();
        // // $shipping=Shipping::where('shipping_method_status',1)->first();
        // // $existing_wallet = Wallet::where('user_id',$user_session->id)->Where('account_type',$account_type)->first();



        // //shipping charges
        // // $shipping_charges = get_shipping_charges('S',500,'421601','Delivered','421605');
        // // $shipping_charges = json_decode($shipping_charges);
        // // $shipping_charge = $shipping_charges[0];

        // $shipping_charges = [];
        // $shipping_amount = 0;
        // $product_wt = 0;
        // foreach ($cart as $item) {
        //     $join_table = 'products';
        //     if ($item->product_type == "configurable") {
        //         $join_table = 'product_variant';
        //     }
        //     $final_total = $final_total + (isset($item->{$join_table}->product_discounted_price) ? $item->{$join_table}->product_discounted_price * $item->qty : 0);

        //     //chipping charge calculation
        //     $product_wt = $product_wt + (isset($item->{$join_table}->product_weight) ? ($item->{$join_table}->product_weight * $item->qty) : 0);
        // }

        // $company = Company::first();
        // $shipping_charge = get_shipping_charges('S', $product_wt, $company->pincode, 'Delivered', $pincode);
        // $shipping_charge = json_decode($shipping_charge, true);
        // $shipping_charges = isset($shipping_charge[0]) ? $shipping_charge[0] : [];
        // // $shipping_amount = $shipping_charge[0]->total_amount;
        // $shipping_amount = isset($shipping_charge[0]['total_amount']) ? $shipping_charge[0]['total_amount'] : 0;
        // // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;
        // //coupon discount
        // $cart_coupon = CartCoupons::where('user_id', $user_id)->with('coupon')->first();
        // if (isset($cart_coupon->coupon)) {
        //     $paymentDate = date('Y-m-d');
        //     $paymentDate = date('Y-m-d', strtotime($paymentDate));
        //     $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
        //     $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

        //     if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
        //         if ($cart_coupon->coupon->coupon_type == 'flat') {
        //             $coupon_value = $cart_coupon->coupon->value;
        //             $discount_value = $coupon_value;
        //         } else {
        //             $coupon_value = $cart_coupon->coupon->value;
        //             $discount_value = ($final_total * $coupon_value) / 100;
        //         }
        //     } else {
        //         $discount_value = 0;
        //     }
        // } else {
        //     $discount_value = 0;
        // }
        // //cart amounts
        // $cart_amounts = get_cart_amounts();
        // $cart_total_with_discount = $cart_amounts->cart->cart_discounted_total - $cart_amounts->coupon_discount;

        // $shipping_charge_management = ShippingChargesManagement::first();
        // if ($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit) {
        //     $shipping_amount = 0;
        // }
        // // $discount_value = $final_total * $discount_setting->discount_percent/100;
        // $final_discounted_value = $final_total - $discount_value;
        // // $gst_value = $final_discounted_value * $gst->gst_percent/100;
        // // $grand_total = $final_discounted_value + $gst_value;
        // $grand_total = $final_discounted_value;
        // if (!empty($shipping_charge) && $shipping_amount > 0) {
        //     $grand_total = $grand_total + $shipping_amount;
        // }
        // $grand_total = round($grand_total);

        // $post_data['amount'] = $grand_total;

        // $this->addMissingPayment($post_data, $transaction_id, $shipping_amount, $shipping_charges, $shipping_address);
        // Cart::where('user_id', auth()->user()->id)->delete();
        // return redirect()->back();
    }

    public function placeOrder(Request $request)
    {
        
        $post_data = $request->all();
        $user_session = auth()->user();
        $user_id = auth()->user()->id;
        if ($user_session) {
            $user_details = $user_session;
            $shipping_address = ShippingAddresses::where('user_id', $user_id)->where('shipping_address_id', $post_data['shipping_id'])->first();
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

            if ($mobile_no == '' || $pincode == '' || empty($shipping_address)) {
                // dd($shipping_address);
                $messages['0'] = "Please complete your profile before proceeding to payment !";
            }

            if (count($messages) > 0) {
                return back()->withErrors([
                    'message' => $messages
                ]);
            }
        }

        //var_dump($post_data);exit;
        $transaction_id = "";
        $payment_mode = $post_data['paymentmode'] == 'Cash On Delivery' ? 'cod' : 'phonepe';

        // dd($payment_mode);
        $surl = url('cart/paymentsuccess');
        $furl = url('cart/paymentfailure');
        $purl = url('cart/paymentstatus');
        $transaction_id = $post_data['txnid'];
        $final_total = 0;
        $cart = Cart::where('user_id', $user_session->id)->with(['products', 'product_images'])->get();
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
        foreach ($cart as $item) {
            $join_table = 'products';
            if ($item->product_type == "configurable") {
                $join_table = 'product_variant';
            }
            $final_total = $final_total + (isset($item->{$join_table}->product_discounted_price) ? $item->{$join_table}->product_discounted_price * $item->qty : 0);

            //chipping charge calculation
            $product_wt = $product_wt + (isset($item->{$join_table}->product_weight) ? ($item->{$join_table}->product_weight * $item->qty) : 0);
        }

        $company = Company::first();
        $shipping_charge = get_shipping_charges('S', $product_wt, $company->pincode, 'Delivered', $pincode);
        $shipping_charge = json_decode($shipping_charge, true);
        $shipping_charges = isset($shipping_charge[0]) ? $shipping_charge[0] : [];
        // $shipping_amount = $shipping_charge[0]->total_amount;
        $shipping_amount = json_decode(check_pincode($shipping_address->shipping_pincode))->data->available_courier_companies[0]->rate;
        // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;
        //coupon discount
        $cart_coupon = CartCoupons::where('user_id', $user_id)->with('coupon')->first();
        if (isset($cart_coupon->coupon)) {
            $paymentDate = date('Y-m-d');
            $paymentDate = date('Y-m-d', strtotime($paymentDate));
            $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
            $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
                if ($cart_coupon->coupon->coupon_type == 'flat') {
                    $coupon_value = $cart_coupon->coupon->value;
                    $discount_value = $coupon_value;
                } else {
                    $coupon_value = $cart_coupon->coupon->value;
                    $discount_value = ($final_total * $coupon_value) / 100;
                }
            } else {
                $discount_value = 0;
            }
        } else {
            $discount_value = 0;
        }
        //cart amounts
        $cart_amounts = get_cart_amounts();
        $cart_total_with_discount = $cart_amounts->cart->cart_discounted_total - $cart_amounts->coupon_discount;

        $shipping_charge_management = ShippingChargesManagement::first();
        if ($cart_total_with_discount >= $shipping_charge_management->purchase_min_limit) {
            $shipping_amount = 0;
        }
        // $discount_value = $final_total * $discount_setting->discount_percent/100;
        $final_discounted_value = $final_total - $discount_value;
        // $gst_value = $final_discounted_value * $gst->gst_percent/100;
        // $grand_total = $final_discounted_value + $gst_value;
        $grand_total = $final_discounted_value;
        if (!empty($shipping_charge) && $shipping_amount > 0) {
            $grand_total = $grand_total + $shipping_amount;
        }
        $grand_total = round($grand_total);

        $post_data['grand_amount'] = $grand_total;
        // exit;
        $missing_payment_id = $this->addMissingPayment($post_data, $transaction_id, $shipping_amount, $shipping_charges, $shipping_address);
        session(['missing_payment_id' => $missing_payment_id]);
        
        if($payment_mode == 'phonepe'){

            $merchantid  = "M22J3FQGSVWJPUAT";
            $saltkey = "d7fdbcc6-3481-476b-831a-5c786147579e";
            $saltindex = "1";
            if(empty($post_data['txnid'])) {
                // Generate random transaction id
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
              } else {
                $txnid = $post_data['txnid'];
              }
            $payLoad = array(
                'merchantId' => $merchantid,
                'merchantTransactionId' => $txnid, // test transactionID
                "merchantUserId" => $user_id,
                'amount' => $post_data['amount'] * 100, // phone pe works on paise
                // 'amount' => 100,
                'redirectUrl' => $purl,
                'redirectMode' => "POST",
                'callbackUrl' => $purl,
                "mobileNumber" => auth()->user()->mobile_no,
                "paymentInstrument" => array(
                    "type" => "PAY_PAGE",
                )
            );
            $jsonencode = json_encode($payLoad);
            $payloadbase64 = base64_encode($jsonencode);
            $payloaddata = $payloadbase64 . "/pg/v1/pay" . $saltkey;
            $sha256 = hash("sha256", $payloaddata);
            $checksum = $sha256 . '###' . $saltindex;
            $request = json_encode(array('request' => $payloadbase64));

            $curl = curl_init(); // This extention should be installed

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "X-VERIFY: " . $checksum,
                    "accept: application/json"
                ],
            ]);
        
            $response = curl_exec($curl);
        
            $err = curl_error($curl);
            curl_close($curl);
        
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $res = json_decode($response);
            
              echo "<br/>response===";
              print_r($res);
            
              if (isset($res->success) && $res->success == '1') {
                // $paymentCode=$res->code;
                // $paymentMsg=$res->message;
                $payUrl = $res->data->instrumentResponse->redirectInfo->url;
                
                return redirect($payUrl);
              }
        }
        }
        if($post_data['paymentmode'] == 'Cash On Delivery')
        {
            $this->convert($missing_payment_id);
        }
        return Inertia::render('Frontend/Orders/ThankYou');
    }

    public function convert($id)
    {
        $sumdiscount=0;
        $payment_tracking_code = substr(md5(microtime()), rand(0, 20), 20);
        $missingpaymments = MissingPayments::where('payment_id', $id)->first();
        if ($missingpaymments)
        {
          $exitingorder = Orders::where('transaction_id', $missingpaymments->transaction_id)->first();
          if (empty($exitingorder))
          {
            $payment_info = new PaymentInfo();
            $payment_info->status = 'processing';
            $payment_info->user_id = $missingpaymments->user_id;
            $payment_info->email = $missingpaymments->email;
            $payment_info->customer_name = $missingpaymments->customer_name;
            $payment_info->transaction_id = $missingpaymments->transaction_id;
            $payment_info->amount = $missingpaymments->amount;
            $payment_info->payment_date = $missingpaymments->payment_date;
            $payment_info->data_dump = $missingpaymments->data_dump;
            $payment_info->payment_tracking_code = $payment_tracking_code;
            // $payment_info->payment_mode = 'payumoney';
            $payment_info->payment_mode = $missingpaymments->payment_mode;

            $payment_info->converted_flag=1;
            if ($payment_info->save()) {
                //var_dump($payment_info);exit;
                $missing_payments = MissingPayments::where('payment_id', $id)->first();
                $missing_payments->payu_response = 'Y';
                $missing_payments->data_dump = $payment_info->data_dump;
                $missing_payments->status='success';
                // $missing_payments->shipping_method_code = $shipping->shipping_method_code;
                // $missing_payments->shipping_method_cost = $shipping->shipping_method_cost;
                $missing_payments->save();
                //Yii::$app->runAction('subscription/add',['payment_tracking_code'=>$payment_tracking_code]);


                // $cart_remove=Cart::find()->where(['user_id'=>$payment_info->user_id] OR ['guest_unique_id'=>$payment_info->guest_unique_id])->one();

               
                
                $gstMode = 'sgst';
                $userState = ShippingAddresses::where('user_id', $missingpaymments->user_id)->where('default_address_flag', 1)->first();
                if (get_pickup_address()->state !== $userState->shipping_state) {
                    $gstMode = 'igst';
                }
                // $discount_setting = DiscountSetting::first();

                $missing_payment_products = MissingPaymentProducts::where('payment_id', $id)->get();
                $orders_counter = OrdersCounter::first();
                $orders_counter_increment_id = $orders_counter->orders_counter + 1;
                $orders_counter->orders_counter = $orders_counter_increment_id;
                $orders_counter->save();
                //$order_total = Cart::where('user_id',$user_id)->select(\DB::raw('sum(price*qty) AS total_sales'))->first();
                if ($missing_payment_products)
                {
                    $order = new Orders();
                    $order->user_id = $missingpaymments->user_id;
                    $order->orders_counter_id = 'JACCHA'. $orders_counter_increment_id;
                    $order->payment_tracking_code = $payment_tracking_code;
                    $order->transaction_id = $missingpaymments->transaction_id;
                    // if(!empty($shipping))
                    // {
                    //   $order->shipping_method_code = $shipping->shipping_method_code;
                    //   $order->shipping_method_cost = $shipping->shipping_method_cost;
                    // }
                    $order->data_dump = $payment_info->data_dump;
                    $order->email = $payment_info->email;
                    $order->customer_name = $payment_info->customer_name;
                    $order->payment_mode = $payment_info->payment_mode;

                    if ($order->save())
                    {
                        $final_total = 0;
                        $shipping_charges = [];
                        $shipping_amount = 0;
                        $product_wt = 0;
                        $total_mrp = 0;
                        $total_mrp_dicount = 0;
                
                        foreach ($missing_payment_products as $missing_payment_product)
                        {
                            
                            $product = Products::Where('product_id', $missing_payment_product->product_id)->with(['color', 'size'])->first();
                            $gst = Gst::where('gst_id', $product->gst_id)->first();
                            $order_product = new OrdersProductDetails();
                            $order_product->product_id = $missing_payment_product->product_id;
                            $order_product->qty = $missing_payment_product->qty;
                            $order_product->product_title = $product->product_title;
                            $order_product->product_sub_title = $product->product_sub_title;
                            $order_product->product_price = $product->product_price;
                            
                            $order_product->product_discount = $product->product_discount;
                            $order_product->product_discount_type = $product->product_discount_type;
                            $order_product->product_color = (isset($product->color)) ? $product->color->color_name : $product->color_id;
                            $order_product->product_size = (isset($product->size)) ? $product->size->size_name : $product->size_id;
                            $order_product->order_id = $order->order_id;

                            if($gstMode == 'sgst')
                            {
                              $order_product->gst_cgst_rate = $gst->gst_cgst_percent;
                              $order_product->gst_sgst_rate = $gst->gst_sgst_percent;
                              $order_product->gst_cgst_amount = ($product->product_discounted_price*$missing_payment_product->qty*$gst->gst_cgst_percent)/100;
                              $order_product->gst_sgst_amount = ($product->product_discounted_price*$missing_payment_product->qty*$gst->gst_sgst_percent)/100;
                              $order_product->product_discounted_price = ($product->product_discounted_price*$missing_payment_product->qty) + $order_product->gst_cgst_amount + $order_product->gst_sgst_amount;
                              $order_product->rev_discount = $product->product_price -$product->product_discounted_price;
                              $order_product->rev_taxable_amount = $product->product_discounted_price;
                            }
                            else
                            {
                              $order_product->gst_igst_rate = $gst->gst_igst_percent;
                              $order_product->gst_igst_amount = ($product->product_discounted_price * $missing_payment_product->qty * $gst->gst_igst_percent) / 100;
                              $order_product->product_discounted_price = ($product->product_discounted_price * $missing_payment_product->qty) + $order_product->gst_igst_amount;
                              $order_product->rev_discount = $product->product_price -$product->product_discounted_price;
                              $order_product->rev_taxable_amount = $product->product_discounted_price;
                            }
                            

                            // $order_product->orders_counter_id = $orders_counter_increment_id;
                            // $order_product->referral_id = $item->referral_id;
                            // $order_product->distributor_id = $item->distributor_id;
                            $order_product->save();


                            $final_total = $final_total + $order_product->product_discounted_price  ;
                            $total_mrp = $total_mrp + ($product->product_price*$missing_payment_product->qty);
                            // decrement the product QTY
                            $product->product_qty = $product->product_qty - $missing_payment_product->qty;
                            $product->save();

                            //chipping charge calculation
                            $product_wt = $product_wt + $product->product_weight;

                        }

                        $total_mrp_dicount = $total_mrp-$final_total;

//                        $shipping_charge = get_shipping_charges('S', $product_wt, '421601', 'Delivered', '421605');
                        $shipping_charge = $missing_payments->shipping_method_cost;
//                        $shipping_charges = $shipping_charge[0];
                        // $shipping_amount = $shipping_charge[0]->total_amount;
                        // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;


                        //coupon discount
                        $discount_value = 0;
                        $cart_coupon = CartCoupons::where('user_id', $missingpaymments->user_id)->with('coupon')->first();
                        if (isset($cart_coupon->coupon))
                        {
                            $paymentDate = date('Y-m-d');
                            $paymentDate = date('Y-m-d', strtotime($paymentDate));
                            $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
                            $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

                            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
                            {
                                if ($cart_coupon->coupon->coupon_type == 'flat')
                                {
                                    $coupon_value = $cart_coupon->coupon->value;
                                    $discount_value = $coupon_value;
                                }
                                else
                                {
                                    $coupon_value = $cart_coupon->coupon->value;
                                    $discount_value = ($final_total * $coupon_value) / 100;
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
                        $final_discounted_value = $final_discounted_value + $shipping_charge;
                        // $gst_value = $final_discounted_value * $gst->gst_percent/100;
                        // $grand_total = $final_discounted_value + $gst_value;
                        $grand_total = $final_discounted_value;

                        $current_order = Orders::Where("order_id", $order->order_id)->first();
                        $current_order->total = $grand_total;
                        $current_order->shipping_amount = $shipping_charge;
                        $current_order->shipping_dump = $missing_payments->shipping_dump;
                        // $current_order->gst_percent = $gst->gst_percent;
                        // $current_order->discount_percent = $discount_setting->discount_percent;
                        $current_order->gst_value = $grand_total;
                        $current_order->confirmed_stage = 1;
                        $current_order->total_mrp_dicount = $total_mrp_dicount;
                        $current_order->total_mrp = $total_mrp;
                        $shipping_address = ShippingAddresses::where('user_id',$missingpaymments->user_id)->where('shipping_address_id',$missingpaymments['shipping_address_id'])->first();
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

                        if (isset($cart_coupon->coupon))
                        {
                            $current_order->coupon_type = $cart_coupon->coupon->coupon_type;
                            $current_order->coupon_value = $cart_coupon->coupon->value;
                            $current_order->coupon_discount = $discount_value;
                            $current_order->coupon_code = $cart_coupon->coupon->coupon_code;
                            $current_order->cart_coupon_id = $cart_coupon->cart_coupon_id;
                        }


                        $current_order->save();

                        $invoicemodel = $current_order;
                        // $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
                        // $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);


                    }
                    if (isset($cart_coupon)) {
                        $cart_coupon->delete();
                    }
                    // Cart::where('user_id', $missing_payments->user_id)->delete();
                    // $this->SendInvoice($invoicemodel,$payment_info->email,$payment_info->payment_date,$payment_info->payment_mode);
                    // $this->Sendneworder($invoicemodel,$payment_info->payment_mode,$payment_info->customer_name);
                

                  return redirect()->route('admin.missingpayments')->with('success', 'MissedPayments Converted to Success!!!');
                }

            } else {
                return redirect()->route('admin.missingpayments')->withErrors('Something Went Wrong!!! Please try again');

            }
          }
          else
          {
            return redirect()->route('admin.missingpayments')->withErrors('Order Already Present with same Transaction ID');
          }
        }

        return redirect()->route('admin.missingpayments')->with('success', 'MissedPayments Converted to Success!!!');
    }

    public function addMissingPayment($post_data, $transaction_id, $shipping_amount, $shipping_charges, $shipping_address)
    {
        // add missing payments data
        // $shipping=Shipping::where('shipping_method_status',1)->first();
        if (isset(auth()->user()->id)) {
            $user_id = auth()->user()->id;
            $user_session = auth()->user();
        }
        $cart_items = Cart::where('user_id', $user_id)->with(['products', 'product_variant'])->get();
        $cart_coupon = CartCoupons::where('user_id', $user_id)->with('coupon')->first();
        if (isset($cart_coupon->coupon)) {
            $paymentDate = date('Y-m-d');
            $paymentDate = date('Y-m-d', strtotime($paymentDate));
            $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
            $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
                if ($cart_coupon->coupon->coupon_type == 'flat') {
                    $coupon_value = $cart_coupon->coupon->value;
                    $discount_value = $coupon_value;
                } else {
                    $coupon_value = $cart_coupon->coupon->value;
                    $final_total = get_cart_mrp_total();
                    $discount_value = ($final_total->cart_total * $coupon_value) / 100;
                }
            } else {
                $discount_value = 0;
            }
        } else {
            $discount_value = 0;
        }

        $payment_info = new MissingPayments();
        $payment_info->status = 'initiated';
        if ($user_session):
            $user_details = User::where('id', $user_session->id)->first();
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
        if (isset(auth()->user()->id)) {
            $payment_info->email = auth()->user()->email;
            $payment_info->customer_name = auth()->user()->name;
        } else {
            $payment_info->email = $post_data['email'];
            $payment_info->customer_name = $post_data['firstname'];
        }
        $payment_code = $post_data['paymentmode'] == 'Cash On Delivery' ? 'cod' : 'Online';
        $payment_info->transaction_id = $transaction_id;
        $payment_info->amount = $post_data['amount'];
        $payment_info->payment_date = date('Y-m-d H:i:s');
        $payment_info->data_dump = json_encode($post_data);
        $payment_info->shipping_amount = $shipping_amount;
        $payment_info->shipping_dump = json_encode($shipping_charges);
        $payment_info->payment_mode = $payment_code;
        // $payment_info->shipping_address_id = $post_data['shipping_id'];
        if (isset($cart_coupon->coupon)) {
            $payment_info->cart_coupon_id = $cart_coupon->cart_coupon_id;
            $payment_info->coupon_id = $cart_coupon->coupon_id;
            $payment_info->coupon_code = $cart_coupon->coupon_code;
            $payment_info->coupon_type = $cart_coupon->coupon->coupon_type;
            $payment_info->coupon_value = $cart_coupon->coupon->value;
            $payment_info->coupon_discount = $discount_value;
        }

        $shipping_address = ShippingAddresses::where('user_id', $user_id)->where('shipping_address_id', $shipping_address->shipping_address_id)->first();
        if ($shipping_address) {
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
        foreach ($cart_items as $cart) {
            $join_table = 'products';
            if ($cart->product_type == "configurable") {
                $join_table = 'product_variant';
            }
            $missing_payment_product = new MissingPaymentProducts();
            //var_dump($missing_payment_product);exit;
            $missing_payment_product->product_id = $cart->product_id;
            $missing_payment_product->product_variant_id = $cart->product_variant_id;
            $missing_payment_product->product_type = $cart->product_type;
            $missing_payment_product->qty = $cart->qty;
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
            $missing_payment_product->product_title = isset($cart->{$join_table}->product_title) ? $cart->{$join_table}->product_title : '';
            $missing_payment_product->product_sub_title = isset($cart->products->brands) ? $cart->products->brands->brand_name : '';
            $missing_payment_product->product_price = isset($cart->{$join_table}->product_price) ? $cart->{$join_table}->product_price : '';
            $missing_payment_product->product_discounted_price = isset($cart->{$join_table}->product_discounted_price) ? $cart->{$join_table}->product_discounted_price : '';
            $missing_payment_product->product_discount = isset($cart->{$join_table}->product_discount) ? $cart->{$join_table}->product_discount : '';
            $missing_payment_product->product_discount_type = isset($cart->{$join_table}->product_discount_type) ? $cart->{$join_table}->product_discount_type : '';
            $missing_payment_product->product_color = isset($cart->{$join_table}->color)
                ? $cart->{$join_table}->color->color_name
                : (isset($cart->{$join_table}->color_id) ? $cart->{$join_table}->color_id : '');
            $missing_payment_product->product_size = (isset($cart->{$join_table}->size)) ? $cart->{$join_table}->size->size_name : (isset($cart->{$join_table}->size_id) ? $cart->{$join_table}->size_id : '');
            $missing_payment_product->product_weight = isset($cart->{$join_table}->product_weight) ? $cart->{$join_table}->product_weight : '';
            $missing_payment_product->product_sku = isset($cart->{$join_table}->product_sku) ? $cart->{$join_table}->product_sku : '';
            $missing_payment_product->product_hsn = (isset($cart->products->hsncode)) ? $cart->products->hsncode->hsncode_name : '';

            //}
            $missing_payment_product->discount = $cart->discount;
            $missing_payment_product->currency = $cart->currency;
            //    if (empty($pickup_check)) {
            // $missing_payment_product->shipping_method_code=$shipping->shipping_method_code;
            //    $missing_payment_product->shipping_method_cost=$shipping->shipping_method_cost;
            //      }
            //$missing_payment_product->shipping_method_code=$shipping->shipping_method_code;
            //$missing_payment_product->shipping_method_cost=$shipping->shipping_method_cost;
            //var_dump($missing_payment_product->payment_id);exit;
            $missing_payment_product->payment_id = $payment_info->payment_id;
            // $orders_product->orders_counter_id=$ordercounter->orders_counter;
            //var_dump($orders_product);exit;
            $product_discount_amount = isset($cart->{$join_table}->product_discounted_price) ? ($cart->{$join_table}->product_discounted_amount * $cart->qty) : 0;
            $missing_payment_product->product_discounted_amount = $product_discount_amount;
            $net_amount = isset($cart->{$join_table}->product_discounted_price) ? ($cart->{$join_table}->product_discounted_price * $cart->qty) : 0;
            $missing_payment_product->net_amount = $net_amount;

            $missing_payment_product->save();
            $payment_info->total_mrp = $total_mrp;
            $total_mrp = isset($cart->{$join_table}->product_price) ? $total_mrp + ($cart->{$join_table}->product_price * $cart->qty) : 0;
            $product_wt = isset($cart->{$join_table}->product_weight) ? $product_wt + ($cart->{$join_table}->product_weight * $cart->qty) : 0;
        }

        $total_mrp_dicount = $total_mrp - $post_data['amount'];
        $payment_info->total_mrp_dicount = $total_mrp_dicount;
        $payment_info->total_mrp = $total_mrp;
        $payment_info->package_weight = ($product_wt != 0) ? $product_wt : 0;
        $payment_info->save();
        return $payment_info->payment_id;
    }
    

   public function index()
   {
        $data['orders'] = \App\Models\frontend\Orders::where('user_id', auth()->user()->id)->with('orderproducts')->get();

        return Inertia::render('Frontend/Orders/ViewOrder', $data);
   }

   public function viewInvoice($id)
   {
     $data['orders'] = \App\Models\frontend\Orders::where('order_id', $id)->with(['orderproducts'])->first();
     $data['shipping_address'] = ShippingAddresses::where('user_id', $data['orders']->user_id)->where('default_address_flag', 1)->first();
     if (!$data['shipping_address']) {
        $data['shipping_address'] = ShippingAddresses::where('user_id', $data['orders']->user_id)->first();
     }
     $data['company'] = Company::first();
     return view('frontend.orders.viewinvoice', $data);
   }
}
