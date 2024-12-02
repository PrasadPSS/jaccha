<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Filters;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubSubCategories;
use App\Models\backend\FilterValues;
use App\Models\backend\Colors;
use App\Models\backend\Sizes;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\backend\Materials;

class FiltervaluesController extends Controller
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
    public function index($id)
    {
      $filter_id = $id;
      $filter = Filters::findOrFail($filter_id);
      $filtervalues = FilterValues::Where('filter_id',$filter_id)->get();
      $filter_type = ($filter->filter_type)?$filter->filter_type:'default';
      $colors = [];
      if ($filter_type=='color')
      {
        $colors = Colors::pluck('color_name','color_code')->all();
        // $color_types = Colors::pluck('color_','color_code')->all();
      }
      $category_id = isset($filter)?$filter->category_id:'';
      // foreach($filtervalues as $filtervalue)
      // {
      //   if ($filter_type=='size')
      //   {
      //     $sizes = Sizes::where('size_name',$filtervalue->filter_value)->first();
      //     $filtervalue->reference_id = isset($sizes->size_id)?$sizes->size_id:0;
      //   }
      //   if ($filter_type=='color')
      //   {
      //     $colors = Colors::where('color_code',$filtervalue->filter_value)->first();
      //     $filtervalue->reference_id = isset($colors->color_id)?$colors->color_id:0;
      //     $filtervalue->reference_data = isset($colors->color_type)?$colors->color_type:'hex';
      //   }
      //   if ($filter_type=='material')
      //   {
      //     $materials = Materials::where('material_name',$filtervalue->filter_value)->first();
      //     $filtervalue->reference_id = isset($materials->material_id)?$materials->material_id:0;
      //   }
      //   $filtervalue->filter_type = $filter_type;

      //   $filtervalue->update();
      // }
      // dd($colors);
      return view('backend.filtervalues.index',compact('filter_id','filter','filtervalues','colors','filter_type','category_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $filter_id = $id;
      $filter = Filters::where('filter_id',$filter_id)->first();
      $sizes = [];
      $colors = [];
      $materials = [];
      $filter_type = ($filter->filter_type)?$filter->filter_type:'default';
      if ($filter_type=='size')
      {
        $sizes = Sizes::pluck('size_name','size_name')->all();
      }
      if ($filter_type=='color')
      {
        $colors = Colors::pluck('color_name','color_code')->all();
      }
      if ($filter_type=='material')
      {
        $materials = Materials::pluck('material_name','material_name')->all();
      }
      return view('backend.filtervalues.create',compact('filter_id','filter','sizes','colors','filter_type','materials'));
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
        $filter = Filters::where('filter_id',$filtervalue->filter_id)->first();
        $filter_type = ($filter->filter_type)?$filter->filter_type:'default';
        //to get the reference ids of filter values
        if ($filter_type=='size')
        {
          $sizes = Sizes::where('size_name',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($sizes->size_id)?$sizes->size_id:0;
        }
        if ($filter_type=='color')
        {
          $colors = Colors::where('color_code',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($colors->color_id)?$colors->color_id:0;
          $filtervalue->reference_data = isset($colors->color_type)?$colors->color_type:'hex';
        }
        if ($filter_type=='material')
        {
          $materials = Materials::where('material_name',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($materials->material_id)?$materials->material_id:0;
        }
        $filtervalue->filter_type = $filter_type;

        if ($filtervalue->save())
        {
          if ($filter_type=='color')
          {
            if(isset($colors->color_type) && $colors->color_type=='multi')
            {
              $filtervalue->filter_value_slug = 'multi-'.$filtervalue->filter_value_id;
            }
          }
          // return redirect()->route('admin.filtervalues.index'.$filtervalue->filter_id)->with('success', 'New Filter Value Added!');
          return redirect('admin/filtervalues/index/'.$filtervalue->filter_id)->with('success', 'New Filter Value Added!');
        }
        else
        {
          // return redirect()->route('admin.filtervalues.index'.$filtervalue->filter_id)->with('error', 'Something went wrong!');
          return redirect('admin/filtervalues/index/'.$filtervalue->filter_id)->with('error', 'Something went wrong!');
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
        $filter_value = FilterValues::findOrFail($id);
        $filter = Filters::where('filter_id',$filter_value->filter_id)->first();
        $sizes = [];
        $colors = [];
        $materials = [];
        $filter_type = ($filter->filter_type)?$filter->filter_type:'default';
        if ($filter_type=='size')
        {
          $sizes = Sizes::pluck('size_name','size_name')->all();
        }
        if ($filter_type=='color')
        {
          $colors = Colors::pluck('color_name','color_code')->all();
        }
          if ($filter_type=='material')
          {
            $materials = Materials::pluck('material_name','material_name')->all();
          }
        // dd($has_permissions);
        return view('backend.filtervalues.edit',compact('filter_value','sizes','colors','filter_type','materials'));
        // return view('backend.filtervalues.edit')->with('role', $role);
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
        $filtervalue_id = $request->input('filter_value_id');
        $this->validate( $request, [
          'filter_value' => ['required',],
          'filter_id' => ['required',],
        ]);
        // echo "string".$filtervalue_id;exit;
        // dd($request->all());
        // $filtervalue = new FilterValues();
        $filtervalue = FilterValues::findOrFail($filtervalue_id);
        $filtervalue->fill($request->all());

        $filter = Filters::where('filter_id',$filtervalue->filter_id)->first();
        $filter_type = ($filter->filter_type)?$filter->filter_type:'default';
        //to get the reference ids of filter values
        if ($filter_type=='size')
        {
          $sizes = Sizes::where('size_name',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($sizes->size_id)?$sizes->size_id:0;
        }
        if ($filter_type=='color')
        {
          $colors = Colors::where('color_code',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($colors->color_id)?$colors->color_id:0;
          $filtervalue->reference_data = isset($colors->color_type)?$colors->color_type:'hex';
          if(isset($colors->color_type) && $colors->color_type=='multi')
          {
            $filtervalue->filter_value_slug = 'multi-'.$filtervalue_id;
          }
        }
        if ($filter_type=='material')
        {
          $materials = Materials::where('material_name',$filtervalue->filter_value)->first();
          $filtervalue->reference_id = isset($materials->material_id)?$materials->material_id:0;
        }
        $filtervalue->filter_type = $filter_type;

        if ($filtervalue->update())
        {
          return redirect('admin/filtervalues/index/'.$filtervalue->filter_id)->with('success', 'New Filter Value Updated!');
        }
        else
        {
          return redirect('admin/filtervalues/index/'.$filtervalue->filter_id)->with('error', 'Something went wrong!');
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
        // return redirect()->route('admin.filtervalues')->with('success', 'Filter Value Deleted!');
        return redirect('admin/filtervalues/index/'.$filtervalue->filter_id);
    }

    public function filtervaluevalues($filtervalue_id)
    {
      $filtervalue = FilterValues::findOrFail($filtervalue_id);
      $filtervaluevalues = FilterValueValues::Where('filtervalue_id',$filtervalue_id)->get();
      // dd($has_permissions);
      return view('backend.filtervalues.filtervaluevalues',compact('filtervalue_id','filtervalue','filtervaluevalues'));
      // return view('backend.filtervalues.edit')->with('role', $role);
    }
}
