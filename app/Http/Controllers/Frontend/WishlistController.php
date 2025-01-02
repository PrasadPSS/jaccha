<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Products;
use App\Models\backend\ProductVariants;
use App\Models\frontend\Cart;
use App\Models\frontend\Wishlists;
use Inertia\Inertia;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
	public function index()
	{
		$data['wishlist'] = Wishlists::where('user_id', auth()->user()->id)->with('products')->get();

		return Inertia::render('Frontend/Wishlist/Index', $data);
	}

	public function add(Request $request)
	{
		$user_id = auth()->user()->id;

		// dd($request->all());


		$product_id = $request->product_id;


		$product_exist_in_wishlist = Wishlists::where('user_id', $user_id)->Where('product_id', $product_id)->first();
		if ($product_exist_in_wishlist) {
			return back()->with('error', 'Product is alredy in your Wishlist !');
		} else {
			$add_wishlist = new Wishlists();
			$add_wishlist->user_id = $user_id;
			$add_wishlist->product_id = $product_id;

			$add_wishlist->save();
			return redirect()->back()->with('success', 'Product Added to Wishlist');
		}
	}



	public function addAllToCart()
	{

		// Fetch wishlist products for the user
		$wishlistItems = Wishlists::where('user_id', auth()->user()->id)->with('products')->get();

		$outOfStockProducts = [];

		foreach ($wishlistItems as $item) {
			$wishlistProduct = Products::where('product_id', $item->product_id)->first();
			$cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $item->product_id)->first();
			// Check stock availability
			if (!$wishlistProduct || $wishlistProduct->product_qty <= 0 || $wishlistProduct->out_of_stock_flag == 0) {
				$outOfStockProducts[] = $wishlistProduct->product_title ?? "Unknown Product";
				continue;
			}

			// Check quantity
			if ($wishlistProduct->product_qty < 1) {
				$outOfStockProducts[] = $wishlistProduct->name . " (Only " . $wishlistProduct->product_qty . " available)";
				continue;
			}

			if($cartItem)
			{
				Cart::where('user_id', auth()->user()->id)->where('product_id', $item->product_id)->update(['qty'=> $cartItem->qty + 1]);
				$item->delete();
				continue;
			}
			

			// Add the product to the cart
			$cart = new Cart();
			$cart->user_id = auth()->user()->id;
			$cart->product_id = $item->product_id;
			$cart->product_variant_id = null;
			$cart->product_type = $item->product_type;
			$cart->qty = 1;
			$cart->price = $wishlistProduct->price * 1;
			$cart->discount = $wishlistProduct->product_discount;
			$cart->currency = 'INR';
			$cart->save();

			// Remove the product from the wishlist
			$item->delete();
		}

		// Notify the user
		$successMessage = "Selected product and wishlist items added to the cart successfully!";
		if (!empty($outOfStockProducts)) {
			$errorMessage = "Some products couldn't be added to the cart due to stock issues: " . implode(', ', $outOfStockProducts);
			return redirect()->back()->with(['success' => $successMessage, 'error' => $errorMessage]);
		}

		return redirect()->back()->with('success', $successMessage);
	}

	/**
	 * Helper function to add a single product to the cart.
	 */


	public function delete(Request $request)
	{
		$product_id = $request->product_id;
		$user_id = auth()->user()->id;
		Wishlists::where('user_id', $user_id)->where('product_id', $product_id)->delete();

		return redirect()->back()->with('success', 'Product Removed from wishlist');
	}
}
