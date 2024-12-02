@extends('backend.layouts.app')
@section('title', 'Edit Product Variant')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Product Variant</h5>
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
                  <h4 class="card-title">Edit Product Variant</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($products, [
                        'method' => 'POST',
                        'url' => ['admin/productvariants/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        <div class="row">

                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::hidden('product_id', $products->product_id,['id'=>'product_id']) }}
                              {{ Form::hidden('product_type', $products->product_type,['id'=>'product_type']) }}
                              {{ Form::hidden('product_variant_id', $products->product_variant_id,['id'=>'product_variant_id']) }}
                              {{ Form::label('product_title', 'Product Title ') }}
                              {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_sku', 'Product SKU ') }}
                              {{ Form::text('product_sku', null, ['class' => 'form-control', 'placeholder' => 'Enter Product SKU', 'required' => true,'id'=>'product_sku']) }}
                            </div>
                          </div>
                            <div class="col-md-6 col-12" id="sim_color_div_edit" style="display:none;">
                              {{ Form::label('color_id', 'Colors ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('color_id', $color_list, null,['class'=>'select2 form-control ','id'=>'sim_color_id']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12" id="sim_size_div_edit" style="display:none;">
                              {{ Form::label('size_id', 'Sizes ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('size_id', $size_list, null,['class'=>'select2 form-control ', 'id'=>'sim_size_id']) }}
                                </div>
                              </fieldset>
                            </div>



                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_price', 'Product Price ') }}
                                {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'required' => true,'id'=>'product_price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_discount_type', 'Discount Type ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('product_discount_type', ['percent'=>'Percent','flat'=>'Flat'] , null,['class'=>'select2 form-control ','id'=>'product_discount_type']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discount', 'Product Discount ') }}
                                {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount','id'=>'product_discount', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                                {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price','id'=>'product_discounted_price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_qty', 'Product Quantity ') }}
                                {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_weight', 'Product Weight(gms) *') }}
                                {{ Form::number('product_weight', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Weight', ]) }}
                              </div>
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
                                {{ Form::label('product_thumb', 'Product Thumbnail *') }}
                                <div class="custom-file">
                                  {{ Form::file('product_thumb', ['class' => 'custom-file-input','id'=>'product_thumb']) }}
                                  <label class="custom-file-label" for="product_thumb">Choose file</label>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="row mt-1"> -->
                              @if(isset($products->product_thumb))
                                <div class="col-xl-3 col-md-3 img-top-card">
                                    <div class="card widget-img-top">
                                      <div class="card-content">
                                        <h6>Thumbnail</h6>
                                        <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_variant_thumbs/') }}/{{ $products->product_thumb }}" alt="Product Image">
                                      </div>

                                    </div>
                                  </div>
                              @endif
                            <!-- </div> -->
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_images', 'Product Images *') }}
                                <div class="custom-file">
                                  {{ Form::file('product_images[]', ['class' => 'custom-file-input','id'=>'product_images','multiple'=>'multiple']) }}
                                  <label class="custom-file-label" for="product_images">Choose file</label>
                                </div>
                              </div>
                            </div>


                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                          </div>
                        </div>
                      </div>
                    {{ Form::close() }}
                    @if(isset($product_images) && count($product_images)>0)
                    <h4>Product Variant Images</h4>
                    <div class="row mt-1">
                        @foreach($product_images as $product_image_id => $image_name)
                          <div class="col-xl-3 col-md-3 img-top-card">
                            <div class="card widget-img-top">
                              <div class="card-content">
                                <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_variant_images/') }}/{{ $image_name }}" alt="Product Image">
                              </div>
                              <div class="card-footer text-center">
                                {!! Form::open([
                                    'method'=>'GET',
                                    'url' => ['admin/productvariants/deleteimage', $product_image_id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                {!! Form::close() !!}
                                <!-- <button type="button" class="btn btn-primary glow px-4">Delete</button> -->
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </div>
                    @endif

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
              url: '{{url("admin/productvariants/getsubcategory")}}',
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
              url: '{{url("admin/productvariants/getsubsubcategory")}}',
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
                url: '{{url("admin/productvariants/getproductvariants")}}',
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
        // $('#onshowbtn').on('click',function(){
        //   // console.log('done');
        //   // $('#onshow').removeData();
        //   // $("#onshow").val(null).trigger("change");
        // });
        var variants_cnt = 0 ;
        $('#modal_add_variants').on('click',function(){
          // $('#onshow').removeData();
          var color_id = $("#variant_color_id").val();
          var size_id = $("#variant_size_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          var product_id = $("#product_id").val();
          var added_variants = $('input[name^="variants"]').serialize();
          // var added_variants1 = $('input[name^="variants"]').toArray();
          // $("input[name^='variants']").each(function() {
          //   console.log('test'+$(this).product_sku+'-'+$(this).val());
          // });
          console.log(added_variants);
          // for (key in added_variants1) {
          //   // console.log(key);
          // }
          if (color_id !='' && size_id !='')
          {
            $.ajax({
                url: '{{url("admin/productvariants/addproductvariants")}}',
                type: 'post',
                data:
                {
                  id: product_id, color_id: color_id, size_id: size_id,
                  variants_cnt: variants_cnt, product_sku: product_sku,
                  added_variants: added_variants, _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function (data)
                {
                  console.log(data['flag']);
                  // $('#variantsdiv').show();
                  // $('#variantstable').html(data);
                  // $('#sim_color_div').hide();
                  // $('#sim_size_div').hide();
                  if (data.flag == "new")
                  {

                    console.log(data);
                    $('#variantstable').append(data['table']);
                    variants_cnt++;
                  }
                  else
                  {
                    console.log(data);
                    // $('#variant_toast').toast("show");
                    // toastr.warning("Variant with same attribute options already exists.");
                    $('#variant_toast').modal('show');

                  }
                }
             });
          }
          else
          {
            alert('Please Select Variants');
          }
          $('#onshow').modal('hide');
        });

        //product discount price calculation
        $("#product_price,#product_discount,#product_discount_type").change(function()
        {
          var product_price = $("#product_price").val();
          var product_discount = $("#product_discount").val();
          var product_discount_type = $("#product_discount_type").val();
          // console.log(product_discount);
          var product_discounted_price = 0;
          if(product_price !='' && product_discount !='')
          {
            if (product_discount_type=='percent')
            {
              product_discounted_price = product_price - ((product_price*product_discount)/100);
            }
            else
            {
              product_discounted_price = product_price - product_discount;
            }

            if (product_discounted_price <= 0)
            {
              alert('Product Discount cannot be greater than or equals to Product Price');
              // alert('Product Discount Price cannot be less than or equals to Zero');
              $("#product_discounted_price").val('');
            }
            else
            {
              product_discounted_price = Math.round(product_discounted_price);
              $("#product_discounted_price").val(product_discounted_price);
            }
          }
          else if(product_price !='' && product_discount =='')
          {
            $("#product_discounted_price").val(product_price);
          }
          else
          {

          }
        });
      });
    </script>
@endsection
