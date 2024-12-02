<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\HomePageSectionTypes;
use App\Models\backend\HomePageSectionFields;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class HomepagesectiontypesController extends Controller
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
        $homepagesectiontypes = HomePageSectionTypes::all();
        return view('backend.homepagesectiontypes.index')->with('homepagesectiontypes', $homepagesectiontypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $home_page_section_fields = HomePageSectionFields::get();
      $home_page_section_field_list = collect($home_page_section_fields)->mapWithKeys(function ($item, $key) {
        return [$item['home_page_section_field_id'] => $item['home_page_section_field_name']];
      });
      return view('backend.homepagesectiontypes.create',compact('home_page_section_field_list'));
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
          'home_page_section_type_name' => ['required',],
          'home_page_section_field_id' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $home_page_section_type = new HomePageSectionTypes();
        $home_page_section_type->fill($request->all());
        $home_page_section_type->home_page_section_field_id = isset($request->home_page_section_field_id)?implode(',',$request->home_page_section_field_id):'';
        if ($home_page_section_type->save())
        {
          return redirect()->route('admin.homepagesectiontypes')->with('success', 'New Home Page Section Type Added!');
        }
        else
        {
          return redirect()->route('admin.homepagesectiontypes')->with('error', 'Something went wrong!');
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
        $home_page_section_type = HomePageSectionTypes::findOrFail($id);
        $home_page_section_fields = HomePageSectionFields::get();
        $home_page_section_field_list = collect($home_page_section_fields)->mapWithKeys(function ($item, $key) {
          return [$item['home_page_section_field_id'] => $item['home_page_section_field_name']];
        });
        // dd($has_permissions);
        return view('backend.homepagesectiontypes.edit',compact('home_page_section_type','home_page_section_field_list'));
        // return view('backend.homepagesectiontypes.edit')->with('role', $role);
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
        $home_page_section_type_id = $request->input('home_page_section_type_id');
        $this->validate( $request, [
          'home_page_section_type_name' => ['required',],
        ]);
        // echo "string".$home_page_section_type_id;exit;
        // dd($request->all());
        // $home_page_section_type = new HomePageSectionTypes();
        $home_page_section_type = HomePageSectionTypes::findOrFail($home_page_section_type_id);
        $home_page_section_type->fill($request->all());
        $home_page_section_type->home_page_section_field_id = isset($request->home_page_section_field_id)?implode(',',$request->home_page_section_field_id):'';
        if ($home_page_section_type->update())
        {
          return redirect()->route('admin.homepagesectiontypes')->with('success', 'New Home Page Section Type Updated!');
        }
        else
        {
          return redirect()->route('admin.homepagesectiontypes')->with('error', 'Something went wrong!');
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
        $home_page_section_type = HomePageSectionTypes::findOrFail($id);
        $home_page_section_type->delete();
        return redirect()->route('admin.homepagesectiontypes')->with('success', 'Home Page Section Type Deleted!');
    }
}
