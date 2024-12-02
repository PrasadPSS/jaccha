<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Importers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class ImportersController extends Controller
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
        $importers = Importers::all();
        return view('backend.importers.index')->with('importers', $importers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.importers.create');
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
          'importer_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $importer = new Importers();
        $importer->fill($request->all());

        if ($importer->save())
        {
          return redirect()->route('admin.importers')->with('success', 'New Importer Added!');
        }
        else
        {
          return redirect()->route('admin.importers')->with('error', 'Something went wrong!');
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
        $importer = Importers::findOrFail($id);
        // dd($has_permissions);
        return view('backend.importers.edit',compact('importer'));
        // return view('backend.importers.edit')->with('role', $role);
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
        $importer_id = $request->input('importer_id');
        $this->validate( $request, [
          'importer_name' => ['required',],
        ]);
        // echo "string".$importer_id;exit;
        // dd($request->all());
        // $importer = new Importers();
        $importer = Importers::findOrFail($importer_id);
        $importer->fill($request->all());

        if ($importer->update())
        {
          return redirect()->route('admin.importers')->with('success', 'New Importer Updated!');
        }
        else
        {
          return redirect()->route('admin.importers')->with('error', 'Something went wrong!');
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
        $importer = Importers::findOrFail($id);
        $importer->delete();
        return redirect()->route('admin.importers')->with('success', 'Importer Deleted!');
    }
}
