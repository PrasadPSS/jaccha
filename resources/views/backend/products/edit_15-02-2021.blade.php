@extends('backend.layouts.app')
@section('title', 'Edit Product')

@section('content')
@php
$status = ['No'=>'No','Yes'=>'Yes'];
$product_types = ['simple'=>'Simple','configurable'=>'Configurable'];

@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Product</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Edit
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <section id="multiple-column-form">
          <div class="row match-height">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Edit Product</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($products, [
                        'method' => 'POST',
                        'url' => ['admin/products/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_sku', 'Product SKU ') }}
                              {{ Form::text('product_sku', null, ['class' => 'form-control', 'placeholder' => 'Enter Product SKU', 'required' => true,'id'=>'product_sku']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('product_type', 'Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('product_type', $product_types , null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Type','id'=>'product_type','disabled'=>'disabled']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::hidden('product_id', $products->product_id) }}
                              {{ Form::label('product_title', 'Product Title ') }}
                              {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_sub_title', 'Product Sub Title ') }}
                                {{ Form::text('product_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sub Title', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12" id="sim_color_div_edit" style="display:none;">
                              {{ Form::label('color_id', 'Colors ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('color_id[]', $color_list, null,['class'=>'select2 form-control ','id'=>'sim_color_id']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12" id="sim_size_div_edit" style="display:none;">
                              {{ Form::label('size_id', 'Sizes ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('size_id[]', $size_list, null,['class'=>'select2 form-control ', 'id'=>'sim_size_id']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12" id="config_color_div_edit" style="display:none;">
                              {{ Form::label('color_id', 'Colors ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('color_id[]', $color_list, explode(',',$products->color_id),['class'=>'select2 form-control ','multiple'=>'multiple','id'=>'config_color_id']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12" id="config_size_div_edit" style="display:none;">
                              {{ Form::label('size_id', 'Sizes ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('size_id[]', $size_list, explode(',',$products->color_id),['class'=>'select2 form-control ', 'multiple'=>'multiple','id'=>'config_size_id']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-1 repeater-default"  id="variantsdiv">
                              <div class="form-group">
                                <div class="col p-0">
                                  <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                    Add
                                  </button>
                                </div>
                              </div>
                              <table class="table table-responsive table-bordered ">
                                <thead>
                                  <tr>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="variantstable" data-repeater-list="group-a">
                                  @if(isset($product_variants) && count($product_variants)>0)
                                    @foreach($product_variants as $product_variant)
                                      <tr data-repeater-item>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_sku]" class="form-control" value="{{ $product_variant->product_sku }}">
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_title]" class="form-control" value="{{ $product_variant->product_title }}">
                                        </td>
                                        <td>
                                          <input type="hidden" name="added_variants[{{ $product_variant->product_variant_id }}][color_id]" value="{{ $product_variant->color_id }}">
                                          {{ $product_variant->color_id }}
                                        </td>
                                        <td>
                                          <input type="hidden" name="added_variants[{{ $product_variant->product_variant_id }}][size_id]" value="{{ $product_variant->size_id }}">
                                          {{ $product_variant->size_id }}
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_qty]" class="form-control" value="{{ $product_variant->product_qty }}">
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_price]" class="form-control" value="{{ $product_variant->product_price }}">
                                        </td>
                                        <td>
                                          <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button">
                                            <i class="bx bx-x"></i>
                                          </button>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_price', 'Product Price ') }}
                                {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                                {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discount', 'Product Discount ') }}
                                {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_qty', 'Product Quantity ') }}
                                {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity', ]) }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_desc', 'Product Description ') }}
                                {{ Form::textarea('product_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'id'=>'editor2']) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('category_id', 'Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('category_id', $categories, $products->category_id,['class'=>'select2 form-control category', 'placeholder' => 'Please Select Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_category_id', 'Sub Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('sub_category_id', $sub_categories, $products->sub_category_id,['class'=>'select2 form-control subcategory', 'placeholder' => 'Please Select Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_sub_category_id', 'Sub Sub Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('sub_sub_category_id', $sub_sub_categories, $products->sub_sub_category_id,['class'=>'select2 form-control subsubcategory', 'placeholder' => 'Please Select Sub Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_generic_name', 'Product Generic Name ') }}
                              {{ Form::text('product_generic_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Generic Name', ]) }}
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 mt-1">
                            <fieldset class="form-group">
                              {{ Form::label('product_specification', 'Specifications *') }}
                                {{ Form::textarea('product_specification', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id'=>'editor']) }}
                            </fieldset>
                          </div>
                          <div class="col-lg-12 col-md-12 mt-1">
                            <fieldset class="form-group">
                              {{ Form::label('product_disclaimer', 'Disclaimer *') }}
                                {{ Form::textarea('product_disclaimer', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id'=>'editor1']) }}
                            </fieldset>
                          </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('country_id', 'Country ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('country_id', $countries, $products->country_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Country',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('seller_id', 'Seller ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('seller_id', $sellers, $products->seller_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Seller',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('manufacturer_id', 'Manufacturere ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('manufacturer_id', $manufacturers, $products->manufacturer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Manufacturere',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('packer_id', 'Packer ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('packer_id', $packers, $products->packer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Packer',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('importer_id', 'Importer ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('importer_id', $importers, $products->importer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Importer',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-6">
                              {{ Form::label('visibility', 'Show / Hide') }}
                              <fieldset class="">
                                <div class="radio radio-success">
                                  {{ Form::radio('visibility','1',true,['id'=>'radioshow']) }}
                                  {{ Form::label('radioshow', 'Yes') }}
                                </div>
                              <!-- </fieldset>
                              <fieldset> -->
                                <div class="radio radio-danger">
                                  {{ Form::radio('visibility','0',false,['id'=>'radiohide']) }}
                                  {{ Form::label('radiohide', 'No') }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-12 col-12">
                              {{ Form::label('filter_id', 'Filters ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('filter_id[]', $filter_list, $filter_values,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Filters','multiple'=>'multiple']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_images', 'Product Banner *') }}
                                <div class="custom-file">
                                  {{ Form::file('product_images[]', ['class' => 'custom-file-input','id'=>'product_images','multiple'=>'multiple']) }}
                                  <label class="custom-file-label" for="product_images">Choose file</label>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="col-md-12 mt-1"> -->
                              @if(isset($product_images) && count($product_images)>0)
                                @foreach($product_images as $product_image_id => $image_name)
                                  <div class="col-xl-3 col-md-3 img-top-card">
                                    <div class="card widget-img-top">
                                      <div class="card-content">
                                        <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_images/') }}/{{ $image_name }}" alt="Product Image">
                                      </div>
                                      <div class="card-footer text-center">
                                        <button type="button" class="btn btn-primary glow px-4">Delete</button>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @endif
                            <!-- </div> -->

                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                          </div>
                        </div>
                      </div>
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <script>
      $(document).ready(function()
      {
        // if ($(".category").val() != '')
        // {
        //   subcategories($(".category").val());
        // }
        $(".category").change(function(){
          var category_id = $(this).val();
          subcategories(category_id);
        });
        $(".subcategory").change(function(){
          var subcategory_id = $(this).val();
          var category_id = $(".category").val();
            console.log(subcategory_id);
          subsubcategories(category_id,subcategory_id);
        });
        function subcategories(category_id)
        {
          $.ajax({
              url: '{{url("admin/products/getsubcategory")}}',
              type: 'post',
              data:
              {
                category_id: category_id ,_token: "{{ csrf_token() }}",
              },
              success: function (data)
              {
                //console.log(data);
                $('.subcategory').html(data);
                $('.subsubcategory').html('');
              }
           });
        }
        function subsubcategories(category_id,subcategory_id)
        {
          $.ajax({
              url: '{{url("admin/products/getsubsubcategory")}}',
              type: 'post',
              data:
              {
                category_id: category_id, subcategory_id: subcategory_id, _token: "{{ csrf_token() }}",
              },
              success: function (data)
              {
                //console.log(data);
                $('.subsubcategory').html(data);
              }
           });
        }

        var load_size_id = $("#config_size_id").val();
        var load_color_id = $("#config_color_id").val();

        var load_product_sku = $("#product_sku").val();
        var load_product_type = $("#product_type").val();
        if(load_product_type !='' && load_product_sku !='')
        {
          productconfiguration(load_product_type,load_product_sku);
        }

        $("#product_type").change(function()
        {
          var product_type = $(this).val();
          var product_sku = $("#product_sku").val();
          // console.log(product_type);
          if(product_type !='' && product_sku !='')
          {
            productconfiguration(product_type,product_sku);
          }
        });
        $("#product_sku").change(function()
        {
          var product_sku = $(this).val();
          var product_type = $("#product_type").val();
          // console.log(product_type);
          if(product_type !='' && product_sku !='')
          {
            productconfiguration(product_type,product_sku);
          }
        });

        function productconfiguration(product_type,product_sku)
        {
          // alert('in');
          if (product_type == 'configurable')
          {
            $('#config_color_div').show();
            $('#config_size_div').show();
            $('#sim_color_div').hide();
            $('#sim_size_div').hide();
          }
          else
          {
            $('#config_color_div').hide();
            $('#config_size_div').hide();
            $('#variantsdiv').hide();
            $('#variantstable').html('');
            $('#sim_color_div').show();
            $('#sim_size_div').show();
          }
        }

        $("#config_color_id").change(function()
        {
          var color_id = $(this).val();
          var size_id = $("#config_size_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          // console.log(color_id);
          if(color_id !='' && size_id !='' && product_type !='' && product_sku !='')
          {
            getproductvariants(color_id,size_id,product_type,product_sku);
          }
        });
        $("#config_size_id").change(function()
        {
          var size_id = $(this).val();
          var color_id = $("#config_color_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          // console.log(color_id);
          if(color_id !='' && size_id !='' && product_type !='' && product_sku !='')
          {
            getproductvariants(color_id,size_id,product_type,product_sku);
          }
        });
        function getproductvariants(color_id,size_id,product_type,product_sku)
        {
          if (product_type == 'configurable')
          {
            $.ajax({
                url: '{{url("admin/products/getproductvariants")}}',
                type: 'post',
                data:
                {
                  color_id: color_id, size_id: size_id,product_type: product_type, product_sku: product_sku, _token: "{{ csrf_token() }}",
                },
                success: function (data)
                {
                  //console.log(data);
                  $('#variantsdiv').show();
                  $('#variantstable').html(data);
                  $('#sim_color_div').hide();
                  $('#sim_size_div').hide();
                }
             });
          }
          else
          {
            $('#variantsdiv').hide();
            $('#variantstable').html('');
            $('#config_color_div').hide();
            $('#config_size_div').hide();
            $('#sim_color_div').show();
            $('#sim_size_div').show();
          }
        }
      });
    </script>
@endsection
