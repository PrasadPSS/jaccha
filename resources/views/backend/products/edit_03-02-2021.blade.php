@extends('backend.layouts.app')
@section('title', 'Edit Product')

@section('content')
@php
$status = ['No'=>'No','Yes'=>'Yes'];

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
                        <h2>General</h2>
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('product_id', $products->product_id) }}
                                {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                                {{ Form::label('product_title', 'Product Title ') }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sub Title', ]) }}
                                {{ Form::label('product_sub_title', 'Product Sub Title ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', ]) }}
                                {{ Form::label('product_price', 'Product Price ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price', ]) }}
                                {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount', ]) }}
                                {{ Form::label('product_discount', 'Product Discount ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity', ]) }}
                                {{ Form::label('product_qty', 'Product Quantity ') }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'required' => true]) }}
                                {{ Form::label('product_desc', 'Product Description ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('category_id', 'Category ',['class'=>'input-group-text']) }}
                                </div>
                                {{ Form::select('category_id', $categories, $products->category_id,['class'=>'select2 form-control category', 'placeholder' => 'Please Select Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_category_id', 'Sub Category ',['class'=>'input-group-text']) }}
                                </div>
                                {{ Form::select('sub_category_id', $sub_categories, $products->sub_category_id,['class'=>'select2 form-control subcategory', 'placeholder' => 'Please Select Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_sub_category_id', 'Sub Sub Category ',['class'=>'input-group-text']) }}
                                </div>
                                {{ Form::select('sub_sub_category_id', $sub_sub_categories, $products->sub_sub_category_id,['class'=>'select2 form-control subsubcategory', 'placeholder' => 'Please Select Sub Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>

                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_material', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Material', ]) }}
                                {{ Form::label('product_material', 'Product Material ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_fit_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Fit Type', ]) }}
                                {{ Form::label('product_fit_type', 'Product Fit Type ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_pattern', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Pattern', ]) }}
                                {{ Form::label('product_pattern', 'Product Pattern ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_neck_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Neck Type', ]) }}
                                {{ Form::label('product_neck_type', 'Product Neck Type ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_sleeve_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sleeve Type', ]) }}
                                {{ Form::label('product_sleeve_type', 'Product Sleeve Type ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_sleeve_length', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sleeve Length', ]) }}
                                {{ Form::label('product_sleeve_length', 'Product Sleeve Length ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Type', ]) }}
                                {{ Form::label('product_type', 'Product Type ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_length', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Length', ]) }}
                                {{ Form::label('product_length', 'Product Length ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_occasion', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Occasion', ]) }}
                                {{ Form::label('product_occasion', 'Product Occasion ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_fabric_transparency', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Fabric Trasparency', ]) }}
                                {{ Form::label('product_fabric_transparency', 'Product Fabric Trasparency ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_stretch', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Stretch', ]) }}
                                {{ Form::label('product_stretch', 'Product Stretch ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_closure', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Closure', ]) }}
                                {{ Form::label('product_closure', 'Product Closure ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_distress', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Distress', ]) }}
                                {{ Form::label('product_distress', 'Product Distress ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_waist_rise', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Waist Rise', ]) }}
                                {{ Form::label('product_waist_rise', 'Product Waist Rise ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_waist_band', 'Product Waist Band ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('product_waist_band', $status, $products->product_waist_band,['class'=>'select2 form-control ', 'placeholder' => 'Please Select',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_collar', 'Product Collar ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('product_collar', $status, $products->product_collar,['class'=>'select2 form-control ', 'placeholder' => 'Please Select',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_style', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Style', ]) }}
                                {{ Form::label('product_style', 'Product Style ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_fade', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Fade', ]) }}
                                {{ Form::label('product_fade', 'Product Fade ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_shade', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Shade', ]) }}
                                {{ Form::label('product_shade', 'Product Shade ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_basic_trend', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Basic Trend', ]) }}
                                {{ Form::label('product_basic_trend', 'Product Basic Trend ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_suitable_season', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Suitable Season', ]) }}
                                {{ Form::label('product_suitable_season', 'Product Suitable Season ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_no_of_pkt', null, ['class' => 'form-control', 'placeholder' => 'Enter Product No Of Pockets', ]) }}
                                {{ Form::label('product_no_of_pkt', 'Product No Of Pockets ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_ideal_for', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Ideal For', ]) }}
                                {{ Form::label('product_ideal_for', 'Product Ideal For ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_set_of', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Set Of', ]) }}
                                {{ Form::label('product_set_of', 'Product Set Of ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_weight', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Weight', ]) }}
                                {{ Form::label('product_weight', 'Product Weight ') }}
                              </div>
                            </div>
                            <div class="col-md-4 col-12">
                              <div class="form-label-group">
                                {{ Form::text('package_length', null, ['class' => 'form-control', 'placeholder' => 'Enter Package Length', ]) }}
                                {{ Form::label('package_length', 'Package Length ') }}
                              </div>
                            </div>
                            <div class="col-md-4 col-12">
                              <div class="form-label-group">
                                {{ Form::text('package_width', null, ['class' => 'form-control', 'placeholder' => 'Enter Package Width', ]) }}
                                {{ Form::label('package_width', 'Package Width ') }}
                              </div>
                            </div>
                            <div class="col-md-4 col-12">
                              <div class="form-label-group">
                                {{ Form::text('package_height', null, ['class' => 'form-control', 'placeholder' => 'Enter Package Height', ]) }}
                                {{ Form::label('package_height', 'Package Height ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_eligible_for_return', 'Product Eligible for return ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('product_eligible_for_return', $status, $products->product_eligible_for_return,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Eligibility for return',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_wash_instructions', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Wash Instructions', ]) }}
                                {{ Form::label('product_wash_instructions', 'Product Wash Instructions ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-label-group">
                                {{ Form::text('product_generic_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Generic Name', ]) }}
                                {{ Form::label('product_generic_name', 'Product Generic Name ') }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('country_id', 'Country ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('country_id', $countries, $products->country_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Country',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('seller_id', 'Seller ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('seller_id', $sellers, $products->seller_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Seller',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('manufacturer_id', 'Manufacturere ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('manufacturer_id', $manufacturers, $products->manufacturer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Manufacturere',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('packer_id', 'Packer ',['class'=>'input-group-text']) }}
                                  </div>
                                  {{ Form::select('packer_id', $packers, $products->packer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Packer',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('importer_id', 'Importer ',['class'=>'input-group-text']) }}
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
      });
    </script>
@endsection
