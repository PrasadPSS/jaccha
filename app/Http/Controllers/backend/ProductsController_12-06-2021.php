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
use App\Models\backend\SizeCharts;
use App\Models\backend\Brands;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Gd\Imagine;


class ProductsController extends Controller
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
        $products = Products::all();
        // dd($products);
        return view('backend.products.index', compact('products'));
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
      $size_chart_list = SizeCharts::all();
      $size_chart_list = collect($size_chart_list)->mapWithKeys(function ($item, $key) {
        return [$item['size_chart_id'] => $item['size_chart_name']];
      });

      return view('backend.products.create', compact('categories','sub_categories','sub_sub_categories',
        'countries','sellers','manufacturers','packers',
        'importers','filter_list','color_list','size_list',
        'size_chart_list',
      ));
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
        'category_id' => ['required'],
        'sub_category_id' => ['required'],
        'sub_sub_category_id' => ['required'],
        'filter_id' => ['required'],
        'size_chart_id' => ['required'],
        'country_id' => ['required'],
      ]);

      $categories = Categories::where('category_id',$request->input('category_id'))->first();
      $sub_categories = SubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->first();
      // dd($request->all());
      $sub_sub_categories = SubSubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->where('sub_subcategory_id',$request->input('sub_sub_category_id'))->first();

      $products = new Products();
      $products->fill($request->all());
      $products->category_slug = $categories->category_slug;
      $products->sub_category_slug = $sub_categories->sub_category_slug;
      $products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
      $products->new_arrival = isset($request->new_arrival)?1:0;
      if ($request->product_type == 'configurable')
      {
        $products->color_id = implode(',',$request->color_id);
        // dd($request->size_id);
        $products->size_id = (isset($request->size_id)&& is_array($request->size_id))?implode(',',$request->size_id):'';
      }
      else
      {
        $products->color_id = $request->color_id;
        $products->size_id = (isset($request->size_id)&&$request->size_id!='')?$request->size_id:0;
      }
      // dd($products);
      if ($request->hasFile('product_thumb'))
      {
        $product_thumb_image = $request->file('product_thumb');
        $product_thumb_destinationPath = public_path('/product_thumbs');
        if (!file_exists($product_thumb_destinationPath))
        {
          mkdir($product_thumb_destinationPath,0777);
        }
        $product_thumb_name = time().rand(1,100).'.'.$product_thumb_image->getClientOriginalExtension();
        $product_thumb_image->move($product_thumb_destinationPath, $product_thumb_name);
        $products->product_thumb = $product_thumb_name;
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

            // $img_width  = 700;
            // $img_height = 936;
            $img_width  = 540;
            $img_height = 675;
            $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
            $img_size   = new Box($img_width, $img_height);
            // $image->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");
            $thumbnail = new Imagine();
            $thumbnail->open("{$destinationPath}/{$name}")->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");

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
              $variant_products->category_id = $categories->category_id;
              $variant_products->sub_category_slug = $sub_categories->sub_category_slug;
              $variant_products->sub_category_id = $sub_categories->subcategory_id;
              $variant_products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
              $variant_products->sub_sub_category_id = $sub_sub_categories->sub_subcategory_id;
              $variant_products->product_id = $products->product_id;
              $variant_products->save();
            }
          }
        }
      }

        Session::flash('message', 'Product added!');
        Session::flash('status', 'success');

        return redirect('admin/products');

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
        $products = Products::findOrFail($id);

        return view('backend.products.show', compact('products'));
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
        $products = Products::findOrFail($id);
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
        $product_images = ProductImages::where('product_id',$id)->get();
        $product_images = collect($product_images)->mapWithKeys(function ($item, $key) {
          return [$item['product_image_id'] => $item['image_name']];
        });
        // dd($product_images);
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

        $size_chart_list = SizeCharts::all();
        $size_chart_list = collect($size_chart_list)->mapWithKeys(function ($item, $key) {
          return [$item['size_chart_id'] => $item['size_chart_name']];
        });

        $brand_list = Brands::where('manufacturer_id', $products->manufacturer_id)->get();
        $brand_list = collect($brand_list)->mapWithKeys(function ($item, $key) {
          return [$item['brand_id'] => $item['brand_name']];
        });
        // dd($filter_list);
        return view('backend.products.edit', compact('products','categories','sub_categories','sub_sub_categories',
          'countries','sellers','manufacturers','packers',
          'importers','product_images','filter_list','filter_values',
          'color_list','size_list','product_variants','size_chart_list',
          'brand_list',
        ));
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
        'product_title' => ['required'],
        'product_price' => ['required'],
        'product_type' => ['required'],
        'product_price' => ['required'],
        'category_id' => ['required'],
        'sub_category_id' => ['required'],
        'sub_sub_category_id' => ['required'],
        'filter_id' => ['required'],
        'size_chart_id' => ['required'],
        'country_id' => ['required'],
      ]);
      $id = $request->input('product_id');
      $products = Products::findOrFail($id);
      $products->fill($request->all());
      $categories = Categories::where('category_id',$request->input('category_id'))->first();
      $sub_categories = SubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->first();
      // dd($request->all());
      $sub_sub_categories = SubSubCategories::where('category_id',$request->input('category_id'))->where('subcategory_id',$request->input('sub_category_id'))->where('sub_subcategory_id',$request->input('sub_sub_category_id'))->first();
      $products->category_slug = $categories->category_slug;
      $products->sub_category_slug = $sub_categories->sub_category_slug;
      $products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
      $products->new_arrival = isset($request->new_arrival)?1:0;
      if ($request->product_type == 'configurable')
      {
        $products->color_id = implode(',',$request->color_id);
        // dd($request->size_id);
        $products->size_id = (isset($request->size_id)&& is_array($request->size_id))?implode(',',$request->size_id):'';
      }
      else
      {
        $products->color_id = $request->color_id;
        if(isset($request->size_id) && $request->size_id!='')
        {
          if (is_array($request->size_id))
          {
            $products->size_id = $request->size_id[0];
          }
          else
          {
            $products->size_id = $request->size_id;
          }
        }
        else
        {
          $products->size_id = 0;
        }
      }

      if ($request->hasFile('product_images'))
      {
        $images = $request->file('product_images');
        // dd($im/ages);
        $destinationPath = public_path('/backend-assets/uploads/product_images');
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
          $img_width  = 540;
          $img_height = 675;
          $img_mode   = ImageInterface::THUMBNAIL_OUTBOUND;
          $img_size   = new Box($img_width, $img_height);
          // $image->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");
          $thumbnail = new Imagine();
          $thumbnail->open("{$destinationPath}/{$name}")->resize(new Box($img_width, $img_height))->save("{$destinationPath}/{$name}");

          $product_images = new ProductImages();
          $product_images->image_name = $name;
          $product_images->product_id = $id;
          $product_images->save();
        }
      }
      $filter_values = ProductFilters::where('product_id',$id)->get();
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
          $product_filter->product_id = $id;
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
      // dd($request->product_type);
      if ($request->product_type == 'configurable')
      {
        $product_variants = ProductVariants::where('product_id',$id)->get()->toArray();
        $product_variants_ids = array_column($product_variants, 'product_variant_id');
        if (isset($request->added_variants))
        {
          $added_product_variants_ids = array_column($request->added_variants, 'product_variant_id');
          $update_result=array_diff($product_variants_ids,$added_product_variants_ids);
          if (count($update_result)>0)
          {
            ProductVariants::destroy($update_result);
          }
          $added_variants = $request->added_variants;
          foreach ($added_variants as $added_variant)
          {
            // dd($added_variant);
            $variant_id = $added_variant['product_variant_id'];
            $added_variant_products = ProductVariants::findOrFail($variant_id);
            $added_variant_products->fill($added_variant);
            $added_variant_products->update();
          }
        }
        else
        {
          if ($product_variants)
          {
            $product_variants->each->delete();
          }
        }

        if (isset($request->variants))
        {
          $variants = $request->variants;
          foreach ($variants as $variant)
          {
            $variant_products = new ProductVariants();
            $variant_products->fill($variant);
            $variant_products->category_slug = $categories->category_slug;
            $variant_products->category_id = $categories->category_id;
            $variant_products->sub_category_slug = $sub_categories->sub_category_slug;
            $variant_products->sub_category_id = $sub_categories->subcategory_id;
            $variant_products->sub_sub_category_slug = $sub_sub_categories->sub_sub_category_slug;
            $variant_products->sub_sub_category_id = $sub_sub_categories->sub_subcategory_id;
            $variant_products->product_id = $products->product_id;
            $variant_products->save();
          }
        }


      }
      if($products->update())
      {

      }
      Session::flash('message', 'Product updated!');
      Session::flash('status', 'success');

      return redirect('admin/products');
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
        $products = Products::findOrFail($id);
        $product_images = ProductImages::where('product_id',$id)->get();
        if ($product_images)
        {
          $product_images->each->delete();
        }
        $filter_values = ProductFilters::where('product_id',$id)->get();
        if ($filter_values)
        {
          $filter_values->each->delete();
        }
        $product_variants = ProductVariants::where('product_id',$id)->get();
        if ($product_variants)
        {
          $product_variants->each->delete();
        }
        $products->delete();

        Session::flash('message', 'Product deleted!');
        Session::flash('status', 'success');

        return redirect('admin/products');
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
      // $sizes = Sizes::whereIn('size_id',$data['size_id'])->get();
      // $subsubcategory_list = collect($subsubcategory)->mapWithKeys(function ($item, $key) {
      //     return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
      //   });
      // dd($data);
      $sku = $data['product_sku'];

      $product_price = $data['product_price'];
      $variants = '';
      if ($data['product_type']=='configurable')
      {
        // $variants = '<table>';
        // $variants = '<tbody>';
        $variants_cnt = 0;
        if (isset($data['size_id']) && $data['size_id'] != '')
        {
          $sizes = Sizes::whereIn('size_id',$data['size_id'])->get();
        }

        foreach ($colors as $color)
        {
          if (isset($data['size_id']) && $data['size_id'] != '' && !empty($sizes))
          {
            foreach ($sizes as $size)
            {
              $variants .= '<tr data-repeater-item>';
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
              $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
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
          else
          {
            $variants .= '<tr data-repeater-item>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_sku]" class="form-control" value="'.$sku.'-variant-'.$color->color_id.'" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_title]" class="form-control" value="" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][color_id]" value="'.$color->color_id.'">';
            $variants .= $color->color_name;
            $variants .= '</td>';
            $variants .= '<td>-';
            $variants .= '<input type="hidden" name="variants['.$variants_cnt.'][size_id]" value="">';
            // $variants .= $size->size_name;
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_qty]" class="form-control" value="" required>';
            $variants .= '</td>';
            $variants .= '<td>';
            $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
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
      $product_price = $data['product_price'];
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
        $variants .= '<input type="text" name="variants['.$variants_cnt.'][product_price]" class="form-control" value="'.$product_price.'" required>';
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
      $products = ProductImages::findOrFail($id);

      $products->delete();

      Session::flash('message', 'Product Image deleted!');
      Session::flash('status', 'success');

      return redirect('admin/products/edit/'.$products->product_id);
    }

    public function getbrands(Request $request)
    {
      $data = $request->all();
      $brands = Brands::where('manufacturer_id',$data['manufacturer_id'])->get();

      $options = "<option value=''>Please Select</option>";

      foreach ($brands as $key => $value)
      {
        $options .= "<option value='".$value['brand_id']."'>".$value['brand_name']."</option>";
      }
      if (count($brands)==0)
      {
        $options .= "<option value=''>No Record Found</option>";
      }
      return $options;
    }

}
