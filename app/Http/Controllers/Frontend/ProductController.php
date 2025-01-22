<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\HomePageSections;
use App\Models\backend\Prices;
use App\Models\backend\ProductImages;
use App\Models\backend\Productlist;
use App\Models\backend\Products;

use App\Models\backend\ProductVariants;
use App\Models\backend\RelatedProducts;
use App\Models\backend\Sizes;
use App\Models\CartItem;

use App\Models\frontend\Cart;
use App\Models\frontend\Categories;
use App\Models\frontend\Review;
use App\Models\frontend\SubCategories;
use App\Models\frontend\Wishlists;
use Illuminate\Http\Request;

use Inertia\Inertia;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data['products'] =  Products::withAvg('reviews', 'rating');
        $data['sizes'] = Sizes::all();
        $data['prices'] = Prices::all();
        if($request->querys != null || $request->querys != '')
        {
            $data['products']->where('product_title', 'like', '%' . $request->querys . '%')
            ->orWhere('category_slug', 'like', '%' . $request->querys . '%');
        }
        $data['products'] = $data['products']->with('variants','reviews')->get();
        $data['homepagesections'] = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs')->get();

        return Inertia::render('Frontend/Products/ProductSearch', $data);
    }

    public function category($category_slug)
    {

        $data['sizes'] = Sizes::all();
        $data['prices'] = Prices::all();
        $exists = false;
        if($category_slug != 'featured-products' && $category_slug != 'new-arrival')
        {
            $cartegoryid= Categories::where('category_slug', $category_slug)->first()->category_id;
            $exists = Productlist::where('category_id', $cartegoryid)->exists();
        }
       
        if($exists)
        {
            $data['categorycontent'] = Productlist::where('category_id', $cartegoryid)->first();
        }
        else
        {
            $data['categorycontent'] = Null;
        }
       
  
        if($category_slug == 'new-arrival')
        {
            
            $data['products'] = Products::where('new_arrival', 1)->with('variants','reviews')->withAvg('reviews', 'rating')->get();

        }
        else if($category_slug == 'featured-products')
        {
            $featuredProducts = FeaturedProducts::select('product_id')->first();
            $data['products'] = Products::whereIn('product_id', explode(',',$featuredProducts['product_id']))->with('variants','reviews')->withAvg('reviews', 'rating')->get();

        }
        else
        {
            $data['products'] = Products::where('category_slug', $category_slug)->with('variants','reviews')->withAvg('reviews', 'rating')->get();
        }
        $data['homepagesections'] = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs')->get();
        return Inertia::render('Frontend/Category/Category', $data);
    }

    public function subcategory($subcategory_slug)
    {
        $data['sizes'] = Sizes::all();
        $data['prices'] = Prices::all();
        $subcategoryid= SubCategories::where('sub_category_slug', $subcategory_slug)->first()->subcategory_id;
        $exists = Productlist::where('sub_category_id', $subcategoryid)->exists();
        if($exists)
        {
            $data['categorycontent'] = Productlist::where('sub_category_id', $subcategoryid)->first();
        }
        else
        {
            $data['categorycontent'] = Null;
        }
        
        
        $data['products'] = Products::where('sub_category_slug', $subcategory_slug)->with('variants','reviews')->withAvg('reviews', 'rating')->get();
        
        $data['homepagesections'] = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs')->get();
        return Inertia::render('Frontend/Category/Category', $data);
    }

    public function buy($product_id, $quantity)
    {
        $product = Products::where('id', $product_id)->first();
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        Cart::where('user_id', auth()->user()->id)->update(['total' => (int) $cart->total + (int) ($product->price * $quantity)]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $product_id, 'quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function addtocart(Request $request)
    {

        $this->validate(request(), [
            'product_id' => 'required',
            'quantity' => 'required',
            'product_type' => 'required',
        ]);

        $product_id = $request->product_id;

        $product_variant_id = '';
        if ($request->product_type == 'simple') {
            $product = Products::where('product_id', $product_id)->first();
        } elseif ($request->product_type == 'configurable') {
            $product_variant_id = $request->product_variant_id;
            $product = ProductVariants::where('product_id', $product_id)->where('product_variant_id', $product_variant_id)->first();
        }
        // check if product is in stock
        if ($product->product_qty <= 0) {
            return back()->with([
                'error' => 'Product is out of stock'
            ]);
        }
        if ($product->out_of_stock_flag == 0) {
            return back()->with([
                'error' => 'Product is out of stock'
            ]);
        }
        if ($product->product_qty < $request->quantity) {
            return back()->with([
                'error' => 'Only ' . $product->product_qty . ' Product left (Please select quantity upto ' . $product->product_qty . ')'
            ]);
        }

        if (!auth()->user()) {
            //put values in the session
            session()->put('cart.cart_' . $request->product_id . '_' . $request->product_variant_id, $request->all());
            if (isset($request->addto) && $request->addto == 'addtobuy') {
                return redirect()->to('/cart')->with('success', 'Product Added To Buy Now!');
            }

            return back()->with('success', 'Product Added To The Basket Successfully !');
        }


        $user_distributor_id = auth()->user()->distributor_id;
        $user_table = 'users';
        $added_by = auth()->user()->id;

        $quantity = $request->quantity;
        if (isset($request->quantity)) {
            $quantity = $request->quantity;
        }

        $user_id = auth()->user()->id;
        // $user_id = auth()->user()->id;

        if ($request->product_type == 'simple') {
            $product_exist_in_cart = Cart::where('user_id', $user_id)->Where('product_id', $product_id)->first();
        } elseif ($request->product_type == 'configurable') {
            $product_exist_in_cart = Cart::where('user_id', $user_id)->Where('product_id', $product_id)->where('product_variant_id', $product_variant_id)->first();
        }

        if (isset($product_exist_in_cart) && $product_exist_in_cart->qty >= $product->product_qty) {
            return back()->with([
                'error' => 'Product already in cart'
            ]);
        }

        if ($product_exist_in_cart) {
            $product_qty = (int) $product_exist_in_cart->qty;
            $product_qty = $product_qty + $quantity;
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
            if (isset($request->page_name) && $request->page_name == 'wishlist') {
                $wishlist = Wishlists::where('wishlist_id', $request->wishlistid)->delete();
            }
            if (isset($request->addto) && $request->addto == 'addtobuy') {
                return redirect()->to('/cart')->with('success', 'Product Added To Buy Now!');
            }
            return back()->with('success', 'Product Added To The Cart Successfully !');
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->product_type = $request->product_type;
            if ($request->product_type == 'configurable') {
                $cart->product_variant_id = $product_variant_id;
            }
            $cart->sweetness_level = $request->sweetnesslevel;
            $cart->ingredient_addons = $request->ingrediantaddons;
            $cart->ingredient_exclusions = $request->exclusions;
            $cart->price = ($quantity * $request->product_price);
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
            
            Wishlists::where('product_id', $product_id)->where('user_id', auth()->user()->id)->delete();
            
            if (isset($request->addto) && $request->addto == 'addtobuy') {
                return redirect()->to('/cart')->with('success', 'Product Added To Buy Now!');
            }
            return back()->with('success', 'Product Added To The Cart Successfully !');
        }
    }

    public function viewProductDetails($product_slug)
    {
        
        $data['product'] = Products::where('product_slug', $product_slug)->with('product_variants')->first();
        $product_id = $data['product']->product_id;
        $data['product_reviews'] = Review::where('product_id', $product_id)->get()->toArray();
        $data['product_images'] = ProductImages::where('product_id', $product_id)->limit(3)->get()->toArray();
        $data['average_rating'] = Review::where('product_id', $product_id)->avg('rating'); 
        $data['related_product_list'] = RelatedProducts::where('product_id', $product_id)->with('product', 'product.reviews')->get();
        $data['related_avg'] = [];

        foreach ($data['related_product_list'] as $key => $value) 
        {
            $data['related_avg'][]= ['avg'=> $value->product->reviews->avg('rating')];
        }
       
        return Inertia::render('Frontend/Products/ProductDetail', $data);
    }


    public function checkPincodeServiceability(Request $request)
    {
    // Validate the delivery pincode input
    $request->validate([
        'pincode' => [
            'required',
            'numeric',
            'digits:6',
            'regex:/^[1-9][0-9]{5}$/',
        ],
    ], [
        'pincode.required' => 'The pincode field is required.',
        'pincode.digits' => 'The pincode must be exactly 6 digits.',
        'pincode.regex' => 'The pincode must start with a non-zero digit and only contain numbers.',
    ]);
    $deliveryPincode = $request->pincode;
    $pincodeServiceability = check_pincode($deliveryPincode);
    return response()->json($pincodeServiceability);
    }

}
