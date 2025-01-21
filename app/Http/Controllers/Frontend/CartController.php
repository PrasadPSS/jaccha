<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\CODManagement;
use App\Models\backend\Company;
use App\Models\backend\Gst;
use App\Models\backend\MissingPaymentProducts;
use App\Models\backend\MissingPayments;
use App\Models\backend\Orders;
use App\Models\backend\OrdersCounter;
use App\Models\backend\OrdersProductDetails;
use App\Models\backend\PaymentInfo;
use App\Models\backend\Products;
use App\Models\backend\ProductVariants;
use App\Models\backend\ShippingChargesManagement;
use App\Models\frontend\Cart;
use App\Models\frontend\CartCoupons;
use App\Models\frontend\InvoiceCounter;
use App\Models\frontend\OrderCoupons;
use App\Models\frontend\ShippingAddresses;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $address = ShippingAddresses::where('user_id', auth()->user()->id)->where('default_address_flag', 1)->exists();
        if (!$address) {
            return redirect('profile/view')->with('error', 'Please Select Shipping Address as default');
        }
        $data['cart'] = Cart::where('user_id', auth()->user()->id)->with('products', 'product_variant')->get();
        $data['cart_amount'] = get_cart_amounts()->cart->cart_mrp_total;

        return Inertia::render('Frontend/Cart/Index', $data);
    }

    public function increaseQuantity(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->first();
        $product = Products::where('product_id', $request->item_id)->first();
        Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->update(['qty' => $cart->qty + 1, 'price' => $product->product_price * ($cart->qty + 1)]);



        return response()->json(['updated_quantity' => 111]);
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->first();

        if (!$cart || $cart->qty <= 1) {
            return response()->json(['error' => 'Quantity cannot be decreased further'], 400);
        }

        $product = Products::where('product_id', $request->item_id)->first();

        Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $request->item_id)
            ->update([
                    'qty' => $cart->qty - 1,
                    'price' => $product->product_price * ($cart->qty - 1),
                ]);

        return response()->json(['updated_quantity' => $cart->qty - 1]);
    }


    public function removeItem(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->item_id)->delete();


        return response()->json(['message' => 'Item removed']);
    }

    public function paymentstatus()
    {


        if (isset(auth()->user()->id)) {
            $user_session = auth()->user();
            $firstname = auth()->user()->name;
            $email = auth()->user()->email;
            $mobile_no = auth()->user()->mobile_no;
        }
        if (isset($_POST['merchantId']) && isset($_POST['transactionId']) && isset($_POST['amount'])) {
            $merchantId = $_POST['merchantId'];
            $transactionId = $_POST['transactionId'];
            $amount = $_POST['amount'];
            $saltKey = "d7fdbcc6-3481-476b-831a-5c786147579e";
            $saltIndex = "1";

            $st = "/pg/v1/status/" . $merchantId . "/" . $transactionId . $saltKey;

            $dataSha256 = hash("sha256", $st);

            $checksum = $dataSha256 . "###" . $saltIndex;

            $headers = array(
                "Content-Type: application/json",
                "accept: application/json",
                "X-VERIFY: " . $checksum,
                "X-MERCHANT-ID:" . $merchantId
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/" . $merchantId . "/" . $transactionId);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $resp = curl_exec($curl);

            curl_close($curl);

            $responsePayment = json_decode($resp, true);

            // echo "<pre>";
            // print_r($responsePayment);
            // echo "</pre>";
            // exit;

            $responsePayment['paymentmode'] = "phonepe";
            $responsePayment['firstname'] = '';
            $responsePayment['email'] = '';

            // echo $tran_id."<br>"; not getting 
            // echo $amount; getting

            // exit;
            
            if ($responsePayment['success'] == true && $responsePayment['code'] == "PAYMENT_SUCCESS") {
                return redirect()->route('phonepepaymentsuccess', ['responsePayment' => $responsePayment]);
            }
            else {
                return redirect()->route('phonepepaymentfailure', ['responsePayment' => $responsePayment]);
            }
        }
    }

    public function phonepepaymentsuccess()
    {
        Cart::where('user_id', auth()->user()->id)->delete();
        $response = $_GET['responsePayment'];
        $amount = $response['data']['amount'];
        $txnid = $response['data']['merchantTransactionId'];
        $order_id = 0;
        // $productinfo = $_POST["productinfo"];
        // $user_session = auth()->user();
        $id = session('missing_payment_id');
        $sumdiscount = 0;
        $payment_tracking_code = substr(md5(microtime()), rand(0, 20), 20);
        $missingpaymments = MissingPayments::where('payment_id', $id)->first();
        if ($missingpaymments) {
            $exitingorder = Orders::where('transaction_id', $missingpaymments->transaction_id)->first();
            if (empty($exitingorder)) {
                $payment_info = new PaymentInfo();
                $payment_info->status = 'processing';
                $payment_info->user_id = $missingpaymments->user_id;
                $payment_info->email = $missingpaymments->email;
                $payment_info->customer_name = $missingpaymments->customer_name;
                $payment_info->transaction_id = $txnid;
                $payment_info->amount = $missingpaymments->amount;
                $payment_info->payment_date = $missingpaymments->payment_date;
                $payment_info->data_dump = json_encode($response);
                $payment_info->payment_tracking_code = $payment_tracking_code;
                // $payment_info->payment_mode = 'payumoney';
                $payment_info->payment_mode = $missingpaymments->payment_mode;

                $payment_info->converted_flag = 1;
                if ($payment_info->save()) {
                    //var_dump($payment_info);exit;
                    $missing_payments = MissingPayments::where('payment_id', $id)->first();
                    $missing_payments->payu_response = 'Y';
                    $missing_payments->data_dump = $payment_info->data_dump;
                    $missing_payments->status = 'success';
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
                    if ($missing_payment_products) {
                        $order = new Orders();
                        $order->user_id = $missingpaymments->user_id;
                        $order->orders_counter_id = 'JACCHA' . $orders_counter_increment_id;
                        $order->payment_tracking_code = $payment_tracking_code;
                        $order->transaction_id = $txnid;
                        // if(!empty($shipping))
                        // {
                        //   $order->shipping_method_code = $shipping->shipping_method_code;
                        //   $order->shipping_method_cost = $shipping->shipping_method_cost;
                        // }
                        $order->data_dump = $payment_info->data_dump;
                        $order->email = $payment_info->email;
                        $order->customer_name = $payment_info->customer_name;
                        $order->payment_mode = $payment_info->payment_mode;

                        if (!$order->invoice_counter_id) {
                            $invoice_counter = InvoiceCounter::first();
                            $invoice_counter_increment_id = $invoice_counter->invoice_counter + 1;
                            $invoice_counter->invoice_counter = $invoice_counter_increment_id;
                            $invoice_counter->save();
                            $order->invoice_counter_id = "GRP" . $invoice_counter_increment_id;
                            
                          }

                        if ($order->save()) {
                            $order_id = $order->order_id;

                            $final_total = 0;
                            $shipping_charges = [];
                            $shipping_amount = 0;
                            $product_wt = 0;
                            $total_mrp = 0;
                            $total_mrp_dicount = 0;

                            foreach ($missing_payment_products as $missing_payment_product) {

                                if ($missing_payment_product->product_variant_id) {
                                    $product = ProductVariants::where('product_variant_id', $missing_payment_product->product_variant_id)->first();
                                } else {
                                    $product = Products::Where('product_id', $missing_payment_product->product_id)->with(['color', 'size'])->first();
                                }
                                $product_variant_gst_id = Products::where('product_id', $product->product_id)->with(['color', 'size'])->first()->gst_id;


                                $gst = Gst::where('gst_id', $product_variant_gst_id)->first();
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

                                if ($gstMode == 'sgst') {
                                    $order_product->gst_cgst_rate = $gst->gst_cgst_percent;
                                    $order_product->gst_sgst_rate = $gst->gst_sgst_percent;
                                    $order_product->gst_cgst_amount = ($product->product_discounted_price * $missing_payment_product->qty * $gst->gst_cgst_percent) / 100;
                                    $order_product->gst_sgst_amount = ($product->product_discounted_price * $missing_payment_product->qty * $gst->gst_sgst_percent) / 100;
                                    $order_product->product_discounted_price = ($product->product_discounted_price * $missing_payment_product->qty) + $order_product->gst_cgst_amount + $order_product->gst_sgst_amount;
                                    $order_product->rev_discount = $product->product_price - $product->product_discounted_price;
                                    $order_product->rev_taxable_amount = $product->product_discounted_price;
                                } else {
                                    $order_product->gst_igst_rate = $gst->gst_igst_percent;
                                    $order_product->gst_igst_amount = ($product->product_discounted_price * $missing_payment_product->qty * $gst->gst_igst_percent) / 100;
                                    $order_product->product_discounted_price = ($product->product_discounted_price * $missing_payment_product->qty) + $order_product->gst_igst_amount;
                                    $order_product->rev_discount = $product->product_price - $product->product_discounted_price;
                                    $order_product->rev_taxable_amount = $product->product_discounted_price;
                                }


                                // $order_product->orders_counter_id = $orders_counter_increment_id;
                                // $order_product->referral_id = $item->referral_id;
                                // $order_product->distributor_id = $item->distributor_id;
                                $order_product->save();


                                $final_total = $final_total + $order_product->product_discounted_price;
                                $total_mrp = $total_mrp + ($product->product_price * $missing_payment_product->qty);
                                // decrement the product QTY
                                $product->product_qty = $product->product_qty - $missing_payment_product->qty;
                                $product->save();

                                //chipping charge calculation
                                $product_wt = $product_wt + $product->product_weight;

                            }

                            $total_mrp_dicount = $total_mrp - $final_total;

                            //                        $shipping_charge = get_shipping_charges('S', $product_wt, '421601', 'Delivered', '421605');
                            $shipping_charge = $missing_payments->shipping_method_cost;
                            //                        $shipping_charges = $shipping_charge[0];
                            // $shipping_amount = $shipping_charge[0]->total_amount;
                            // $shipping_amount = $shipping_amount+$shipping_charge[0]->total_amount;


                            //coupon discount
                            $discount_value = 0;
                            $cart_coupon = CartCoupons::where('user_id', $missingpaymments->user_id)->with('coupon')->first();
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
                            // $discount_value = $final_total * $discount_setting->discount_percent/100;
                            $final_discounted_value = $final_total - $discount_value;
                            $final_discounted_value = $final_discounted_value + $shipping_charge;
                            // $gst_value = $final_discounted_value * $gst->gst_percent/100;
                            // $grand_total = $final_discounted_value + $gst_value;
                            $grand_total = $final_discounted_value;

                            $current_order = Orders::Where("order_id", $order->order_id)->first();
                            $current_order->total = $grand_total - $missing_payments->coupon_discount;
                            if(isset($missing_payments->coupon_discount))
                            {
                                info('discount cart coupon');
                                $current_order->coupon_code = $missing_payments->coupon_code;
                                $current_order->coupon_discount = $missing_payments->coupon_discount;
                                OrderCoupons::create(['user_id'=> $missing_payments->user_id,
                                'coupon_code' => $missing_payments->coupon_code]);
                            }
                            $current_order->shipping_amount = $shipping_charge;
                            $current_order->shipping_dump = $missing_payments->shipping_dump;
                            // $current_order->gst_percent = $gst->gst_percent;
                            // $current_order->discount_percent = $discount_setting->discount_percent;
                            $current_order->gst_value = $grand_total;
                            $current_order->confirmed_stage = 1;
                            $current_order->total_mrp_dicount = $total_mrp_dicount;
                            $current_order->total_mrp = $total_mrp;
                            $shipping_address = ShippingAddresses::where('user_id', $missingpaymments->user_id)->where('shipping_address_id', $missingpaymments['shipping_address_id'])->first();
                            if ($shipping_address) {
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

                            if (isset($cart_coupon->coupon)) {
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


                        return redirect()->route('orders.thankyou', ['order_id' => $order_id]);
                    }

                } 
            }
        }

        return redirect()->route('orders.thankyou', ['order_id' => $order_id]);
    }

    public function phonepepaymentfailure()
    {
        $data['transcation_id'] = MissingPayments::where('user_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today()) // Ensure the date is today
            ->orderBy('created_at', 'desc')           // Order by the most recent
            ->value('transaction_id');

        if ($data['transcation_id'] == null)
        {
            return redirect()->route('/home');
        }
            return Inertia::render('Frontend/Orders/OrderFailed', $data);
    }
}
