<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\SizeCharts;
use App\Models\backend\SizeChartChilds;
use App\Models\backend\Sizes;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class SizechartsController extends Controller
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
        $sizecharts = SizeCharts::all();
        return view('backend.sizecharts.index',compact('sizecharts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $sizes = Sizes::all();
      $sizes = collect($sizes)->mapWithKeys(function ($item, $key) {
        return [$item['size_id'] => $item['size_name']];
      });
      return view('backend.sizecharts.create',compact('sizes'));
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
          'size_chart_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $size_chart = new SizeCharts();
        $size_chart->fill($request->all());
        $size_chart->size_ids = isset($request->size_ids)?implode(',',$request->size_ids):'';
        // dd($size_chart);
        if ($request->hasFile('size_chart_image'))
        {
          $image = $request->file('size_chart_image');
          $destinationPath = public_path('/backend-assets/uploads/size_chart_images');
          if (!file_exists($destinationPath))
          {
            mkdir($destinationPath,0777);
          }
          $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath, $name);
          $size_chart->size_chart_image = $name;
        }
        if ($size_chart->save())
        {
          return redirect('admin/sizecharts')->with('success', 'New Size Chart Added!');
        }
        else
        {
          return redirect('admin/sizecharts')->with('error', 'Something went wrong!');
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
        $size_chart = SizeCharts::findOrFail($id);
        $sizes = Sizes::where('size_type',$size_chart->size_type)->get();
        $sizes = collect($sizes)->mapWithKeys(function ($item, $key) {
          return [$item['size_id'] => $item['size_name']];
        });
        // dd($has_permissions);
        return view('backend.sizecharts.edit',compact('size_chart','sizes'));
        // return view('backend.sizecharts.edit')->with('role', $role);
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
        $size_chart_id = $request->input('size_chart_id');
        $this->validate( $request, [
          'size_chart_name' => ['required',],
        ]);
        // echo "string".$size_chart_id;exit;
        // dd($request->all());
        // $size_chart = new SizeCharts();
        $size_chart = SizeCharts::findOrFail($size_chart_id);
        $size_chart_image_name = $size_chart->size_chart_image;
        $size_chart->fill($request->all());
        $size_chart->size_ids = isset($request->size_ids)?implode(',',$request->size_ids):'';
        // dd($size_chart);
        if ($request->hasFile('size_chart_image'))
        {
          $image = $request->file('size_chart_image');
          $destinationPath = public_path('/backend-assets/uploads/size_chart_images');
          if (!file_exists($destinationPath))
          {
            mkdir($destinationPath,0777);
          }
          $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath, $name);
          $size_chart->size_chart_image = $name;
        }
        else
        {
          $size_chart->size_chart_image = $size_chart_image_name;
        }
        if ($size_chart->update())
        {
          // dd($size_chart);
          return redirect('admin/sizecharts');
        }
        else
        {
          return redirect('admin/sizecharts');
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
        $size_chart = SizeCharts::findOrFail($id);
        $size_chart->delete();
        return redirect('admin/sizecharts')->with('success', 'Size Chart Deleted!');
    }

    public function getsizes(Request $request)
    {
      $data = $request->all();
      $sizes = Sizes::where('size_type',$data['size_type'])->get();
      // $sizes_list = collect($sizes)->mapWithKeys(function ($item, $key) {
      //     return [$item['sizes_id'] => $item['sizes_name']];
      //   });
      $options = "<option value=''>Please Select</option>";

      foreach ($sizes as $key => $value)
      {
        $options .= "<option value='".$value['size_id']."'>".$value['size_name']."</option>";
      }
      if (count($sizes)==0)
      {
        $options .= "<option value=''>No Record Found</option>";
      }
      return $options;
      // return $subcategory_list;
    }

    public function getsizechartchilds(Request $request)
    {
      $data = $request->all();
      $sizes = Sizes::whereIn('size_id',$data['size_ids'])->get();

      $size_chart = '';
      if ($data['size_type']=='upper')
      {
        $childs_cnt = 0;
        if (isset($data['size_ids']) && $data['size_ids'] != '')
        {
          $sizes = Sizes::whereIn('size_id',$data['size_ids'])->get();
        }

        if (isset($data['size_id']) && $data['size_id'] != '' && !empty($sizes))
        {
          foreach ($sizes as $size)
          {
            $size_chart .= '<tr data-repeater-item>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_sku]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'-'.$size->size_id.'" required>';
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_title]" class="form-control" value="" required>';
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="hidden" name="variants['.$childs_cnt.'][color_id]" value="'.$color->color_id.'">';
            $size_chart .= $color->color_name;
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="hidden" name="variants['.$childs_cnt.'][size_id]" value="'.$size->size_id.'">';
            $size_chart .= $size->size_name;
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_qty]" class="form-control" value="" required>';
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<select class="select2 form-control" name="variants['.$childs_cnt.'][visibility]"> required';
            $size_chart .= '<option value="1" >Enabled</option>';
            $size_chart .= '<option value="0" >Disabled</option>';
            $size_chart .= '</select>';
            $size_chart .= '</td>';
            $size_chart .= '<td>';
            $size_chart .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
            $size_chart .= '</td>';
            $size_chart .= '</tr>';

            $childs_cnt++;
          }
        }
        else
        {
          $size_chart .= '<tr data-repeater-item>';
          $size_chart .= '<td>';
          $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_sku]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'" required>';
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_title]" class="form-control" value="" required>';
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<input type="hidden" name="variants['.$childs_cnt.'][color_id]" value="'.$color->color_id.'">';
          $size_chart .= $color->color_name;
          $size_chart .= '</td>';
          $size_chart .= '<td>-';
          $size_chart .= '<input type="hidden" name="variants['.$childs_cnt.'][size_id]" value="">';
          // $size_chart .= $size->size_name;
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_qty]" class="form-control" value="" required>';
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<input type="text" name="variants['.$childs_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<select class="select2 form-control" name="variants['.$childs_cnt.'][visibility]"> required';
          $size_chart .= '<option value="1" >Enabled</option>';
          $size_chart .= '<option value="0" >Disabled</option>';
          $size_chart .= '</select>';
          $size_chart .= '</td>';
          $size_chart .= '<td>';
          $size_chart .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
          $size_chart .= '</td>';
          $size_chart .= '</tr>';

          $childs_cnt++;
        }

      }
      return $size_chart;
    }
}
