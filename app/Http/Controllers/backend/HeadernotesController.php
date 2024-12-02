<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\HeaderNotes;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class HeadernotesController extends Controller
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
        $header_notes = HeaderNotes::all();
        return view('backend.headernotes.index')->with('header_notes', $header_notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.headernotes.create');
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
          'header_note_name' => ['required',],
          'header_note_text' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $header_note = new HeaderNotes();
        $header_note->fill($request->all());

        if ($header_note->save())
        {
          return redirect()->route('admin.headernotes')->with('success', 'New Header Note Added!');
        }
        else
        {
          return redirect()->route('admin.headernotes')->with('error', 'Something went wrong!');
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
        $header_note = HeaderNotes::findOrFail($id);
        // dd($has_permissions);
        return view('backend.headernotes.edit',compact('header_note'));
        // return view('backend.headernotes.edit')->with('role', $role);
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
        $header_note_id = $request->input('header_note_id');
        $this->validate( $request, [
          'header_note_name' => ['required',],
          'header_note_text' => ['required',],
        ]);
        // echo "string".$header_note_id;exit;
        // dd($request->all());
        // $header_note = new HeaderNotes();
        $header_note = HeaderNotes::findOrFail($header_note_id);
        $header_note->fill($request->all());

        if ($header_note->update())
        {
          return redirect()->route('admin.headernotes')->with('success', 'New Header Note Updated!');
        }
        else
        {
          return redirect()->route('admin.headernotes')->with('error', 'Something went wrong!');
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
        $header_note = HeaderNotes::findOrFail($id);
        $header_note->delete();
        return redirect()->route('admin.headernotes')->with('success', 'Header Note Deleted!');
    }
}
