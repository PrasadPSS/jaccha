<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Sizes;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class SizesController extends Controller
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
        $sizes = Sizes::all();
        return view('backend.sizes.index')->with('sizes', $sizes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.sizes.create');
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
          'size_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $size = new Sizes();
        $size->fill($request->all());

        if ($size->save())
        {
          return redirect()->route('admin.sizes')->with('success', 'New Size Added!');
        }
        else
        {
          return redirect()->route('admin.sizes')->with('error', 'Something went wrong!');
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
        $size = Sizes::findOrFail($id);
        // dd($has_permissions);
        return view('backend.sizes.edit',compact('size'));
        // return view('backend.sizes.edit')->with('role', $role);
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
        $size_id = $request->input('size_id');
        $this->validate( $request, [
          'size_name' => ['required',],
        ]);
        // echo "string".$size_id;exit;
        // dd($request->all());
        // $size = new Sizes();
        $size = Sizes::findOrFail($size_id);
        $size->fill($request->all());

        if ($size->update())
        {
          return redirect()->route('admin.sizes')->with('success', 'New Size Updated!');
        }
        else
        {
          return redirect()->route('admin.sizes')->with('error', 'Something went wrong!');
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
        $size = Sizes::findOrFail($id);
        $size->delete();
        return redirect()->route('admin.sizes')->with('success', 'Size Deleted!');
    }
}
