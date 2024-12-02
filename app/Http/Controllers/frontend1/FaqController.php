<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;


class FaqController extends Controller
{

  public function index()
  {
    $faqs = Faqs::Where('visibility',1)->with('questions')->orderByRaw('cast(sort_order as UNSIGNED)','ASC')->get();
    // dd($faqs);
    if($faqs)
    {
      return view('frontend.faqs.index',compact('faqs'));
    }
  }
}
