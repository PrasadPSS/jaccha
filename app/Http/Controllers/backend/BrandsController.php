<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Brands;
use App\Models\backend\Manufacturers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class BrandsController extends Controller
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
    public function index($id)
    {
        $brands = Brands::where('manufacturer_id',$id)->get();
        return view('backend.brands.index',compact('id','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

      $manufacturers = Manufacturers::all();
      $manufacturers = collect($manufacturers)->mapWithKeys(function ($item, $key) {
        return [$item['manufacturer_id'] => $item['manufacturer_name']];
      });
      return view('backend.brands.create',compact('manufacturers','id'));
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
          'brand_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $brand = new Brands();
        $brand->fill($request->all());

        if ($brand->save())
        {
          return redirect('admin/brands/index/'.$request->manufacturer_id)->with('success', 'New Brand Added!');
        }
        else
        {
          return redirect('admin/brands/index/'.$request->manufacturer_id)->with('error', 'Something went wrong!');
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
        $brand = Brands::findOrFail($id);
        $manufacturers = Manufacturers::all();
        $manufacturers = collect($manufacturers)->mapWithKeys(function ($item, $key) {
          return [$item['manufacturer_id'] => $item['manufacturer_name']];
        });
        // dd($has_permissions);
        return view('backend.brands.edit',compact('brand','manufacturers'));
        // return view('backend.brands.edit')->with('role', $role);
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
        $brand_id = $request->input('brand_id');
        $this->validate( $request, [
          'brand_name' => ['required',],
        ]);
        // echo "string".$brand_id;exit;
        // dd($request->all());
        // $brand = new Brands();
        $brand = Brands::findOrFail($brand_id);
        $brand->fill($request->all());

        if ($brand->update())
        {
          // dd($brand);
          return redirect('admin/brands/index/'.$request->manufacturer_id);
        }
        else
        {
          return redirect('admin/brands/index/'.$request->manufacturer_id);
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
        $brand = Brands::findOrFail($id);
        $brand->delete();
        return redirect('admin/brands/index/'.$brand->manufacturer_id)->with('success', 'Brand Deleted!');
    }
}
