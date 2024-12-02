<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Footer;
use App\Models\backend\FooterIds;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Newsletters;
use App\Models\frontend\Review;
use App\Models\frontend\Suggestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\frontend\TrafficSource;
use Illuminate\Support\Facades\DB;

class TrafficsourceController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }


    public function index()
    {
    $externaluser = TrafficSource::all();

    return view('backend.trafficsource.index',compact('externaluser'));
    }

    // public function view($id){

    //     $suggestion=DB::table('suggestion')
    //         ->join('users','users.id','=','suggestion.user_id')
    //         ->select('users.name','suggestion.message')
    //         ->where('suggestion.id',$id)
    //         ->first();

    //     return view('backend.suggestion.view',compact('suggestion'));


    // }

   


}
