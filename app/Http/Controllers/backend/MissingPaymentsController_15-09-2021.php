<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Company;
use App\Models\backend\MissingPaymentProducts;
use App\Models\backend\MissingPayments;
use App\Models\backend\Products;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Cart;
use App\Models\frontend\CartCoupons;
use App\Models\frontend\Gst;
use App\Models\frontend\Orders;
use App\Models\frontend\OrdersCounter;
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\PaymentInfo;
use App\Models\frontend\ShippingAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MissingPaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
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

        $missingpayments=MissingPayments::whereIn('status',['initiated','Failure'])->orderBy('payment_id','DESC')->get();
//       $missingpayments = MissingPayments::whereIn('status',['initiated','failure'])->get();
        return view('backend.missingpayments.index', compact('missingpayments'));
    }

    public function convert($id)
    {
        $sumdiscount=0;
        $payment_tracking_code = substr(md5(microtime()), rand(0, 20), 20);
        $missingpaymments = MissingPayments::where('payment_id', $id)->first();
        if ($missingpaymments)
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
            $payment_info->payment_mode = 'payumoney';
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

                $gst = Gst::Where('default_gst', 1)->first();
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
                    $order->orders_counter_id = $orders_counter_increment_id;
                    $order->payment_tracking_code = $payment_tracking_code;
                    $order->transaction_id = $missingpaymments->transaction_id;
                    // if(!empty($shipping))
                    // {
                    //   $order->shipping_method_code = $shipping->shipping_method_code;
                    //   $order->shipping_method_cost = $shipping->shipping_method_cost;
                    // }
                    $order->data_dump = $payment_info->data_dump;

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
                            $order_product = new OrdersProductDetails();
                            $order_product->product_id = $missing_payment_product->product_id;
                            $order_product->qty = $missing_payment_product->qty;
                            $order_product->product_title = $product->product_title;
                            $order_product->product_sub_title = $product->product_sub_title;
                            $order_product->product_price = $product->product_price;
                            $order_product->product_discounted_price = $product->product_discounted_price;
                            $order_product->product_discount = $product->product_discount;
                            $order_product->product_discount_type = $product->product_discount_type;
                            $order_product->product_color = (isset($product->color)) ? $product->color->color_name : $product->color_id;
                            $order_product->product_size = (isset($product->size)) ? $product->size->size_name : $product->size_id;
                            $order_product->order_id = $order->order_id;

                            // $order_product->orders_counter_id = $orders_counter_increment_id;
                            // $order_product->referral_id = $item->referral_id;
                            // $order_product->distributor_id = $item->distributor_id;
                            $order_product->save();


                            $final_total = $final_total + ($product->product_discounted_price * $missing_payment_product->qty);
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

        return redirect()->route('admin.missingpayments')->with('success', 'MissedPayments Converted to Success!!!');
    }
}
