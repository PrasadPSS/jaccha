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
use Illuminate\Support\Facades\DB;

class SuggestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
      $suggestions=DB::table('suggestion')
      ->join('users','users.id','=','suggestion.user_id')
          ->select('users.name','suggestion.message','suggestion.id')
          ->get();
       return view('backend.suggestion.index',compact('suggestions'));
    }

    public function view($id){

        $suggestion=DB::table('suggestion')
            ->join('users','users.id','=','suggestion.user_id')
            ->select('users.name','suggestion.message')
            ->where('suggestion.id',$id)
            ->first();

        return view('backend.suggestion.view',compact('suggestion'));


    }

    public function destroy($id)
    {
        $suggession = Suggestion::findOrFail($id);

        $suggession->delete();

        // Session::flash('success', 'Suggestion deleted!');

        return redirect('admin/suggestion')->with('success', 'Suggestion deleted!');
    }


}
