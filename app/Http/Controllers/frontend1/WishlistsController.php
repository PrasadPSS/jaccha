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

class WishlistsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      if(!auth()->user())
      {
        // dd('test');
        return back()->withErrors([
          'message' => 'Please login to view Wishlists !'
        ]);

      }
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
      }
        $wishlistImage=[];
      //$wishlists = Wishlists::where('user_id',$user_id)->with(['products','product_images'])->get();
        $wishlists=DB::table('wishlists')
            ->join('products','products.product_id','=','wishlists.product_id')
            ->leftjoin('brands','brands.brand_id','=','products.brand_id')
            ->select('products.product_title','products.product_sub_title','products.product_price','products.product_discounted_price','product_discount','product_discount_type',
               'wishlists.product_id','wishlists.wishlist_id','products.category_slug','products.sub_category_slug','products.sub_sub_category_slug','products.product_slug','brands.brand_name',
               'products.color_id','products.size_id')
            ->where('wishlists.user_id',$user_id)
            ->get();
        // dd($wishlists);
        foreach ($wishlists as $wishlist ){
            $productImages=ProductImages::where('product_id',$wishlist->product_id)->first();
            $wishlistImage[$wishlist->product_id] = $productImages->image_name;
        }
      if (isset($wishlists) && count($wishlists)==0)
      {
        return view('frontend.wishlists.empty_wishlist');
      }
      return view('frontend.wishlists.index', compact('wishlists','wishlistImage'));

    }


    public function addtowishlist(Request $request)
    {

      // if(!auth()->user())
      // {
      // return ['error','Please login before adding product to Wishlist !'];
      // }
      $data = $request->all();
      $user_id = auth()->user()->id;

      // dd($request->all());


      $product_id = $request->product_id;
      $product = Products::where('product_id',$product_id)->first();

      $product_exist_in_wishlist = Wishlists::where('user_id',$user_id)->Where('product_id',$product_id)->first();
      if($product_exist_in_wishlist)
      {
        return ['success','Product is alredy in your Wishlist !'];
      }
      else
      {
        $add_wishlist = new Wishlists();
        $add_wishlist->user_id = $user_id;
        $add_wishlist->product_id = $product_id;

        $add_wishlist->save();
        return ['success','Product Added To The Wishlist !'];
      }
    }


  public function removewishlist(Request $request)
  {
    $wishlist=Wishlists::where('wishlist_id',$request->wishlistid)->delete();

    return ['success','Product deleted successfully!!!'];
  }





}
