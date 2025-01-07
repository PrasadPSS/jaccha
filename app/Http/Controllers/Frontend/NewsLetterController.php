<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Cmspages;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
use App\Models\backend\Products;
use App\Models\frontend\Newsletters;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email'=>'required|email']);

        $exists = Newsletters::where('email', $request->email)->exists();

        if($exists)
        {
            return redirect()->back()->with('error', 'You are already subscribed to our newsletter');
        }

        Newsletters::create(['email'=> $request->email]);

        return redirect()->back()->with('success', 'You have been subscribed to our newsletter.');
    }
}