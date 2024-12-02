<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Manufacturers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class ManufacturersController extends Controller
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
        $manufacturers = Manufacturers::all();
        return view('backend.manufacturers.index')->with('manufacturers', $manufacturers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.manufacturers.create');
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
          'manufacturer_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $manufacturer = new Manufacturers();
        $manufacturer->fill($request->all());

        if ($manufacturer->save())
        {
          return redirect()->route('admin.manufacturers')->with('success', 'New Manufacturer Added!');
        }
        else
        {
          return redirect()->route('admin.manufacturers')->with('error', 'Something went wrong!');
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
        $manufacturer = Manufacturers::findOrFail($id);
        // dd($has_permissions);
        return view('backend.manufacturers.edit',compact('manufacturer'));
        // return view('backend.manufacturers.edit')->with('role', $role);
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
        $manufacturer_id = $request->input('manufacturer_id');
        $this->validate( $request, [
          'manufacturer_name' => ['required',],
        ]);
        // echo "string".$manufacturer_id;exit;
        // dd($request->all());
        // $manufacturer = new Manufacturers();
        $manufacturer = Manufacturers::findOrFail($manufacturer_id);
        $manufacturer->fill($request->all());

        if ($manufacturer->update())
        {
          return redirect()->route('admin.manufacturers')->with('success', 'New Manufacturer Updated!');
        }
        else
        {
          return redirect()->route('admin.manufacturers')->with('error', 'Something went wrong!');
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
        $manufacturer = Manufacturers::findOrFail($id);
        $manufacturer->delete();
        return redirect()->route('admin.manufacturers')->with('success', 'Manufacturer Deleted!');
    }
}
