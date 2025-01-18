<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Cmspages;
use App\Models\backend\Company;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
use App\Models\backend\Products;
use App\Models\frontend\Contactus;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use App\Services\phpMailerService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProductCodes = FeaturedProducts::where('home_page_featured_product_name', 'Featured Products')->first()->product_id;
        $ids = explode(',', $featuredProductCodes);

        // Step 2: Retrieve the products
        $data['products'] = Products::whereIn('product_id', $ids)->with('reviews')->get();
        $homepagesections = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs', 'product')->get();
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

    public function contactus()
    {
        $company = Company::first();

        return Inertia::render('Frontend/Contactus/ContactUs', ['company' => $company]);
    }

    public function storeContactUs(Request $request)
    {
        
        $data = request()->validate(['name' =>'required', 
        'email'=>'required', 
        'mobile_no'=>'required', 
        'comment'=>'required']);
    
        $userDetails = ['name'=>$data['name'],'email'=> $data['email'], 'mobile_no'=> $data['mobile_no'], 'comment'=>$data['comment']];
        Contactus::create($userDetails);
        $mailService = new phpMailerService();
        $company = Company::first();
        $mailService->sendMail($company->email,'Contact us', $data['comment'], $data['comment']);

        return redirect()->route('contactus')->with('success', 'Your message has been sent successfully.');

    }
}