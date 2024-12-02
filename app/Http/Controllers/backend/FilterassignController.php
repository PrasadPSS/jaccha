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

class FilterassignController extends Controller
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
      $categories = Categories::where('visibility',1)->get();
      // $filterassign = FilterValues::Where('filter_id',$filter_id)->get();
      // dd($has_permissions);
      return view('backend.filterassign.index',compact('categories'));
    }

    public function firstlevel($id)
    {
      $filter_id = $id;
      $filter = Filters::findOrFail($filter_id);
      $filterassign = FilterValues::Where('filter_id',$filter_id)->get();
      // dd($has_permissions);
      return view('backend.filterassign.firstlevel',compact('filter_id','filter','filterassign'));
    }

    public function secondlevel($id)
    {
      $category_id = $id;
      $category = Categories::Where('category_id',$category_id)->first();
      $subcategories = SubCategories::Where('category_id',$category_id)->where('visibility',1)->get();
      // dd($has_permissions);
      return view('backend.filterassign.secondlevel',compact('category','subcategories'));
    }

    public function thirdlevel($subcategory_id)
    {
      $subsubcategories = SubSubCategories::Where('subcategory_id',$subcategory_id)->where('visibility',1)->get();
      $subcategory = SubCategories::Where('subcategory_id',$subcategory_id)->first();
      // echo "<pre>";print_r($subcategory_id);exit;
      return view('backend.filterassign.thirdlevel', compact('subsubcategories','subcategory_id','subcategory'));
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
      return view('backend.filterassign.create',compact('filter_id','filters','categories','sub_categories','sub_sub_categories'));
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

        if ($filtervalue->save())
        {
          // return redirect()->route('admin.filterassign.index'.$filtervalue->filter_id)->with('success', 'New Filter Value Added!');
          return redirect('admin/filterassign/index/'.$filtervalue->filter_id);
        }
        else
        {
          // return redirect()->route('admin.filterassign.index'.$filtervalue->filter_id)->with('error', 'Something went wrong!');
          return redirect('admin/filterassign/index/'.$filtervalue->filter_id);
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

      $categories = Categories::where('category_id',$id)->where('visibility',1)->first();
      $filters = Filters::where('category_id',$id)->where('visibility',1)->with('filtervalues')->get();
      $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$id,'filter_level'=>'first'])->first();
      $colors = Colors::pluck('color_name','color_code')->all();
        // dd($has_permissions);
      return view('backend.filterassign.first_level_edit',compact('filters','categories','assign_category_filters','colors'));
        // return view('backend.filterassign.edit')->with('role', $role);
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
        $this->validate( $request, [
          'category_id' => ['required',],
          // 'filter_id' => ['required',],
          // 'filter_id' => ['required',],
        ]);
        // echo "string".$filtervalue_id;exit;
        // dd($request->all());
        // $filtervalue = new FilterValues();
        $assign_category_filters = AssignCategoryFilters::updateOrCreate([
          'category_id'=>$category_id,
          'filter_level'=>'first'
        ],[
          'category_id' => $request->get('category_id'),
          'filter_level' => 'first',
          'filter_ids' => ($request->input('filter_ids'))?implode(',',$request->input('filter_ids')):NULL,
          'filter_value_ids' => ($request->input('filter_value_ids'))?implode(',',$request->input('filter_value_ids')):NULL,
        ]);

        // $role->filter_value_ids = ($request->input('submenu_id'))?implode(',',$request->input('submenu_id')):NULL;
        // $filtervalue->fill($request->all());
        // dd($assign_category_filters);
        if ($assign_category_filters)
        {
          return redirect('admin/filterassign/')->with('success','Filter Assigned');
        }
        else
        {
          return redirect('admin/filterassign/')->with('Something Went Wrong');
        }
    }

    public function second_level_edit($id,$sub_id)
    {

      $categories = SubCategories::where('category_id',$id)->where('subcategory_id',$sub_id)->where('visibility',1)->first();
      $filters = Filters::where('category_id',$id)->where('visibility',1)->with('filtervalues')->get();
      $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$id,'sub_category_id'=>$sub_id,'filter_level'=>'second'])->first();
      $colors = Colors::pluck('color_name','color_code')->all();
        // dd($has_permissions);
      return view('backend.filterassign.second_level_edit',compact('filters','categories','assign_category_filters','colors'));
        // return view('backend.filterassign.edit')->with('role', $role);
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
      $this->validate( $request, [
        'category_id' => ['required',],
        'sub_category_id' => ['required',],
        // 'filter_id' => ['required',],
        // 'filter_id' => ['required',],
      ]);
      // echo "string".$filtervalue_id;exit;
      // dd($request->all());
      // $filtervalue = new FilterValues();
      $assign_category_filters = AssignCategoryFilters::updateOrCreate([
        'category_id'=>$category_id,
        'sub_category_id'=>$sub_category_id,
        'filter_level'=>'second'
      ],[
        'category_id' => $request->get('category_id'),
        'sub_category_id' => $request->get('sub_category_id'),
        'filter_level' => 'second',
        'filter_ids' => ($request->input('filter_ids'))?implode(',',$request->input('filter_ids')):NULL,
        'filter_value_ids' => ($request->input('filter_value_ids'))?implode(',',$request->input('filter_value_ids')):NULL,
      ]);

      // $role->filter_value_ids = ($request->input('submenu_id'))?implode(',',$request->input('submenu_id')):NULL;
      // $filtervalue->fill($request->all());
      // dd($assign_category_filters);
      if ($assign_category_filters)
      {
        return redirect('admin/filterassign/secondlevel/'.$category_id)->with('success','Filter Assigned');
      }
      else
      {
        return redirect('admin/filterassign/secondlevel/'.$category_id)->with('Something Went Wrong');
      }
    }

    public function third_level_edit($id,$sub_id,$sub_sub_id)
    {

      $categories = SubSubCategories::where('category_id',$id)->where('subcategory_id',$sub_id)->where('sub_subcategory_id',$sub_sub_id)->where('visibility',1)->first();
      $filters = Filters::where('category_id',$id)->where('visibility',1)->with('filtervalues')->get();
      $assign_category_filters = AssignCategoryFilters::where(['category_id'=>$id,'sub_category_id'=>$sub_id,'sub_sub_category_id'=>$sub_sub_id,'filter_level'=>'third'])->first();
      $colors = Colors::pluck('color_name','color_code')->all();
        // dd($has_permissions);
      return view('backend.filterassign.third_level_edit',compact('filters','categories','assign_category_filters','colors'));
        // return view('backend.filterassign.edit')->with('role', $role);
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
      $this->validate( $request, [
        'category_id' => ['required',],
        'sub_category_id' => ['required',],
        'sub_sub_category_id' => ['required',],
        // 'filter_id' => ['required',],
        // 'filter_id' => ['required',],
      ]);
      // echo "string".$filtervalue_id;exit;
      // dd($request->all());
      // $filtervalue = new FilterValues();
      $assign_category_filters = AssignCategoryFilters::updateOrCreate([
        'category_id'=>$category_id,
        'sub_category_id'=>$sub_category_id,
        'sub_sub_category_id'=>$sub_sub_category_id,
        'filter_level'=>'third'
      ],[
        'category_id' => $request->get('category_id'),
        'sub_category_id' => $request->get('sub_category_id'),
        'sub_sub_category_id' => $request->get('sub_sub_category_id'),
        'filter_level' => 'third',
        'filter_ids' => ($request->input('filter_ids'))?implode(',',$request->input('filter_ids')):NULL,
        'filter_value_ids' => ($request->input('filter_value_ids'))?implode(',',$request->input('filter_value_ids')):NULL,
      ]);

      // $role->filter_value_ids = ($request->input('submenu_id'))?implode(',',$request->input('submenu_id')):NULL;
      // $filtervalue->fill($request->all());
      // dd($assign_category_filters);
      if ($assign_category_filters)
      {
        return redirect('admin/filterassign/thirdlevel/'.$sub_category_id)->with('success','Filter Assigned');
      }
      else
      {
        return redirect('admin/filterassign/thirdlevel/'.$sub_category_id)->with('Something Went Wrong');
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
        // return redirect()->route('admin.filterassign')->with('success', 'Filter Value Deleted!');
        return redirect('admin/filterassign/index/'.$filtervalue->filter_id);
    }

    public function filtervaluevalues($filtervalue_id)
    {
      $filtervalue = FilterValues::findOrFail($filtervalue_id);
      $filtervaluevalues = FilterValueValues::Where('filtervalue_id',$filtervalue_id)->get();
      // dd($has_permissions);
      return view('backend.filterassign.filtervaluevalues',compact('filtervalue_id','filtervalue','filtervaluevalues'));
      // return view('backend.filterassign.edit')->with('role', $role);
    }
}
