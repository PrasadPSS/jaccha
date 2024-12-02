<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\SizeChartTypes;
use App\Models\backend\SizeChartFields;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class SizecharttypesController extends Controller
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
        $sizecharttypes = SizeChartTypes::all();
        return view('backend.sizecharttypes.index')->with('sizecharttypes', $sizecharttypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $size_chart_fields = SizeChartFields::get();
      $size_chart_field_list = collect($size_chart_fields)->mapWithKeys(function ($item, $key) {
        return [$item['size_chart_field_id'] => $item['size_chart_field_name']];
      });
      return view('backend.sizecharttypes.create',compact('size_chart_field_list'));
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
          'size_chart_type_name' => ['required',],
          'size_chart_field_id' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $size_chart_type = new SizeChartTypes();
        $size_chart_type->fill($request->all());
        $size_chart_type->size_chart_field_id = isset($request->size_chart_field_id)?implode(',',$request->size_chart_field_id):'';
        if ($size_chart_type->save())
        {
          return redirect()->route('admin.sizecharttypes')->with('success', 'New Size Chart Type Added!');
        }
        else
        {
          return redirect()->route('admin.sizecharttypes')->with('error', 'Something went wrong!');
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
        $size_chart_type = SizeChartTypes::findOrFail($id);
        $size_chart_fields = SizeChartFields::get();
        $size_chart_field_list = collect($size_chart_fields)->mapWithKeys(function ($item, $key) {
          return [$item['size_chart_field_id'] => $item['size_chart_field_name']];
        });
        // dd($has_permissions);
        return view('backend.sizecharttypes.edit',compact('size_chart_type','size_chart_field_list'));
        // return view('backend.sizecharttypes.edit')->with('role', $role);
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
        $size_chart_type_id = $request->input('size_chart_type_id');
        $this->validate( $request, [
          'size_chart_type_name' => ['required',],
        ]);
        // echo "string".$size_chart_type_id;exit;
        // dd($request->all());
        // $size_chart_type = new SizeChartTypes();
        $size_chart_type = SizeChartTypes::findOrFail($size_chart_type_id);
        $size_chart_type->fill($request->all());
        $size_chart_type->size_chart_field_id = isset($request->size_chart_field_id)?implode(',',$request->size_chart_field_id):'';
        if ($size_chart_type->update())
        {
          return redirect()->route('admin.sizecharttypes')->with('success', 'New Size Chart Type Updated!');
        }
        else
        {
          return redirect()->route('admin.sizecharttypes')->with('error', 'Something went wrong!');
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
        $size_chart_type = SizeChartTypes::findOrFail($id);
        $size_chart_type->delete();
        return redirect()->route('admin.sizecharttypes')->with('success', 'Size Chart Type Deleted!');
    }
}
