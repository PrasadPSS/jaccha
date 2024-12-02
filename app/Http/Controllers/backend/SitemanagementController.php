<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\backend\Footer;
use App\Models\frontend\Review;
use App\Models\backend\Products;
use App\Models\backend\FooterIds;
use App\Models\backend\Categories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\backend\SpecialDeals;
use App\Models\backend\DealsProductId;
use App\Models\backend\HomePageSections;
use App\Models\backend\SubSubCategories;
use Artisan;

class SitemanagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function down()
    {
        Artisan::call('down --secret="bypassmaintenance"');// --secret="1630542a-246b-4b66-afa1-dd72a4c43515"
        return redirect('admin/')->with('success', 'Site Down Successfully!!!');
    }
    public function up()
    {
        Artisan::call('up');
        return redirect('admin/')->with('success', 'Site Up Successfully!!!');
    }
    

   

}
