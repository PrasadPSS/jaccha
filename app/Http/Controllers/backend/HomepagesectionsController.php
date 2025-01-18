<?php

namespace App\Http\Controllers\backend;

use App\Models\backend\Products;
use App\Models\frontend\Logo;
use Session;
use Carbon\Carbon;

use App\Http\Requests;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;
use Illuminate\Http\Request;
use App\Models\backend\Sizes;
use App\Models\backend\Colors;
use App\Models\backend\Filters;
use App\Models\backend\Packers;
use App\Models\backend\Sellers;
use App\Models\backend\Countries;
use App\Models\backend\Importers;
use Imagine\Image\ImageInterface;
use App\Models\backend\Categories;
use App\Http\Controllers\Controller;
use App\Models\backend\FilterValues;
use App\Models\backend\SpecialDeals;
use App\Models\backend\Manufacturers;
use App\Models\backend\SubCategories;

use App\Models\backend\ProductFilters;
use App\Models\backend\SizeChartChilds;
use App\Models\backend\SizeChartFields;
use App\Models\backend\HomePageSectionChilds;
use App\Models\backend\HomePageSections;
use App\Models\backend\SubSubCategories;
use App\Models\backend\HomePageSectionTypes;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class HomepagesectionsController extends Controller
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
        $homepagesections = HomePageSections::orderBy('home_page_section_priority')->with('home_page_section_type')->get();
        // dd($homepagesections);
        return view('backend.homepagesections.index', compact('homepagesections'));
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
      $home_page_section_types = HomePageSectionTypes::get();
      $home_page_section_type_list = collect($home_page_section_types)->mapWithKeys(function ($item, $key) {
        return [$item['home_page_section_type_id'] => $item['home_page_section_type_name']];
      });
      // dd($home_page_section_type_list);
      return view('backend.homepagesections.create', compact('sizes','home_page_section_type_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'home_page_section_name' => ['required'],
        'home_page_section_type_id' => ['required'],
        'home_page_section_priority' => ['required'],
        'home_page_section_no_prod' => ['required_unless:home_page_section_type_id,1'],
      ]);

      $homepagesections = new HomePageSections();
      $homepagesections->fill($request->all());

      // $homepagesections->size_ids = implode(',',$request->size_ids);
      if(isset($request->size_ids)){
        $homepagesections->home_page_section_code = implode(',',$request->size_ids);
      }

      // dd($homepagesections);
      if($homepagesections->save())
      {
        if ($request->hasFile('home_page_section_images'))
        {
          $images = $request->file('home_page_section_images');
          $destinationPath = public_path('/backend-assets/uploads/home_page_section_images');
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

            $home_page_section_images = new HomePageSectionChilds();
            $home_page_section_images->image_name = $name;
            $home_page_section_images->home_page_section_id = $homepagesections->home_page_section_id;
            $home_page_section_images->save();
          }
          // $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          // $image->move($destinationPath, $name);
          //
          // $home_page_section_images = new HomePageSectionChilds();
          // $home_page_section_images->image_name = $name;
          // $home_page_section_images->home_page_section_id = $homepagesections->home_page_section_id;
          // $home_page_section_images->save();
        }


        // if (isset($request->chartchilds))
        // {
        //   $sizechartchilds = $request->chartchilds;
        //   // dd($sizechartchilds);
        //   foreach ($sizechartchilds as $childchart)
        //   {
        //     $childchart_homepagesections = new SizeChartChilds();
        //     $childchart_homepagesections->fill($childchart);
        //     $childchart_homepagesections->home_page_section_id = $homepagesections->home_page_section_id;
        //     $childchart_homepagesections->save();
        //     if ($childchart_homepagesections)
        //     {
        //       // dd($childchart_homepagesections);
        //     }
        //   }
        // }

      }

        Session::flash('message', 'Section added!');
        Session::flash('status', 'success');

        return redirect('admin/homepagesections');

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
        $homepagesections = HomePageSections::findOrFail($id);
        $home_page_section_types = HomePageSectionTypes::get();
        $home_page_section_type_list = collect($home_page_section_types)->mapWithKeys(function ($item, $key) {
          return [$item['home_page_section_type_id'] => $item['home_page_section_type_name']];
        });
        return view('backend.homepagesections.show', compact('homepagesections','home_page_section_type_list'));
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
        $homepagesections = HomePageSections::findOrFail($id);
        $products= Products::get();
        $products = collect($products)->mapWithKeys(function ($item, $key) {
          return [$item['product_id'] => $item['product_title']];
        });
        $home_page_section_type_list = HomePageSectionTypes::get();
        $home_page_section_type_list = collect($home_page_section_type_list)->mapWithKeys(function ($item, $key) {
          return [$item['home_page_section_type_id'] => $item['home_page_section_type_name']];
        });

        $home_page_section_types = HomePageSectionTypes::leftJoin("home_page_section_fields",\DB::raw("FIND_IN_SET(home_page_section_fields.home_page_section_field_id,home_page_section_types.home_page_section_field_id)"),">",\DB::raw("'0'"))
        ->where('home_page_section_types.home_page_section_type_id',$homepagesections->size_type)
        ->get([
            'home_page_section_types.*', \DB::raw("home_page_section_fields.*")
        ]);
        // dd($sizechart_childs);
        return view('backend.homepagesections.edit', compact('products','homepagesections','home_page_section_type_list','home_page_section_types'));
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
      // dd($request->all());
      $this->validate($request, [
        'home_page_section_name' => ['required'],
        'home_page_section_type_id' => ['required'],
        'home_page_section_priority' => ['required'],
        'home_page_section_no_prod' => ['required_unless:home_page_section_type_id,1'],
        'home_page_section_product' => ['required']
      ]);
      $id = $request->input('home_page_section_id');
      $homepagesections = HomePageSections::findOrFail($id);
      $homepagesections->fill($request->all());

      if($homepagesections->update())
      {

      }
        if(isset($request->home_page_section_start_date))
        {
          $specialdeals=SpecialDeals::first();
          if($specialdeals){
            $specialdeals->start_date=$request->home_page_section_start_date;
            $specialdeals->end_date=$request->home_page_section_end_date;
            $specialdeals->save();
          }
        }
           
     Session::flash('message', 'Section updated!');
      Session::flash('status', 'success');

      return redirect('admin/homepagesections');
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
        $homepagesections = HomePageSections::findOrFail($id);
        $home_page_section_images = HomePageSectionChilds::where('home_page_section_id',$id)->get();
        if ($home_page_section_images)
        {
          $home_page_section_images->each->delete();
        }
        // $home_page_section_variants = SizeChartChilds::where('home_page_section_id',$id)->get();
        // if ($home_page_section_variants)
        // {
        //   $home_page_section_variants->each->delete();
        // }
        $homepagesections->delete();

        Session::flash('message', 'Section deleted!');
        Session::flash('status', 'success');

        return redirect('admin/homepagesections');
    }

    public function logo()
    {
      $data['logo'] = Logo::first();
      return view('backend/logo/index', $data);
    }

    public function logoEdit()
    {
      $data['logo'] = Logo::first();
      return view('backend/logo/edit', $data);
    }

  public function logoUpdate(Request $request)
  {
    $image = $request->file('logo');

    $destinationPath = public_path('/assets/images');
    if (!file_exists($destinationPath)) {
      mkdir($destinationPath, 0777);
    }
    $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
    $image->move($destinationPath, $name);
    Logo::where('id', 1)->update(['logo_path'=> $name]);

    return redirect()->route('admin.homepagesections.logo')->with('success', 'Logo updated successfully');
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

      $home_page_section_types = HomePageSectionTypes::leftJoin("home_page_section_fields",\DB::raw("FIND_IN_SET(home_page_section_fields.home_page_section_field_id,home_page_section_types.home_page_section_field_id)"),">",\DB::raw("'0'"))
      ->where('home_page_section_types.home_page_section_type_id',$size_type)
      ->get([
          'home_page_section_types.*', \DB::raw("home_page_section_fields.*")
      ]);
      // dd($home_page_section_type);

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
        foreach ($home_page_section_types as $home_page_section_type)
        {
          $sizechartheads .= '<th>';
          $sizechartheads .= $home_page_section_type->home_page_section_field_name;
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
          foreach ($home_page_section_types as $home_page_section_type)
          {
            $sizechartchilds .= '<td>';
            $sizechartchilds .= '<input type="text" name="chartchilds['.$size->size_id.']['.$home_page_section_type->home_page_section_field_code.']" class="form-control" value="" required>';
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
      $product_variants = SizeChartChilds::where('home_page_section_id',$data['id'])->where('color_id',$data['color_id'])->where('size_id',$data['size_id'])->first();
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
        $sizechartchilds .= '<input type="text" name="chartchilds['.$sizechartchilds_cnt.'][home_page_section_name]" class="form-control" value="" required>';
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
      $homepagesections = HomePageSectionChilds::findOrFail($id);

      $homepagesections->delete();

      Session::flash('message', 'Section Image deleted!');
      Session::flash('status', 'success');

      return redirect('admin/homepagesections/edit/'.$homepagesections->home_page_section_id);
    }

    public function setsectionorder(Request $request)
    {
      $data = $request->all();
      // dd($data['sorted']);
      // $sorted = $data['sorted'];
      if (isset($data['sorted']) && count($data['sorted'])>0)
      {
        $priority = 1;
        foreach ($data['sorted'] as $sort_id)
        {
          $home_page_section = HomePageSections::find($sort_id);
          if ($home_page_section)
          {
            $home_page_section->home_page_section_priority = $priority;
            $home_page_section->update();
          }
          $priority++;
        }
        return 'Priority Updated';
      }
      else
      {
        return "Some thing Went Wrong.";
      }

    }

}
