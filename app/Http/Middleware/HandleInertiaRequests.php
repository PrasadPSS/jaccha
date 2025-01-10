<?php

namespace App\Http\Middleware;

use App\Models\backend\Cmspages;
use App\Models\frontend\Cart;
use App\Models\frontend\Categories;
use App\Models\frontend\Orders;
use App\Models\frontend\Review;
use App\Models\frontend\Wishlists;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'cart_count' => $request->user() ? Cart::where('user_id', $request->user()->id)->sum('qty') : "",
                'wishlist_count'=> $request->user() ? Wishlists::where('user_id', $request->user()->id)->get()->count() : "",
                'wishlist' => $request->user() ? Wishlists::where('user_id', $request->user()->id)->get() : "",
                'categories' => Categories::with('subcategories')->get(),
                'orders' => $request->user() ? Orders::where('user_id', $request->user()->id)->with('orderproducts', 'orderproducts.products')->get() : "",
                'reviews'=> $request->user() ? Review::where('user_id', $request->user()->id)->get() : "",
                'querys'=>  $request->querys,
                'quick_links' => Cmspages::where('column_type', 'quick_links')->get(),
                
            ],
            'flash' => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
        ],  

        ];
    }
}
