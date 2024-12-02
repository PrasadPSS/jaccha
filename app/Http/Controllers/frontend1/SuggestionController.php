<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Newsletters;
use App\Models\frontend\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SuggestionController extends Controller
{

  public function index(Request $request)
  {
      if (Auth::check() == true)
      {
        $suggestions = new Suggestion();
        $suggestions->user_id = Auth()->user()->id;
        $suggestions->message = $request->message;
        $suggestions->save();
        return redirect()->back()->with('success','Thank you for your Suggestion!!!');
      }
      else
      {
        return redirect()->back()->withErrors(['Please Login first!!!']);
      }
  }


}
