<?php

namespace App\Http\Controllers\backend;

use App\Models\backend\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Session;

class PublicationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $publications = Publication::all();

        return view('backend.publications.index', compact('publications'));
    }

    public function create()
    {
      return view('backend.publications.create');
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
          'publications_title' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $publication = new Publication();
        $publication->fill($request->all());

        if ($publication->save())
        {
          return redirect()->route('admin.publications')->with('success', 'New Publication Added!');
        }
        else
        {
          return redirect()->route('admin.publications')->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $publication = Publication::where('publications_id',$id)->first();

        return view('backend.publications.edit', compact('publication'));
    }

    public function view()
    {
        $cmspage = Cmspages::findOrFail($id);
    }


    public function update(Request $request)
    {

      $this->validate(request(), [
          'publications_title' => 'required',
      ]);
      $id = $request->publications_id ;
      $publications = Publication::findOrFail($id);
      $publications->publication_slug = null;
      $publications->update($request->all());

      Session::flash('message', 'Publication Updated!');
      Session::flash('status', 'success');

      return redirect('admin/publications');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    
    public function destroy($id)
    {
        $cmspages = Publication::findOrFail($id);
        $cmspages->delete();
        return redirect()->route('admin.publications')->with('success', 'CMS page Deleted!');
    }
}
