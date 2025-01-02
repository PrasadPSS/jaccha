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
use App\Models\frontend\ShippingAddresses;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FaqController extends Controller
{
   public function index()
   {
        return Inertia::render('Frontend/Faq/Index');
   }
}
