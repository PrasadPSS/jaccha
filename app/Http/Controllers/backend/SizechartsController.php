<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\SizeCharts;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\Countries;
use App\Models\backend\Sellers;
use App\Models\backend\Manufacturers;
use App\Models\backend\Packers;
use App\Models\backend\Importers;
use App\Models\backend\SubSubCategories;
use App\Models\backend\SizeChartImages;
use App\Models\backend\Filters;
use App\Models\backend\FilterValues;
use App\Models\backend\ProductFilters;
use App\Models\backend\Colors;
use App\Models\backend\Sizes;
use App\Models\backend\SizeChartChilds;
use App\Models\backend\SizeChartTypes;
use App\Models\backend\SizeChartFields;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Gd\Imagine;


class SizechartsController extends Controller
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
        $sizecharts = SizeCharts::with('size_chart_type')->get();
        // dd($sizecharts);
        return view('backend.sizecharts.index', compact('sizecharts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $sizes = Sizes::all();
      $sizes = collect($sizes)->mapWithKeys(function ($item, $key) {
        return [$item['size_id'] => $item['size_name']];
      });
      $size_chart_types = SizeChartTypes::get();
      $size_chart_type_list = collect($size_chart_types)->mapWithKeys(function ($item, $key) {
        return [$item['size_chart_type_id'] => $item['size_chart_type_name']];
      });
      return view('backend.sizecharts.create', compact('sizes','size_chart_type_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'size_chart_name' => ['required'],
        'size_type' => ['required'],
        'size_ids' => ['required'],
      ]);

      $sizecharts = new SizeCharts();
      $sizecharts->fill($request->all());

      $sizecharts->size_ids = implode(',',$request->size_ids);

      // dd($sizecharts);
      if($sizecharts->save())
      {
        if ($request->hasFile('size_chart_images'))
        {
          $images = $request->file('size_chart_images');
          $destinationPath = public_path('/backend-assets/uploads/size_chart_images');
          if (!file_exists($destinationPath))
          {
            mkdir($destinationPath,0777);
          }
          foreach ($images as $image)
          {
            $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);

            // $img_width  = 700;
            // $img_height = 936;
            // $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
            // $img_size   = new Box($img_width, $img_height);
            // // $image->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");
            // $thumbnail = new Imagine();
            // $thumbnail->open("{$destinationPath}/{$name}")->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");

            $size_chart_images = new SizeChartImages();
            $size_chart_images->image_name = $name;
            $size_chart_images->size_chart_id = $sizecharts->size_chart_id;
            $size_chart_images->save();
          }
          // $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          // $image->move($destinationPath, $name);
          //
          // $size_chart_images = new SizeChartImages();
          // $size_chart_images->image_name = $name;
          // $size_chart_images->size_chart_id = $sizecharts->size_chart_id;
          // $size_chart_images->save();
        }


        if (isset($request->chartchilds))
        {
          $sizechartchilds = $request->chartchilds;
          // dd($sizechartchilds);
          foreach ($sizechartchilds as $childchart)
          {
            $childchart_sizecharts = new SizeChartChilds();
            $childchart_sizecharts->fill($childchart);
            $childchart_sizecharts->size_chart_id = $sizecharts->size_chart_id;
            $childchart_sizecharts->save();
            if ($childchart_sizecharts)
            {
              // dd($childchart_sizecharts);
            }
          }
        }

      }

        Session::flash('message', 'Product added!');
        Session::flash('status', 'success');

        return redirect('admin/sizecharts');

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
        $sizecharts = SizeCharts::findOrFail($id);
        $size_chart_types = SizeChartTypes::get();
        $size_chart_type_list = collect($size_chart_types)->mapWithKeys(function ($item, $key) {
          return [$item['size_chart_type_id'] => $item['size_chart_type_name']];
        });
        return view('backend.sizecharts.show', compact('sizecharts','size_chart_type_list'));
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
        $sizecharts = SizeCharts::findOrFail($id);

        $size_chart_images = SizeChartImages::where('size_chart_id',$id)->get();
        $size_chart_images = collect($size_chart_images)->mapWithKeys(function ($item, $key) {
          return [$item['size_chart_image_id'] => $item['image_name']];
        });
        // dd($size_chart_images);

        $sizes = Sizes::all();
        $sizes = collect($sizes)->mapWithKeys(function ($item, $key) {
          return [$item['size_id'] => $item['size_name']];
        });

        $sizechart_childs = SizeChartChilds::where('size_chart_id',$id)->with('size')->get();

        $size_chart_type_list = SizeChartTypes::get();
        $size_chart_type_list = collect($size_chart_type_list)->mapWithKeys(function ($item, $key) {
          return [$item['size_chart_type_id'] => $item['size_chart_type_name']];
        });
        $type_sort = [1,3,12,6,2,5,4,8,10,7,11,9,13];
        $sortedIds = implode(',', $type_sort);
        $size_chart_types = SizeChartTypes::leftJoin("size_chart_fields",\DB::raw("FIND_IN_SET(size_chart_fields.size_chart_field_id,size_chart_types.size_chart_field_id)"),">",\DB::raw("'0'"))
        ->where('size_chart_types.size_chart_type_id',$sizecharts->size_type)->orderByRaw("FIELD(size_chart_fields.size_chart_field_id, $sortedIds)")
        ->get([
            'size_chart_types.*', \DB::raw("size_chart_fields.*")
        ]);
        // dd($sizechart_childs);
        return view('backend.sizecharts.edit', compact('sizecharts','sizes','sizechart_childs','size_chart_images','size_chart_type_list','size_chart_types'));
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
        'size_chart_name' => ['required'],
        'size_type' => ['required'],
        'size_ids' => ['required'],
      ]);
      $id = $request->input('size_chart_id');
      $sizecharts = SizeCharts::findOrFail($id);
      $sizecharts->fill($request->all());
      $sizecharts->size_ids = implode(',',$request->size_ids);
      if ($request->hasFile('size_chart_images'))
      {
        $images = $request->file('size_chart_images');
        // dd($im/ages);
        $destinationPath = public_path('/backend-assets/uploads/size_chart_images');
        if (!file_exists($destinationPath))
        {
          mkdir($destinationPath,0777, true);
        }
        foreach ($images as $image)
        {
          $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath, $name);

          // $img_width  = 700;
          // $img_height = 936;
          // $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
          // $img_size   = new Box($img_width, $img_height);
          // // $image->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");
          // $thumbnail = new Imagine();
          // $thumbnail->open("{$destinationPath}/{$name}")->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");

          $size_chart_images = new SizeChartImages();
          $size_chart_images->image_name = $name;
          $size_chart_images->size_chart_id = $id;
          $size_chart_images->save();
        }
      }


      // dd($request->size_type);

      $sizechart_childs = SizeChartChilds::where('size_chart_id',$id)->get()->toArray();
        if (isset($request->chartchilds))
        {
          $sizechart_childs_ids = array_column($sizechart_childs, 'size_chart_child_id');
          $added_size_chart_childs_ids = array_column($request->chartchilds, 'size_chart_child_id');
          $update_result=array_diff($sizechart_childs_ids,$added_size_chart_childs_ids);
          if (count($update_result)>0)
          {
            SizeChartChilds::destroy($update_result);
          }
          $added_childs = $request->chartchilds;
          //while adding new value in size chart fields table add the same column name in size chart child table and add the fields in model
          foreach ($added_childs as $added_child)
          {
            // dd($added_child);
            if (isset($added_child['size_chart_child_id']))
            {
              $size_chart_child_id = $added_child['size_chart_child_id'];
              $added_child_sizecharts = SizeChartChilds::findOrFail($size_chart_child_id);
              if ($added_child_sizecharts)
              {
                $added_child_sizecharts->fill($added_child);
                $added_child_sizecharts->update();
              }
              else
              {
                $child_sizecharts = new SizeChartChilds();
                $child_sizecharts->fill($added_child);
                $child_sizecharts->size_chart_id = $sizecharts->size_chart_id;
                $child_sizecharts->save();
                dd($child_sizecharts);
              }
            }
            else
            {
              $child_sizecharts = new SizeChartChilds();
              $child_sizecharts->fill($added_child);
              $child_sizecharts->size_chart_id = $sizecharts->size_chart_id;
              $child_sizecharts->save();
              // dd($child_sizecharts);
            }
          }
        }
        else
        {
          if ($sizechart_childs)
          {
            $sizechart_childs->each->delete();
          }
        }


      if($sizecharts->update())
      {

      }
      Session::flash('message', 'Product updated!');
      Session::flash('status', 'success');

      return redirect('admin/sizecharts');
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
        $sizecharts = SizeCharts::findOrFail($id);
        $size_chart_images = SizeChartImages::where('size_chart_id',$id)->get();
        if ($size_chart_images)
        {
          $size_chart_images->each->delete();
        }
        $size_chart_variants = SizeChartChilds::where('size_chart_id',$id)->get();
        if ($size_chart_variants)
        {
          $size_chart_variants->each->delete();
        }
        $sizecharts->delete();

        Session::flash('message', 'Product deleted!');
        Session::flash('status', 'success');

        return redirect('admin/sizecharts');
    }

    public function getsubcategory(Request $request)
    {
      $data = $request->all();
      $subcategory = SubCategories::where('category_id',$data['category_id'])->get();
      // $subcategory_list = collect($subcategory)->mapWithKeys(function ($item, $key) {
      //     return [$item['subcategory_id'] => $item['subcategory_name']];
      //   });
      echo "<option value=''>Please Select</option>";

      foreach ($subcategory as $key => $value)
      {
        echo "<option value='".$value['subcategory_id']."'>".$value['subcategory_name']."</option>";
      }
      if (count($subcategory)==0)
      {
        echo "<option value=''>No Record Found</option>";
      }
      // return $subcategory_list;
    }

    public function getsubsubcategory(Request $request)
    {
      $data = $request->all();
      $subsubcategory = SubSubCategories::where('category_id',$data['category_id'])->where('subcategory_id',$data['subcategory_id'])->get();
      // $subsubcategory_list = collect($subsubcategory)->mapWithKeys(function ($item, $key) {
      //     return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
      //   });
      echo "<option value=''>Please Select</option>";
      foreach ($subsubcategory as $key => $value)
      {
        echo "<option value='".$value['sub_subcategory_id']."'>".$value['sub_subcategory_name']."</option>";
      }
      if (count($subsubcategory)==0)
      {
        echo "<option value=''>No Record Found</option>";
      }
    }

    public function getsizechartchilds(Request $request)
    {
      $data = $request->all();
      $sizes = Sizes::whereIn('size_id',$data['size_ids'])->get();
      $size_type = $data['size_type'];
      $added_childs = $data['added_childs'];
      // dd($data);
      $sizechartchilds = '';
      $child_flag = 'exist';
      $remove_child_ids = [];
      $sizechartchilds_cnt = 0;
      $child_params = array();
      parse_str($added_childs, $child_params);
      $added_flag = 'new_new';
      $sizechartheads = '';
      //query for fetching the data with comma separated values
      $type_sort = [1,3,12,6,2,5,4,8,10,7,11,9,13];
      $sortedIds = implode(',', $type_sort);
      $size_chart_types = SizeChartTypes::leftJoin("size_chart_fields",\DB::raw("FIND_IN_SET(size_chart_fields.size_chart_field_id,size_chart_types.size_chart_field_id)"),">",\DB::raw("'0'"))
      ->where('size_chart_types.size_chart_type_id',$size_type)->orderByRaw("FIELD(size_chart_fields.size_chart_field_id, $sortedIds)")
      ->get([
          'size_chart_types.*', \DB::raw("size_chart_fields.*")
      ]);
      
      // dd($size_chart_type);

      if (isset($child_params['chartchilds']) && count($child_params['chartchilds'])>0)
      {
        foreach ($child_params['chartchilds'] as $added_child)
        {
          // echo "<pre>";print_r($added_child);exit;
          if (in_array($added_child['size_id'], $data['size_ids']))
          {
            $added_flag = 'new_exist';
          }
          else {
            $remove_child_ids[] = $added_child['size_id'];
          }
        }
        $added_child_ids = array_column($child_params['chartchilds'], 'size_id');
        $add_new_ids=array_diff( $data['size_ids'],$added_child_ids);
        $sizes = Sizes::whereIn('size_id',$add_new_ids)->get();
        // $remove_child_ids = array_diff($added_child_ids,$add_new_ids);
        // $added_child_counts = array_column($child_params['chartchilds'], 'size_id');
        // $add_new_ids=array_diff( $data['size_ids'],$added_child_ids);
      }
      if (empty($child_params) && $added_flag == 'new_new')
      {
        $child_flag = 'new';
      }
      else
      {
        $child_flag = 'exist';
      }
        //header of table
        $sizechartheads .= '</tr>';
        $sizechartheads .= '<th>Size</th>';
        foreach ($size_chart_types as $size_chart_type)
        {
          $sizechartheads .= '<th>';
          $sizechartheads .= $size_chart_type->size_chart_field_name;
          $sizechartheads .= '</th>';
        }
        $sizechartheads .= '<th>Action</th>';
        $sizechartheads .= '</tr>';


        foreach ($sizes as $size)
        {
          $sizechartchilds .= '<tr data-repeater-item id="tr-'.$size->size_id.'">';
          $sizechartchilds .= '<td>';
          $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_id]" value="'.$size->size_id.'">';
          $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_type]" value="'.$size_type.'">';
          $sizechartchilds .= $size->size_name;
          $sizechartchilds .= '</td>';
          foreach ($size_chart_types as $size_chart_type)
          {
            $sizechartchilds .= '<td>';
            $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.']['.$size_chart_type->size_chart_field_code.']" class="form-control" value="" required>';
            $sizechartchilds .= '</td>';
          }
          $sizechartchilds .= '<td>';
          $sizechartchilds .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
          $sizechartchilds .= '</td>';
          $sizechartchilds .= '</tr>';
          // if ($size_type=='upper')
          // {
          //   $sizechartchilds .= '<tr data-repeater-item id="tr-'.$size->size_id.'">';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_id]" value="'.$size->size_id.'">';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_type]" value="'.$size_type.'">';
          //   $sizechartchilds .= $size->size_name;
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][brand_size]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][chest_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][shoulder_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][length_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][waist_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][neck_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][sleeve_length_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][hip_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '</tr>';
          //
          // }
          // if ($size_type=='lower')
          // {
          //   $sizechartchilds .= '<tr data-repeater-item id="tr-'.$size->size_id.'">';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_id]" value="'.$size->size_id.'">';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_type]" value="'.$size_type.'">';
          //   $sizechartchilds .= $size->size_name;
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][brand_size]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][length_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][waist_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][inseam_length_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][hip_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '</tr>';
          //
          // }
          // if ($size_type=='shoes')
          // {
          //   $sizechartchilds .= '<tr data-repeater-item id="tr-'.$size->size_id.'">';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_id]" value="'.$size->size_id.'">';
          //   $sizechartchilds .= '<input type="hidden" name="chartchilds['.$size->size_id.'][size_type]" value="'.$size_type.'">';
          //   $sizechartchilds .= $size->size_name;
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][brand_size]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.'][length_in]" class="form-control" value="" required>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '<td>';
          //   $sizechartchilds .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
          //   $sizechartchilds .= '</td>';
          //   $sizechartchilds .= '</tr>';
          //
          // }
          $sizechartchilds_cnt++;
        }
      // return $sizechartchilds;
      $returnArr = ['flag'=>$child_flag,'table'=>$sizechartchilds,'remove'=>$remove_child_ids,'header'=>$sizechartheads];
      return json_encode($returnArr);
    }

    public function addproductvariants(Request $request)
    {
      $data = $request->all();
      $product_variants = SizeChartChilds::where('size_chart_id',$data['id'])->where('color_id',$data['color_id'])->where('size_id',$data['size_id'])->first();
      $color = Colors::where('color_id',$data['color_id'])->first();
      $size = Sizes::where('size_id',$data['size_id'])->first();
      $added_childs = $data['added_variants'];
      $sku = $data['size_type'];
      $product_price = $data['product_price'];
      $sizechartchilds = '';
      $sizechartchilds_cnt = $data['variants_cnt'];
      $child_flag = 'exist';

      $child_params = array();
      parse_str($added_childs, $child_params);
      // echo "<pre>";print_r($child_params);exit;
      // dd($added_childs);
      $added_flag = 'new_new';
      if (isset($child_params['chartchilds']) && count($child_params['chartchilds'])>0)
      {
        foreach ($child_params['chartchilds'] as $added_child)
        {
          // echo "<pre>";print_r($added_child);exit;
          if ($added_child['color_id'] == $data['color_id'] && $added_child['size_id'] == $data['size_id'])
          {
            $added_flag = 'new_exist';
          }
        }
      }
      if (empty($product_variants) && $added_flag == 'new_new')
      {
        $child_flag = 'new';
        $sizechartchilds .= '<tr data-repeater-item>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="text" name="chartchilds['.$sizechartchilds_cnt.'][size_type]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'-'.$size->size_id.'" required>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="text" name="chartchilds['.$sizechartchilds_cnt.'][size_chart_name]" class="form-control" value="" required>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="hidden" name="chartchilds['.$sizechartchilds_cnt.'][color_id]" value="'.$color->color_id.'" class="variants_added_colors">';
        $sizechartchilds .= $color->color_name;
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="hidden" name="chartchilds['.$sizechartchilds_cnt.'][size_id]" value="'.$size->size_id.'" class="variants_added_sizes">';
        $sizechartchilds .= $size->size_name;
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="text" name="chartchilds['.$sizechartchilds_cnt.'][product_qty]" class="form-control" value="" required>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<input type="text" name="chartchilds['.$sizechartchilds_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<select class="select2 form-control" name="chartchilds['.$sizechartchilds_cnt.'][visibility]"> required';
        $sizechartchilds .= '<option value="1" >Enabled</option>';
        $sizechartchilds .= '<option value="0" >Disabled</option>';
        $sizechartchilds .= '</select>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '<td>';
        $sizechartchilds .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
        $sizechartchilds .= '</td>';
        $sizechartchilds .= '</tr>';
      }
      else
      {
        $child_flag = 'exist';
      }
      $returnArr = ['flag'=>$child_flag,'table'=>$sizechartchilds,'remove'=>''];
      return json_encode($returnArr);

      // return [$sizechartchilds];
    }

    public function destroy_image($id)
    {
      $sizecharts = SizeChartImages::findOrFail($id);

      $sizecharts->delete();

      Session::flash('success', 'Size Chart Image deleted!');
      Session::flash('status', 'success');

      return redirect('admin/sizecharts/edit/'.$sizecharts->size_chart_id);
    }

}
