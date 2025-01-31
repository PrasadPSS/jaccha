<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Cmspages;
use App\Models\backend\Company;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
use App\Models\backend\Products;
use App\Models\backend\Publication;
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
        $data['products'] = Products::whereIn('product_id', $ids)->with('variants','reviews')->get();
        $homepagesections = HomePageSections::where('visibility', 1)->orderBy('home_page_section_priority')->with('home_page_section_type', 'section_childs', 'product.variants', )->get();
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

    public function viewPublicationPages($publication_slug)
    {
        $publicationpage = Publication::where('publication_slug', $publication_slug)->first();

        return Inertia::render('Frontend/Pages/View1', [
            'publications' => $publicationpage,
        ]);
    }

    public function home()
    {
      $data['publications'] = Publication::all();
      
      return Inertia::render('Frontend/Publications/Index', $data);
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
        
        'comment'=>'required']);
        
    
        $userDetails = ['name'=>$data['name'],'email'=> $data['email'], 'mobile_no'=> $request->mobile_no ?? null , 'comment'=>$data['comment']];
        Contactus::create($userDetails);
        $mailService = new phpMailerService();
        $company = Company::first();
        $message = "
    <html>
        <head>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                    font-size: 16px;
                    font-family: Arial, sans-serif;
                }
                table, th, td {
                    border: 1px solid #dddddd;
                }
                th, td {
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                .message-header {
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 14px;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class='message-header'>Contact Us Message Details</div>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{$data['name']}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{$data['email']}</td>
                </tr>
                
                <tr>
                    <td>Mobile Number</td>
                    <td>{$request->mobile_no}</td>
                </tr>
                
                <tr>
                    <td>Comment</td>
                    <td>{$data['comment']}</td>
                </tr>
            </table>
            <div class='footer'>
                This message was sent via the contact form on your website.
            </div>
        </body>
    </html>
";
        $mailService->sendMail($company->email,'Contact us', $message, $data['comment']);

        return redirect()->route('contactus')->with('success', 'Your message has been sent successfully.');

    }
}