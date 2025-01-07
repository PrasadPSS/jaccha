<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Cmspages;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
use App\Models\backend\Products;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProductCodes = FeaturedProducts::where('home_page_featured_product_name', 'Best Sellers')->first()->product_id;
        $ids = explode(',', $featuredProductCodes);

        // Step 2: Retrieve the products
        $data['products'] = Products::whereIn('product_id', $ids)->with('reviews')->get();
        $homepagesections = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs')->get();
        return Inertia::render('Frontend/Homepage/ProductPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'homepagesections' => $homepagesections,
            'data' => $data
        ]);
    }

    public function viewPages($cms_slug)
    {
        $cmspage = Cmspages::where('cms_slug', $cms_slug)->first();

        return Inertia::render('Frontend/Pages/View', [
            'cms_pages' => $cmspage,
        ]);
    }
}