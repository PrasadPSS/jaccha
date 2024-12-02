<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Review;
use App\Models\backend\Downloadapp;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;


class DownloadappController extends Controller
{

  public function index()
  {
    $downloadapp_image = Downloadapp::first();
    // dd($downloadapp_image);
    return view('frontend.downloadapp.index', compact('downloadapp_image'));
  }


}
