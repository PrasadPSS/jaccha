<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Gst;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class GstController extends Controller
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
        $gst = Gst::all();
        return view('backend.gst.index')->with('gst', $gst);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.gst.create');
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
          'gst_name' => ['required',],
          'gst_min_price' => ['required',],
          'gst_max_price' => ['required',],
          'gst_cgst_percent' => ['required',],
          'gst_sgst_percent' => ['required',],
          'gst_igst_percent' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $gst = new Gst();
        $gst->fill($request->all());

        if ($gst->save())
        {
          return redirect()->route('admin.gst')->with('success', 'New Gst Added!');
        }
        else
        {
          return redirect()->route('admin.gst')->with('error', 'Something went wrong!');
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
        $gst = Gst::findOrFail($id);
        // dd($has_permissions);
        return view('backend.gst.edit',compact('gst'));
        // return view('backend.gst.edit')->with('role', $role);
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
        $gst_id = $request->input('gst_id');
        $this->validate( $request, [
          'gst_name' => ['required',],
          'gst_min_price' => ['required',],
          'gst_max_price' => ['required',],
          'gst_cgst_percent' => ['required',],
          'gst_sgst_percent' => ['required',],
          'gst_igst_percent' => ['required',],
        ]);
        // echo "string".$gst_id;exit;
        // dd($request->all());
        // $gst = new Gst();
        $gst = Gst::findOrFail($gst_id);
        $gst->fill($request->all());

        if ($gst->update())
        {
          return redirect()->route('admin.gst')->with('success', 'Gst Updated!');
        }
        else
        {
          return redirect()->route('admin.gst')->with('error', 'Something went wrong!');
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
        $gst = Gst::findOrFail($id);
        $gst->delete();
        return redirect()->route('admin.gst')->with('success', 'Gst Deleted!');
    }
}
