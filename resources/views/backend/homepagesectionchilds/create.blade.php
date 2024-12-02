@extends('backend.layouts.app')
@section('title', 'Create Home Page Section Child')

@section('content')
@php
  $product_types = ['simple'=>'Simple','configurable'=>'Configurable'];
  //dd($product_types1);
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Home Page Section Child</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Create
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
                  <h4 class="card-title">Create Home Page Section Child</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {{ Form::open(array('url' => 'admin/homepagesectionchilds/store','enctype' => 'multipart/form-data')) }}
                      <div class="form-body">
                        <div class="row">
                        @isset($home_page_section_type)
                          {{ Form::hidden('home_page_section_id', $homepagesections->home_page_section_id, ) }}
                          @if(in_array('title',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_title', 'Home Page Section Child Title ') }}
                              {{ Form::text('home_page_section_child_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Title', 'required' => true]) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('sub_title',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_sub_title', 'Home Page Section Child Sub Title ') }}
                              {{ Form::text('home_page_section_child_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Sub Title', ]) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('footer',$home_page_section_type))
                          <div class="col-lg-12 col-md-12 mt-1">
                            <fieldset class="form-group">
                              {{ Form::label('home_page_section_child_footer', 'Footer ') }}
                              {{ Form::textarea('home_page_section_child_footer', null, ['class' => 'form-control', 'placeholder' => 'Enter Footer', 'id'=>'editor']) }}
                            </fieldset>
                          </div>
                          @endif
                          @if(in_array('url',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_url', 'Home Page Section Child URL ') }}
                              {{ Form::text('home_page_section_child_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child URL', 'required' => true]) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('footer_title',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_footer_title', 'Home Page Section Child Footer Title') }}
                              {{ Form::text('home_page_section_child_footer_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Footer Title']) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('footer_sub_title',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_footer_sub_title', 'Home Page Section Child Footer Sub Title ') }}
                              {{ Form::text('home_page_section_child_footer_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Footer Sub Title', 'required' => true]) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('video_url',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_video_url', 'Home Page Section Child Video URL ') }}
                              {{ Form::text('home_page_section_child_video_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Video URL', 'required' => true]) }}
                            </div>
                          </div>
                          @endif
                          @if(in_array('images',$home_page_section_type))
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_child_images', 'Home Page Section Child Image *') }}
                              <div class="custom-file">
                                {{ Form::file('home_page_section_child_images', ['class' => 'custom-file-input','id'=>'product_images']) }}
                                <label class="custom-file-label" for="product_images">Choose file</label>
                              </div>
                            </div>
                          </div>
                          @endif
                          @endif

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
                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Save', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
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
              url: '{{url("admin/homepagesectionchilds/getsubcategory")}}',
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
              url: '{{url("admin/homepagesectionchilds/getsubsubcategory")}}',
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
                url: '{{url("admin/homepagesectionchilds/getproductvariants")}}',
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
