<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Review;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;


class ReviewController extends Controller
{

  public function reviewStore(Request $request)
  {
   $reviews=new Review();
   $reviews->fill($request->all());
   $reviews->save();
   return  redirect()->back();
  }


}
