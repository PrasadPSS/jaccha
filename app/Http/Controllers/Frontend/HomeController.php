<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
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
        $homepagesections = HomePageSections::where('visibility',1)->orderBy('home_page_section_priority')->with('home_page_section_type','section_childs')->get();
        return Inertia::render('Frontend/Homepage/ProductPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'homepagesections' => $homepagesections
        ]);
    }
}