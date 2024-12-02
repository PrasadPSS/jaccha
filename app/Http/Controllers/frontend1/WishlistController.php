<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;


class WishlistController extends Controller
{

  public function index()
  {
    return view('frontend.wishlist.index');
  }

  public function addtowishlist()
  {
    return view('frontend.wishlist.index');
  }
}
