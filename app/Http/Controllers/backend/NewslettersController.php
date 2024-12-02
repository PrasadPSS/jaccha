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
use Session;

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

    public function delete($id){
        $newsletters = Newsletters::findOrFail($id);
        $newsletters->delete();
        Session::flash('message', 'Newsletter deleted!');
        Session::flash('status', 'success');
        return redirect('admin/newsletter');
    }


}
