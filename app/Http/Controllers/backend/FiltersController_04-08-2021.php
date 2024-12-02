<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Filters;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class FiltersController extends Controller
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
        $filters = Filters::all();
        return view('backend.filters.index')->with('filters', $filters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.filters.create');
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
          'filter_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $filter = new Filters();
        $filter->fill($request->all());

        if ($filter->save())
        {
          return redirect()->route('admin.filters')->with('success', 'New Filter Added!');
        }
        else
        {
          return redirect()->route('admin.filters')->with('error', 'Something went wrong!');
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
        $filter = Filters::findOrFail($id);
        // dd($has_permissions);
        return view('backend.filters.edit',compact('filter'));
        // return view('backend.filters.edit')->with('role', $role);
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
        $filter_id = $request->input('filter_id');
        $this->validate( $request, [
          'filter_name' => ['required',],
        ]);
        // echo "string".$filter_id;exit;
        // dd($request->all());
        // $filter = new Filters();
        $filter = Filters::findOrFail($filter_id);
        $filter->fill($request->all());

        if ($filter->update())
        {
          return redirect()->route('admin.filters')->with('success', 'New Filter Updated!');
        }
        else
        {
          return redirect()->route('admin.filters')->with('error', 'Something went wrong!');
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
        $filter = Filters::findOrFail($id);
        $filter->delete();
        return redirect()->route('admin.filters')->with('success', 'Filter Deleted!');
    }

    // public function filtervalues($filter_id)
    // {
    //   $filter = Filters::findOrFail($filter_id);
    //   $filtervalues = FilterValues::Where('filter_id',$filter_id)->get();
    //   // dd($has_permissions);
    //   return view('backend.filters.filtervalues',compact('filter_id','filter','filtervalues'));
    //   // return view('backend.filters.edit')->with('role', $role);
    // }
}
