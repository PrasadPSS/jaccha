<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\CustomPageTitles;
use App\Models\backend\Products;
use App\Models\backend\HomePageSections;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class CustompagetitlesController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custompagetitles = CustomPageTitles::all();
        return view('backend.custompagetitles.index',compact('custompagetitles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $products = Products::all();
      $products = collect($products)->mapWithKeys(function ($item, $key) {
        return [$item['product_id'] => $item['product_title']];
      });
      return view('backend.custompagetitles.create',compact('products'));
        // exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'custom_page_title_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $custom_page_title = new CustomPageTitles();
        $custom_page_title->fill($request->all());
        if ($custom_page_title->save())
        {
          return redirect()->route('admin.custompagetitles')->with('success', 'New Custom Page Title Added!');
        }
        else
        {
          return redirect()->route('admin.custompagetitles')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $custom_page_title = CustomPageTitles::findOrFail($id);
        // dd($has_permissions);
        return view('backend.custompagetitles.edit',compact('custom_page_title'));
        // return view('backend.custompagetitles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $custom_page_title_id = $request->input('custom_page_title_id');
        $this->validate( $request, [
          'custom_page_title_name' => ['required',],
          'custom_page_title_code' => 'required',
        ]);
        // echo "string".$custom_page_title_id;exit;
        // dd($request->all());
        // $custom_page_title = new CustomPageTitles();
        $custom_page_title = CustomPageTitles::findOrFail($custom_page_title_id);
        $custom_page_title->fill($request->all());
        if ($custom_page_title->update())
        {
          return redirect()->route('admin.custompagetitles')->with('success', 'New Custom Page Title Updated!');
        }
        else
        {
          return redirect()->route('admin.custompagetitles')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom_page_title = CustomPageTitles::findOrFail($id);
        $custom_page_title->delete();
        return redirect()->route('admin.custompagetitles')->with('success', 'Custom Page Title Deleted!');
    }

    // public function custom_page_titlevalues($custom_page_title_id)
    // {
    //   $custom_page_title = CustomPageTitles::findOrFail($custom_page_title_id);
    //   $custom_page_titlevalues = Custom Page TitleValues::Where('custom_page_title_id',$custom_page_title_id)->get();
    //   // dd($has_permissions);
    //   return view('backend.custompagetitles.custom_page_titlevalues',compact('custom_page_title_id','custom_page_title','custom_page_titlevalues'));
    //   // return view('backend.custompagetitles.edit')->with('role', $role);
    // }
}
