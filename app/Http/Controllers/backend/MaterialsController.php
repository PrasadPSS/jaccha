<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Materials;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class MaterialsController extends Controller
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
        $materials = Materials::all();
        return view('backend.materials.index')->with('materials', $materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.materials.create');
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
          'material_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $material = new Materials();
        $material->fill($request->all());

        if ($material->save())
        {
          return redirect()->route('admin.materials')->with('success', 'New Material Added!');
        }
        else
        {
          return redirect()->route('admin.materials')->with('error', 'Something went wrong!');
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
        $material = Materials::findOrFail($id);
        // dd($has_permissions);
        return view('backend.materials.edit',compact('material'));
        // return view('backend.materials.edit')->with('role', $role);
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
        $material_id = $request->input('material_id');
        $this->validate( $request, [
          'material_name' => ['required',],
        ]);
        // echo "string".$material_id;exit;
        // dd($request->all());
        // $material = new Materials();
        $material = Materials::findOrFail($material_id);
        $material->fill($request->all());

        if ($material->update())
        {
          return redirect()->route('admin.materials')->with('success', 'New Material Updated!');
        }
        else
        {
          return redirect()->route('admin.materials')->with('error', 'Something went wrong!');
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
        $material = Materials::findOrFail($id);
        $material->delete();
        return redirect()->route('admin.materials')->with('success', 'Material Deleted!');
    }
}
