<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Hotoffers;


class HotofferController extends Controller
{

  public function index()
  {
    $hotoffers = Hotoffers::orderBy('short_order','ASC')->get();
    // dd($hotoffers);
    return view('frontend.hotoffer.index', compact('hotoffers'));
  }
}
