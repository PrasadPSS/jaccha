<?php

namespace App\Http\Controllers\frontend;

use App\Models\backend\ProductImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\frontend\User;
use App\Models\frontend\Cart;
use App\Models\backend\Products;
use App\Models\frontend\Orders;
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\Gst;
use App\Models\frontend\DiscountSetting;
use Illuminate\Support\Facades\DB;
use App\Models\frontend\PaymentMode;
use App\Models\frontend\Shipping;
use App\Models\frontend\PaymentInfo;
use App\Models\frontend\MissingPayments;
use App\Models\frontend\MissingPaymentProducts;
use App\Models\frontend\CartCoupons;
use App\Models\frontend\Wishlists;
use App\Models\backend\Coupons;
use Session;
require 'mailer/PHPMailerAutoload.php';
use App\Models\frontend\Schemes;

class CouponsController extends Controller
{
    public function __construct()
    {
    //   $this->middleware('auth');
    }

    public function index()
    {
    //   if(!auth()->user())
    //   {
    //     // dd('test');
    //     return back()->withErrors([
    //       'message' => 'Please login to view Coupons !'
    //     ]);

    //   }
    //   if(isset(auth()->user()->id))
    //   {
    //     $user_id = auth()->user()->id;
    //   }
      $coupons = Coupons::get();

      return view('frontend.coupons.index', compact('coupons'));

    }




}
