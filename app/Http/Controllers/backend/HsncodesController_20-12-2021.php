<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\HSNCodes;
use App\Models\backend\Materials;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class HsncodesController extends Controller
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
        $hsncodes = HSNCodes::get();
        return view('backend.hsncodes.index',compact('hsncodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $materials = Materials::all();
      $materials = collect($materials)->mapWithKeys(function ($item, $key) {
        return [$item['material_id'] => $item['material_name']];
      });
      return view('backend.hsncodes.create',compact('materials'));
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
          'hsncode_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $hsncode = new HSNCodes();
        $hsncode->fill($request->all());

        if ($hsncode->save())
        {
          return redirect('admin/hsncodes/')->with('success', 'New HSN Code Added!');
        }
        else
        {
          return redirect('admin/hsncodes/')->with('error', 'Something went wrong!');
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
        $hsncode = HSNCodes::findOrFail($id);
        $materials = Materials::all();
        $materials = collect($materials)->mapWithKeys(function ($item, $key) {
          return [$item['material_id'] => $item['material_name']];
        });
        // dd($has_permissions);
        return view('backend.hsncodes.edit',compact('hsncode','materials'));
        // return view('backend.hsncodes.edit')->with('role', $role);
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
        $hsncode_id = $request->input('hsncode_id');
        $this->validate( $request, [
          'hsncode_name' => ['required',],
        ]);
        // echo "string".$hsncode_id;exit;
        // dd($request->all());
        // $hsncode = new HSNCodes();
        $hsncode = HSNCodes::findOrFail($hsncode_id);
        $hsncode->fill($request->all());

        if ($hsncode->update())
        {
          // dd($hsncode);
          return redirect('admin/hsncodes/');
        }
        else
        {
          return redirect('admin/hsncodes/');
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
        $hsncode = HSNCodes::findOrFail($id);
        $hsncode->delete();
        return redirect('admin/hsncodes/')->with('success', 'HSN Code Deleted!');
    }
}
