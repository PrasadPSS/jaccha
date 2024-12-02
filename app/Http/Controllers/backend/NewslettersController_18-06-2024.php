<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Footer;
use App\Models\backend\FooterIds;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Newsletters;
use App\Models\frontend\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewslettersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
      $newsletters=Newsletters::all();
       return view('backend.newsletter.index',compact('newsletters'));
    }


}
