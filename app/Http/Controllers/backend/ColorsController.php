<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Colors;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class ColorsController extends Controller
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
        $colors = Colors::all();
        return view('backend.colors.index')->with('colors', $colors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.colors.create');
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
          'color_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $color = new Colors();
        $color->fill($request->all());

        if ($color->save())
        {
          return redirect()->route('admin.colors')->with('success', 'New Color Added!');
        }
        else
        {
          return redirect()->route('admin.colors')->with('error', 'Something went wrong!');
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
        $color = Colors::findOrFail($id);
        // dd($has_permissions);
        return view('backend.colors.edit',compact('color'));
        // return view('backend.colors.edit')->with('role', $role);
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
        $color_id = $request->input('color_id');
        $this->validate( $request, [
          'color_name' => ['required',],
        ]);
        // echo "string".$color_id;exit;
        // dd($request->all());
        // $color = new Colors();
        $color = Colors::findOrFail($color_id);
        $color->fill($request->all());
        //multicolor images 
        if(isset($color) && $color->color_type == 'multi')
        {
          if ($request->hasFile('color_code'))
          {
            $image = $request->file('color_code');
            $destinationPath = public_path('/backend-assets/uploads/color_code');
            if (!file_exists($destinationPath))
            {
              mkdir($destinationPath,0777);
            }
            if (is_array($image))
            {

            }
            else
            {
              $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
              $image->move($destinationPath, $name);

              $color->color_code = $name;
              // $color->save();
            }
          }
        }
        if ($color->update())
        {
          return redirect()->route('admin.colors')->with('success', 'New Color Updated!');
        }
        else
        {
          return redirect()->route('admin.colors')->with('error', 'Something went wrong!');
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
        $color = Colors::findOrFail($id);
        $color->delete();
        return redirect()->route('admin.colors')->with('success', 'Color Deleted!');
    }
}
