<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Filters;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubSubCategories;
use App\Models\backend\FilterValues;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class
use App\Models\backend\AssignCategoryFilters;
use App\Models\backend\Colors;
use App\Models\backend\Productlist;

class ProductlistingController extends Controller
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
    // $filter_id = $id;
    // $filter = Filters::findOrFail($filter_id);
    $categories = Categories::where('visibility', 1)->get();
    // $filterassign = FilterValues::Where('filter_id',$filter_id)->get();
    // dd($has_permissions);
    return view('backend.productlisting.index', compact('categories'));
  }

  public function firstlevel($id)
  {

    $filter_id = $id;
    $filter = Filters::findOrFail($filter_id);
    $filterassign = FilterValues::Where('filter_id', $filter_id)->get();
    // dd($has_permissions);
    return view('backend.productlisting.firstlevel', compact('filter_id', 'filter', 'filterassign'));
  }

  public function secondlevel($id)
  {

    $category_id = $id;
    $category = Categories::Where('category_id', $category_id)->first();
    $subcategories = SubCategories::Where('category_id', $category_id)->where('visibility', 1)->get();
    // dd($has_permissions);
    return view('backend.productlisting.secondlevel', compact('category', 'subcategories'));
  }

  public function thirdlevel($subcategory_id)
  {
    $subsubcategories = SubSubCategories::Where('subcategory_id', $subcategory_id)->where('visibility', 1)->get();
    $subcategory = SubCategories::Where('subcategory_id', $subcategory_id)->first();
    // echo "<pre>";print_r($subcategory_id);exit;
    return view('backend.productlisting.thirdlevel', compact('subsubcategories', 'subcategory_id', 'subcategory'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $filter_id = $id;
    $filters = Filters::get();
    $filter_list = collect($filters)->mapWithKeys(function ($item, $key) {
      return [$item['filter_id'] => $item['filter_name']];
    });
    $categories = Categories::all();
    $categories = collect($categories)->mapWithKeys(function ($item, $key) {
      return [$item['category_id'] => $item['category_name']];
    });
    $sub_categories = [];
    $sub_sub_categories = [];
    return view('backend.productlisting.create', compact('filter_id', 'filters', 'categories', 'sub_categories', 'sub_sub_categories'));
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
      'filter_value' => ['required',],
      'filter_id' => ['required',],
    ]);
    // echo "string";exit;
    // dd($request->all());
    $filtervalue = new FilterValues();
    $filtervalue->fill($request->all());
    // dd($filtervalue);

    if ($filtervalue->save()) {
      // return redirect()->route('admin.productlisting.index'.$filtervalue->filter_id)->with('success', 'New Filter Value Added!');
      return redirect('admin/productlisting/index/' . $filtervalue->filter_id);
    } else {
      // return redirect()->route('admin.productlisting.index'.$filtervalue->filter_id)->with('error', 'Something went wrong!');
      return redirect('admin/productlisting/index/' . $filtervalue->filter_id);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function first_level_edit($id)
  {


    $categories = Categories::where('category_id', $id)->where('visibility', 1)->first();
    $filters = Productlist::where('category_id', $id)->first();
    $assign_category_filters = AssignCategoryFilters::where(['category_id' => $id, 'filter_level' => 'first'])->first();
    $colors = Colors::pluck('color_name', 'color_code')->all();
    // dd($filters->toArray());
    return view('backend.productlisting.first_level_edit', compact('filters', 'categories', 'assign_category_filters', 'colors'));
    // return view('backend.productlisting.edit')->with('role', $role);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function first_level_update(Request $request)
  {
    $category_id = $request->input('category_id');
    // echo $category_id;die;
    $this->validate($request, [
      'content_date' => 'required',
      'contents' => 'required',
    ]);
    // echo "<pre>";print_r($request->all());die;
    $model = new Productlist;
    $data =  Productlist::where(["category_id"=> $category_id,'sub_category_id'=>null,'sub_sub_category_id'=>null])->first();
    

  
    if(empty($data)){
      $model->fill($request->all());
      $updated = $model->save();
    }else{
     $updated = Productlist::where(["category_id"=> $category_id,'sub_category_id'=>null,'sub_sub_category_id'=>null])->update($request->all());
    }
 

    if ($updated) {
      return redirect('admin/productlisting/')->with('success', 'Filter Assigned');
    } else {
      return redirect('admin/productlisting/')->with('Something Went Wrong');
    }
  }

  public function second_level_edit($id, $sub_id)
  {

    $categories = SubCategories::where('category_id', $id)->where('subcategory_id', $sub_id)->where('visibility', 1)->first();
    $filters = Productlist::where(['category_id'=> $id,'sub_category_id'=>$sub_id])->first();
    $assign_category_filters = AssignCategoryFilters::where(['category_id' => $id, 'sub_category_id' => $sub_id, 'filter_level' => 'second'])->first();
    $colors = Colors::pluck('color_name', 'color_code')->all();
//  dd($filters->toArray());
    return view('backend.productlisting.second_level_edit', compact('filters', 'categories', 'assign_category_filters', 'colors'));
    // return view('backend.productlisting.edit')->with('role', $role);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function second_level_update(Request $request)
  {
    $category_id = $request->input('category_id');
    $sub_category_id = $request->input('sub_category_id');
    $this->validate($request, [
      'content_date' => 'required',
      'contents' => 'required',
    ]);

    // dd($category_id,$sub_category_id);
    // dd($request->all());

    $model = new Productlist;
    $data =  Productlist::where(['category_id'=>$category_id,'sub_category_id'=>$sub_category_id,'sub_sub_category_id'=>null])->first();

    // dd($data);
  
    if(empty($data)){
      $model->fill($request->all());
      $updated = $model->save();
    }else{
     $updated = Productlist::where(['category_id'=>$category_id,'sub_category_id'=>$sub_category_id,'sub_sub_category_id'=>null])->update($request->all());
    }


    if ($updated) {
      return redirect('admin/productlisting/secondlevel/' . $category_id)->with('success', 'Filter Assigned');
    } else {
      return redirect('admin/productlisting/secondlevel/' . $category_id)->with('Something Went Wrong');
    }
  }

  public function third_level_edit($id, $sub_id, $sub_sub_id)
  {

    $categories = SubSubCategories::where('category_id', $id)->where('subcategory_id', $sub_id)->where('sub_subcategory_id', $sub_sub_id)->where('visibility', 1)->first();
    $filters = Productlist::where(['category_id'=>$id,'sub_category_id'=>$sub_id,'sub_sub_category_id'=>$sub_sub_id])->first();
    $assign_category_filters = AssignCategoryFilters::where(['category_id' => $id, 'sub_category_id' => $sub_id, 'sub_sub_category_id' => $sub_sub_id, 'filter_level' => 'third'])->first();
    $colors = Colors::pluck('color_name', 'color_code')->all();
    // dd($has_permissions);
    return view('backend.productlisting.third_level_edit', compact('filters', 'categories', 'assign_category_filters', 'colors'));
    // return view('backend.productlisting.edit')->with('role', $role);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function third_level_update(Request $request)
  {
    $category_id = $request->input('category_id');
    $sub_category_id = $request->input('sub_category_id');
    $sub_sub_category_id = $request->input('sub_sub_category_id');

    $this->validate($request, [
      'content_date' => 'required',
      'contents' => 'required',
    ]);

    // dd($category_id,$sub_category_id);
    // dd($request->all());

    $model = new Productlist;
    $data =  Productlist::where(['category_id'=>$category_id,'sub_category_id'=>$sub_category_id,'sub_sub_category_id'=>$sub_sub_category_id])->first();

    // dd($data);
  
    if(empty($data)){
      $model->fill($request->all());
      $updated = $model->save();
    }else{
     $updated = Productlist::where(['category_id'=>$category_id,'sub_category_id'=>$sub_category_id,'sub_sub_category_id'=>$sub_sub_category_id])->update($request->all());
    }

    if ($updated) {
      return redirect('admin/productlisting/thirdlevel/' . $sub_category_id)->with('success', 'Filter Assigned');
    } else {
      return redirect('admin/productlisting/thirdlevel/' . $sub_category_id)->with('Something Went Wrong');
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
    $filtervalue = FilterValues::findOrFail($id);
    $filtervalue->delete();
    // return redirect()->route('admin.productlisting')->with('success', 'Filter Value Deleted!');
    return redirect('admin/productlisting/index/' . $filtervalue->filter_id);
  }

  public function filtervaluevalues($filtervalue_id)
  {
    $filtervalue = FilterValues::findOrFail($filtervalue_id);
    $filtervaluevalues = FilterValueValues::Where('filtervalue_id', $filtervalue_id)->get();
    // dd($has_permissions);
    return view('backend.productlisting.filtervaluevalues', compact('filtervalue_id', 'filtervalue', 'filtervaluevalues'));
    // return view('backend.productlisting.edit')->with('role', $role);
  }
}
