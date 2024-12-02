<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubSubCategories;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SubsubcategoriesController extends Controller
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
        $subsubcategories = SubSubCategories::all();
        return view('backend.subsubcategories.index', compact('subsubcategories'));
    }

    public function subcategory($category_id,$subcategory_id)
    {
      $subsubcategories = SubSubCategories::Where('subcategory_id',$subcategory_id)->get();
      $subcategory = SubCategories::Where('subcategory_id',$subcategory_id)->first();
      // echo "<pre>";print_r($subcategory_id);exit;
      return view('backend.subsubcategories.index', compact('subsubcategories','subcategory_id','subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($category_id=null,$subcategory_id=null)
    {
      $categories = Categories::all();
      $category_list = collect($categories)->mapWithKeys(function ($item, $key) {
          return [$item['category_id'] => $item['category_name']];
        });
      return view('backend.subsubcategories.create', compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'sub_subcategory_name' => ['required'],
        'sub_subcategory_description' => ['required'],
        'category_id' => ['required'],
        'subcategory_id' => ['required'],
      ]);
      $subsubcategories = new SubSubCategories();

        if($subsubcategories->fill($request->all())->save())
        {
          // $cat = SubCategories::Where('category_id',$category->category_id)->first();
          // $cat->category_slug = str_slug($category->category_name );
          // $cat->save();
          Session::flash('success', 'Sub Category added!');
          Session::flash('status', 'success');

          return redirect('admin/subsubcategories/subcategory/'.$subsubcategories->category_id.'/'.$subsubcategories->subcategory_id);
        }


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
        $subsubcategories = SubSubCategories::findOrFail($id);

        return view('backend.subsubcategories.show', compact('subsubcategories'));
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
      $categories = Categories::all();
      $category_list = collect($categories)->mapWithKeys(function ($item, $key) {
          return [$item['category_id'] => $item['category_name']];
        });
      $subsubcategories = SubSubCategories::findOrFail($id);
      return view('backend.subsubcategories.edit', compact('subsubcategories','category_list'));
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
        'sub_subcategory_name' => ['required'],
        'sub_subcategory_description' => ['required'],
        'category_id' => ['required'],
        'subcategory_id' => ['required'],
      ]);
      $id = $request->input('sub_subcategory_id');
      $subsubcategories = SubSubCategories::findOrFail($id);
      if($subsubcategories->update($request->all()))
      {
        // $cat = SubCategories::Where('category_id',$subsubcategories->category_id)->first();
        // $cat->category_slug = str_slug($subsubcategories->category_name );
        // $cat->save();
        Session::flash('success', 'Sub Category updated!');
        Session::flash('status', 'success');

        return redirect('admin/subsubcategories/subcategory/'.$subsubcategories->category_id.'/'.$subsubcategories->subcategory_id);
      }
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
        $subsubcategories = SubSubCategories::findOrFail($id);

        $subsubcategories->delete();

        Session::flash('message', 'Sub Category deleted!');
        Session::flash('status', 'success');

        return redirect('admin/subsubcategories/subcategory/'.$subsubcategories->category_id.'/'.$subsubcategories->subcategory_id);
    }
    public function getsubcategory(Request $request)
    {
      $data = $request->all();
      $subcategory = SubCategories::where('category_id',$data['category_id'])->get();
      $subcategory_list = collect($subcategory)->mapWithKeys(function ($item, $key) {
          return [$item['subcategory_id'] => $item['subcategory_name']];
        });
      foreach ($subcategory as $key => $value)
      {
        echo "<option value='".$value['subcategory_id']."'>".$value['subcategory_name']."</option>";
      }
      // return $subcategory_list;
    }
}
