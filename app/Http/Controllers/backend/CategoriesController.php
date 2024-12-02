<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\Categories;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
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
        $categories = Categories::all();

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'category_name' => ['required'],
        'category_description' => ['required'],
      ]);

      $categories = new Categories();
      $categories->fill($request->all());
      if ($request->hasFile('category_banner_image'))
      {
        $image = $request->file('category_banner_image');
        $destinationPath = public_path('/category_images');
        if (!file_exists($destinationPath))
        {
          mkdir($destinationPath,0777);
        }
        $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $name);
        $categories->category_banner_image = $name;
      }

      if($categories->save())
      {
        // $cat = Categories::Where('category_id',$category->category_id)->first();
        // $cat->category_slug = str_slug($category->category_name );
        // $cat->save();
      }

        Session::flash('message', 'Category added!');
        Session::flash('status', 'success');

        return redirect('admin/categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categories = Categories::findOrFail($id);

        return view('backend.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categories = Categories::findOrFail($id);
        return view('backend.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request)
    {
      $this->validate($request, [
        'category_name' => ['required'],
        'category_description' => ['required'],
      ]);
      $id = $request->input('category_id');
      $categories = Categories::findOrFail($id);
      $categories->fill($request->all());
      if ($request->hasFile('category_banner_image'))
      {
        $image = $request->file('category_banner_image');
        $destinationPath = public_path('/category_images');
        if (!file_exists($destinationPath))
        {
          mkdir($destinationPath,0777);
        }
        $name = time().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $name);
        $categories->category_banner_image = $name;
      }
      if($categories->update())
      {
        // $cat = Categories::Where('category_id',$categories->category_id)->first();
        // $cat->category_slug = str_slug($categories->category_name );
        // $cat->save();
      }
      Session::flash('message', 'Category updated!');
      Session::flash('status', 'success');

      return redirect('admin/categories');
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
        $categories = Categories::findOrFail($id);

        $categories->delete();

        Session::flash('message', 'Category deleted!');
        Session::flash('status', 'success');

        return redirect('admin/categories');
    }

}
