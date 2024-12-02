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
        $shipping_amount = isset($shipping_charge[0]['total_amount']) ? $shipping_charge[0]['total_amount'] : 0;
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
        dd(compact(
            'cart',
            'user',
            'increment_id',
            'shipping_address',
            'shipping_charge',
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
        ));
    }

   public function index()
   {
        $data['orders'] = Orders::where('user_id', auth()->user()->id)->with('order_items', 'order_items.product', 'payment_details')->get();

        return Inertia::render('Frontend/Orders/ViewOrder', $data);
   }
}
