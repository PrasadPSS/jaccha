<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Packers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class PackersController extends Controller
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
        $packers = Packers::all();
        return view('backend.packers.index')->with('packers', $packers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.packers.create');
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
          'packer_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $packer = new Packers();
        $packer->fill($request->all());

        if ($packer->save())
        {
          return redirect()->route('admin.packers')->with('success', 'New Packer Added!');
        }
        else
        {
          return redirect()->route('admin.packers')->with('error', 'Something went wrong!');
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
        $packer = Packers::findOrFail($id);
        // dd($has_permissions);
        return view('backend.packers.edit',compact('packer'));
        // return view('backend.packers.edit')->with('role', $role);
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
        $packer_id = $request->input('packer_id');
        $this->validate( $request, [
          'packer_name' => ['required',],
        ]);
        // echo "string".$packer_id;exit;
        // dd($request->all());
        // $packer = new Packers();
        $packer = Packers::findOrFail($packer_id);
        $packer->fill($request->all());

        if ($packer->update())
        {
          return redirect()->route('admin.packers')->with('success', 'New Packer Updated!');
        }
        else
        {
          return redirect()->route('admin.packers')->with('error', 'Something went wrong!');
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
        $packer = Packers::findOrFail($id);
        $packer->delete();
        return redirect()->route('admin.packers')->with('success', 'Packer Deleted!');
    }
}
