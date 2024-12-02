<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\Products;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\Countries;
use App\Models\backend\Sellers;
use App\Models\backend\Manufacturers;
use App\Models\backend\Packers;
use App\Models\backend\Importers;
use App\Models\backend\SubSubCategories;
use App\Models\backend\ProductImages;
use App\Models\backend\Filters;
use App\Models\backend\FilterValues;
use App\Models\backend\ProductFilters;
use App\Models\backend\Colors;
use App\Models\backend\Sizes;
use App\Models\backend\ProductVariants;
use App\Models\backend\ProductVariantImages;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Gd\Imagine;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductvariantsController extends Controller
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
        $products = ProductVariants::where('product_id',$id)->get();
        // dd($products);
        return view('backend.productvariants.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $categories = Categories::all();
      $categories = collect($categories)->mapWithKeys(function ($item, $key) {
        return [$item['category_id'] => $item['category_name']];
      });
      $sub_categories = [];
      // $sub_categories = SubCategories::where('category_id',$products->category_id)->get();
      // $sub_categories = collect($sub_categories)->mapWithKeys(function ($item, $key) {
      //   return [$item['subcategory_id'] => $item['subcategory_name']];
      // });
      $sub_sub_categories = [];
      // $sub_sub_categories = SubSubCategories::where('category_id',$products->category_id)->where('subcategory_id',$products->sub_category_id)->get();
      // $sub_sub_categories = collect($sub_sub_categories)->mapWithKeys(function ($item, $key) {
      //   return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
      // });
      $countries = Countries::all();
      $countries = collect($countries)->mapWithKeys(function ($item, $key) {
        return [$item['id'] => $item['name']];
      });
      $sellers = Sellers::all();
      $sellers = collect($sellers)->mapWithKeys(function ($item, $key) {
        return [$item['seller_id'] => $item['seller_name']];
      });
      $manufacturers = Manufacturers::all();
      $manufacturers = collect($manufacturers)->mapWithKeys(function ($item, $key) {
        return [$item['manufacturer_id'] => $item['manufacturer_name']];
      });
      $packers = Packers::all();
      $packers = collect($packers)->mapWithKeys(function ($item, $key) {
        return [$item['packer_id'] => $item['packer_name']];
      });
      $importers = Importers::all();
      $importers = collect($importers)->mapWithKeys(function ($item, $key) {
        return [$item['importer_id'] => $item['importer_name']];
      });
      $color_list = Colors::all();
      $color_list = collect($color_list)->mapWithKeys(function ($item, $key) {
        return [$item['color_id'] => $item['color_name']];
      });
      $size_list = Sizes::all();
      $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
        return [$item['size_id'] => $item['size_name']];
      });
      $filters = Filters::with('filtervalues')->where('visibility',1)->where('product_page_visibility',1)->get();
      foreach ($filters as $filter)
      {
        $filter_name = $filter->filter_name.'->';
        foreach ($filter->filtervalues as $filter_value)
        {
          $filter_list[$filter_value->filter_value_id] = $filter_name.$filter_value->filter_value;
        }
      }
      return view('backend.productvariants.create', compact('categories','sub_categories','sub_sub_categories','countries','sellers','manufacturers','packers','importers','filter_list','color_list','size_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'product_title' => ['required'],
        'product_sku' => ['required'],
        'product_type' => ['required'],
        'product_price' => ['required'],
      ]);

      $categories = Categories::where('category_id',$request->input('category_id'))->first();
      $sub_categories = SubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->first();
      // dd($request->all());
      $sub_sub_categories = SubSubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->where('sub_subcategory_id',$request->input('sub_sub_category_id'))->first();

      $products = new ProductVariants();
      $products->fill($request->all());
      $products->category_slug = $categories->category_slug;
      $products->sub_category_slug = $sub_categories->sub_category_slug;
      $products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
      if ($request->product_type == 'configurable')
      {
        $products->color_id = implode(',',$request->color_id);
        $products->size_id = implode(',',$request->size_id);
      }
      else
      {
        $products->color_id = $request->color_id;
        $products->size_id = $request->size_id;
      }

      if($products->save())
      {
        if ($request->hasFile('product_images'))
        {
          $images = $request->file('product_images');
          $destinationPath = public_path('/backend-assets/uploads/product_images');
          if (!file_exists($destinationPath))
          {
            mkdir($destinationPath,0777);
          }
          foreach ($images as $image)
          {
            $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);

            $product_images = new ProductImages();
            $product_images->image_name = $name;
            $product_images->product_id = $products->product_id;
            $product_images->save();
          }
          // $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          // $image->move($destinationPath, $name);
          //
          // $product_images = new ProductImages();
          // $product_images->image_name = $name;
          // $product_images->product_id = $products->product_id;
          // $product_images->save();
        }
        $filter_values = ProductFilters::where('product_id',$products->product_id)->get();
        if (isset($request->filter_id) && count($request->filter_id)>0)
        {
          // exit;
          if ($filter_values)
          {
            $filter_values->each->delete();
          }
          foreach ($request->filter_id as $value)
          {
            $product_filter = new ProductFilters();
            $product_filter->filter_value_id = $value;
            $product_filter->product_id = $products->product_id;
            $product_filter->save();
          }
        }
        else
        {
          // $filter_values = ProductFilters::where('product_id',$id)->get();
          if ($filter_values)
          {
            $filter_values->each->delete();
          }
        }
        if ($request->product_type == 'configurable')
        {
          if (isset($request->variants))
          {
            $variants = $request->variants;
            foreach ($variants as $variant)
            {
              $variant_products = new ProductVariants();
              $variant_products->fill($variant);
              $variant_products->category_slug = $categories->category_slug;
              $variant_products->sub_category_slug = $sub_categories->sub_category_slug;
              $variant_products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
              $variant_products->product_id = $products->product_id;
              $variant_products->save();
            }
          }
        }
      }

        Session::flash('success', 'Product added!');
        Session::flash('status', 'success');

        return redirect('admin/productvariants');

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
        $products = ProductVariants::findOrFail($id);

        return view('backend.productvariants.show', compact('products'));
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
        $products = ProductVariants::findOrFail($id);
        $categories = Categories::all();
        $categories = collect($categories)->mapWithKeys(function ($item, $key) {
          return [$item['category_id'] => $item['category_name']];
        });
        $sub_categories = SubCategories::where('category_id',$products->category_id)->get();
        $sub_categories = collect($sub_categories)->mapWithKeys(function ($item, $key) {
          return [$item['subcategory_id'] => $item['subcategory_name']];
        });
        $sub_sub_categories = SubSubCategories::where('category_id',$products->category_id)->where('subcategory_id',$products->sub_category_id)->get();
        $sub_sub_categories = collect($sub_sub_categories)->mapWithKeys(function ($item, $key) {
          return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
        });
        $countries = Countries::all();
        $countries = collect($countries)->mapWithKeys(function ($item, $key) {
          return [$item['id'] => $item['name']];
        });
        $sellers = Sellers::all();
        $sellers = collect($sellers)->mapWithKeys(function ($item, $key) {
          return [$item['seller_id'] => $item['seller_name']];
        });
        $manufacturers = Manufacturers::all();
        $manufacturers = collect($manufacturers)->mapWithKeys(function ($item, $key) {
          return [$item['manufacturer_id'] => $item['manufacturer_name']];
        });
        $packers = Packers::all();
        $packers = collect($packers)->mapWithKeys(function ($item, $key) {
          return [$item['packer_id'] => $item['packer_name']];
        });
        $importers = Importers::all();
        $importers = collect($importers)->mapWithKeys(function ($item, $key) {
          return [$item['importer_id'] => $item['importer_name']];
        });
        $product_images = ProductVariantImages::where('product_id',$products->product_id)->where('color_id',$products->color_id)->get();
        $product_images = collect($product_images)->mapWithKeys(function ($item, $key) {
          return [$item['product_image_id'] => $item['image_name']];
        });
        $filters = Filters::with('filtervalues')->where('visibility',1)->where('product_page_visibility',1)->get();
        foreach ($filters as $filter)
        {
          $filter_name = $filter->filter_name.'->';
          foreach ($filter->filtervalues as $filter_value)
          {
            $filter_list[$filter_value->filter_value_id] = $filter_name.$filter_value->filter_value;
          }
        }
        $filter_values = ProductFilters::where('product_id',$id)->get();
        $filter_values = collect($filter_values)->mapWithKeys(function ($item, $key) {
          return [$item['filter_value_id'] => $item['filter_value_id']];
        });
        $color_list = Colors::all();
        $color_list = collect($color_list)->mapWithKeys(function ($item, $key) {
          return [$item['color_id'] => $item['color_name']];
        });
        $size_list = Sizes::all();
        $size_list = collect($size_list)->mapWithKeys(function ($item, $key) {
          return [$item['size_id'] => $item['size_name']];
        });
        $product_variants = ProductVariants::where('product_id',$id)->with(['color','size'])->get();
        // dd($filter_list);
        return view('backend.productvariants.edit', compact('products','categories','sub_categories','sub_sub_categories','countries','sellers','manufacturers','packers','importers','product_images','filter_list','filter_values','color_list','size_list','product_variants'));
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
        'product_title' => ['required'],
        'product_price' => ['required'],
      ]);
      $id = $request->input('product_variant_id');
      $products = ProductVariants::findOrFail($id);
      $products->fill($request->all());

      if ($request->hasFile('product_thumb'))
      {
        $product_thumb_image = $request->file('product_thumb');
        $product_thumb_destinationPath = public_path('/backend-assets/uploads/product_variant_thumbs');
        if (!file_exists($product_thumb_destinationPath))
        {
          mkdir($product_thumb_destinationPath,0777);
        }
        $product_thumb_name = time().rand(1,100).'.'.$product_thumb_image->getClientOriginalExtension();
        $product_thumb_image->move($product_thumb_destinationPath, $product_thumb_name);

        $img_width  = 540;
        $img_height = 675;
        $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
        $img_size   = new Box($img_width, $img_height);

        $thumbnail = new Imagine();
        $thumbnail->open("{$product_thumb_destinationPath}/{$product_thumb_name}")->resize(new Box($img_width, $img_height))->save("{$product_thumb_destinationPath}/{$product_thumb_name}");

        $product_thumb_destinationPath2 = public_path('/backend-assets/uploads/product_variant_thumbsxl');
        if (!file_exists($product_thumb_destinationPath2))
        {
          mkdir($product_thumb_destinationPath2,0777);
        }
        $img_width2  = 700;
        $img_height2 = 936;
        $thumbnail2 = new Imagine();
        $thumbnail2->open("{$product_thumb_destinationPath}/{$product_thumb_name}")->resize(new Box($img_width2, $img_height2))->save("{$product_thumb_destinationPath2}/{$product_thumb_name}");

        $products->product_thumb = $product_thumb_name;

      }
      if ($request->hasFile('product_images'))
      {
        $images = $request->file('product_images');
        // dd($im/ages);
        $destinationPath = public_path('/backend-assets/uploads/product_variant_images'.$products->product_variant_id);
        if (!file_exists($destinationPath))
        {
          mkdir($destinationPath,0777, true);
        }
        $destinationPath_original = public_path('/backend-assets/uploads/product_variant_images_original/'.$products->product_variant_id);
        if (!file_exists($destinationPath_original))
        {
          mkdir($destinationPath_original,0777, true);
        }
        foreach ($images as $image)
        {
          $name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath, $name);
          copy($destinationPath.'/'.$name, $destinationPath_original.'/'.$name);//08-07-2022
          // $img_width  = 700;
          // $img_height = 936;
          $img_width  = 540;
          $img_height = 675;
          $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
          $img_size   = new Box($img_width, $img_height);
          // $image->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");
          $thumbnail = new Imagine();
          $thumbnail->open("{$destinationPath}/{$name}")->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");

          $destinationPath2 = public_path('/backend-assets/uploads/product_variant_imagesxl');
          if (!file_exists($destinationPath2))
          {
            mkdir($destinationPath2,0777, true);
          }
          $img_width2  = 700;
          $img_height2 = 936;
          // $img_size   = new Box($img_width2, $img_height2);
          $thumbnail2 = new Imagine();
          $thumbnail2->open("{$destinationPath}/{$name}")->resize(new Box($img_width2, $img_height2))->save("{$destinationPath2}/{$name}");

          $product_images = new ProductVariantImages();
          $product_images->image_name = $name;
          $product_images->product_id = $products->product_id;
          $product_images->product_variant_id = $id;
          $product_images->color_id = $products->color_id;
          $product_images->save();
        }
      }

      if($products->update())
      {

      }
      Session::flash('success', 'Product updated!');
      // Session::flash('status', 'success');

      return redirect('admin/productvariants/index/'.$products->product_id);
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
        $products = ProductVariants::findOrFail($id);

        $products->delete();

        Session::flash('success', 'Product deleted!');
        Session::flash('status', 'success');

        return redirect('admin/productvariants');
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

    public function getproductvariants(Request $request)
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

    public function addproductvariants(Request $request)
    {
      $data = $request->all();
      $product_variants = ProductVariants::where('product_id',$data['id'])->where('color_id',$data['color_id'])->where('size_id',$data['size_id'])->first();
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

    public function destroy_image($id)
    {
      $products = ProductVariantImages::findOrFail($id);

      $products->delete();

      Session::flash('success', 'Product Variant Image deleted!');
      // Session::flash('status', 'success');

      return redirect('admin/productvariants/edit/'.$products->product_variant_id);
    }


}
