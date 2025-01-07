<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\HomePageSections;
use App\Models\backend\Sizes;
use App\Models\backend\HomePageSectionChilds;
use App\Models\backend\HomePageSectionTypes;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class HomepagesectionchildsController extends Controller
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
    public function index($id)
    {
        $homepagesections = HomePageSections::findOrFail($id);
        $home_page_section_childs = HomePageSectionChilds::where('home_page_section_id',$id)->with('size')->get();

        $home_page_section_types = HomePageSectionTypes::leftJoin("home_page_section_fields",\DB::raw("FIND_IN_SET(home_page_section_fields.home_page_section_field_id,home_page_section_types.home_page_section_field_id)"),">",\DB::raw("'0'"))
        ->where('home_page_section_types.home_page_section_type_id',$homepagesections->home_page_section_type_id)
        ->get([
            'home_page_section_types.*', \DB::raw("home_page_section_fields.*")
        ]);
        // dd($home_page_section_types);
        return view('backend.homepagesectionchilds.index', compact('home_page_section_childs','homepagesections','home_page_section_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {

      $homepagesections = HomePageSections::where('home_page_section_id',$id)->first();
      // $home_page_section_type = HomePageSectionTypes::where('home_page_section_type_id',$homepagesections->home_page_section_type_id)->with('home_page_section_fields')->first();
      $home_page_section_type = HomePageSectionTypes::leftJoin("home_page_section_fields",\DB::raw("FIND_IN_SET(home_page_section_fields.home_page_section_field_id,home_page_section_types.home_page_section_field_id)"),">",\DB::raw("'0'"))
      ->where('home_page_section_types.home_page_section_type_id',$homepagesections->home_page_section_type_id)
      ->get([
          'home_page_section_types.*', \DB::raw("home_page_section_fields.*")
      ]);
      $home_page_section_type = collect($home_page_section_type)->mapWithKeys(function ($item, $key) {
        return [$item['home_page_section_field_code'] => $item['home_page_section_field_code']];
      })->toArray();
      // dd($home_page_section_type);
      return view('backend.homepagesectionchilds.create', compact('homepagesections','home_page_section_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        // 'home_page_section_child_images' => ['required'],
      ]);
      // setlocale(LC_MONETARY, 'en_IN.UTF-8');
      $home_page_section_child = new HomePageSectionChilds();
      $home_page_section_child->fill($request->all());



      if($home_page_section_child->save())
      {
        if ($request->hasFile('home_page_section_child_images'))
        {
          $image = $request->file('home_page_section_child_images');
          $destinationPath = public_path('/backend-assets/uploads/home_page_section_child_images');
          if (!file_exists($destinationPath))
          {
            mkdir($destinationPath,0777);
          }
          if (is_array($image))
          {
            // foreach ($images as $image)
            // {
            //   $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
            //   $image->move($destinationPath, $name);
            //   $home_page_section_child->image_name = $name;
            // }
          }
          else
          {
            $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);

            $home_page_section_child->home_page_section_child_images = $name;
            $home_page_section_child->save();
          }
        }

      }

        Session::flash('message', 'Child added!');
        Session::flash('status', 'success');

        return redirect('admin/homepagesectionchilds/index/'.$home_page_section_child->home_page_section_id);

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
        $home_page_section_child = HomePageSectionChilds::findOrFail($id);

        return view('backend.homepagesectionchilds.show', compact('products'));
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
        $home_page_section_child = HomePageSectionChilds::findOrFail($id);
        $homepagesections = HomePageSections::where('home_page_section_id',$home_page_section_child->home_page_section_id)->first();
        // $home_page_section_type = HomePageSectionTypes::where('home_page_section_type_id',$homepagesections->home_page_section_type_id)->with('home_page_section_fields')->first();
        $home_page_section_type = HomePageSectionTypes::leftJoin("home_page_section_fields",\DB::raw("FIND_IN_SET(home_page_section_fields.home_page_section_field_id,home_page_section_types.home_page_section_field_id)"),">",\DB::raw("'0'"))
        ->where('home_page_section_types.home_page_section_type_id',$homepagesections->home_page_section_type_id)
        ->get([
            'home_page_section_types.*', \DB::raw("home_page_section_fields.*")
        ]);
        $home_page_section_type = collect($home_page_section_type)->mapWithKeys(function ($item, $key) {
          return [$item['home_page_section_field_code'] => $item['home_page_section_field_code']];
        })->toArray();
        // dd($filter_list);
        return view('backend.homepagesectionchilds.edit', compact('home_page_section_child','homepagesections','home_page_section_type'));
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
        // 'home_page_section_child_images' => ['required'],
        // 'product_price' => ['required'],
      ]);
      if(is_numeric($request->input('home_page_section_child_footer_title')) && $request->input('home_page_section_child_footer_title') > 5)
      {
       
        $this->validate($request, [
         'home_page_section_child_footer_title' => 'digits_between::1,5',
        ]);
      }
      $id = $request->input('home_page_section_child_id');
      $home_page_section_child = HomePageSectionChilds::findOrFail($id);
      $home_page_section_child->fill($request->all());

      if ($request->hasFile('home_page_section_child_images'))
      {
        $image = $request->file('home_page_section_child_images');
        $destinationPath = public_path('/backend-assets/uploads/home_page_section_child_images');
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

          $home_page_section_child->home_page_section_child_images = $name;
          $home_page_section_child->home_page_section_child_video_url = null;
          // $home_page_section_child->save();
        }
      }
      else if(isset($request->home_page_section_child_video_url))
      {
        $home_page_section_child->home_page_section_child_video_url = $request->home_page_section_child_video_url;
        $home_page_section_child->home_page_section_child_images = null;
      }

      if($home_page_section_child->update())
      {

      }
      Session::flash('message', 'Child updated!');
      Session::flash('status', 'success');

      return redirect('admin/homepagesectionchilds/index/'.$home_page_section_child->home_page_section_id);
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
        $home_page_section_child = HomePageSectionChilds::findOrFail($id);

        $home_page_section_child->delete();

        Session::flash('success', 'Section Child deleted');
        Session::flash('status', 'success');

        return redirect('admin/homepagesectionchilds/index/'.$home_page_section_child->home_page_section_id);
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

    public function gethomepagesectionchilds(Request $request)
    {
      $data = $request->all();
      $colors = Colors::whereIn('color_id',$data['color_id'])->get();
      $sizes = Sizes::whereIn('size_id',$data['size_id'])->get();
      // $subsubcategory_list = collect($subsubcategory)->mapWithKeys(function ($item, $key) {
      //     return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
      //   });
      // dd($data);
      $sku = $data['product_sku'];
      $variants = '';
      if ($data['product_type']=='configurable')
      {
        // $variants = '<table>';
        // $variants = '<tbody>';
        $variants_cnt = 0;
        foreach ($colors as $color)
        {
          foreach ($sizes as $size)
          {
            $variants .= '<tr>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_sku]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'-'.$size->size_id.'" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_title]" class="form-control" value="" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][color_id]" value="'.$color->color_id.'">';
            $variants .= $color->color_name;
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][size_id]" value="'.$size->size_id.'">';
            $variants .= $size->size_name;
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_qty]" class="form-control" value="" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_price]" class="form-control" value="" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<select class="select2 form-control" name="variants['.$variants_cnt.'][visibility]"> required';
            $variants .= '<option value="1" >Enabled</option>';
            $variants .= '<option value="0" >Disabled</option>';
            $variants .= '</select>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
            $variants .= '</td>';
            $variants .= '</tr>';

            $variants_cnt++;
          }
        }
        // if (count($subsubcategory)==0)
        // {
        //   echo "<option value=''>No Record Found</option>";
        // }
        // $variants .= '</table>';
      }
      return $variants;
    }

    public function addhomepagesectionchilds(Request $request)
    {
      $data = $request->all();
      $product_variants = HomePageSectionChilds::where('product_id',$data['id'])->where('color_id',$data['color_id'])->where('size_id',$data['size_id'])->first();
      $color = Colors::where('color_id',$data['color_id'])->first();
      $size = Sizes::where('size_id',$data['size_id'])->first();
      $added_variants = $data['added_variants'];
      $sku = $data['product_sku'];
      $variants = '';
      $variants_cnt = $data['variants_cnt'];
      $variant_flag = 'exist';

      $variant_params = array();
      parse_str($added_variants, $variant_params);
      // echo "<pre>";print_r($variant_params);exit;
      // dd($added_variants);
      $added_flag = 'new_new';
      if (isset($variant_params['variants']) && count($variant_params['variants'])>0)
      {
        foreach ($variant_params['variants'] as $added_variant)
        {
          // echo "<pre>";print_r($added_variant);exit;
          if ($added_variant['color_id'] == $data['color_id'] && $added_variant['size_id'] == $data['size_id'])
          {
            $added_flag = 'new_exist';
          }
        }
      }
      if (empty($product_variants) && $added_flag == 'new_new')
      {
        $variant_flag = 'new';
        $variants .= '<tr data-repeater-item>';
        $variants .= '<td>';
        $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_sku]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'-'.$size->size_id.'" required>';
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_title]" class="form-control" value="" required>';
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][color_id]" value="'.$color->color_id.'" class="variants_added_colors">';
        $variants .= $color->color_name;
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][size_id]" value="'.$size->size_id.'" class="variants_added_sizes">';
        $variants .= $size->size_name;
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_qty]" class="form-control" value="" required>';
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_price]" class="form-control" value="" required>';
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<select class="select2 form-control" name="variants['.$variants_cnt.'][visibility]"> required';
        $variants .= '<option value="1" >Enabled</option>';
        $variants .= '<option value="0" >Disabled</option>';
        $variants .= '</select>';
        $variants .= '</td>';
        $variants .= '<td>';
        $variants .= '<button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>';
        $variants .= '</td>';
        $variants .= '</tr>';
      }
      else
      {
        $variant_flag = 'exist';
      }
      $returnArr = ['flag'=>$variant_flag,'table'=>$variants];
      return json_encode($returnArr);

      // return [$variants];
    }


}
