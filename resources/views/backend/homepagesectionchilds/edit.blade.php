@extends('backend.layouts.app')
@section('title', 'Edit Home Page Section Child')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Home Page Section Child</h5>
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
                  <h4 class="card-title">Edit Home Page Section Child</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($home_page_section_child, [
                        'method' => 'POST',
                        'url' => ['admin/homepagesectionchilds/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        {{ Form::hidden('home_page_section_child_id', $home_page_section_child->home_page_section_child_id,['id'=>'home_page_section_child_id']) }}
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
                 
                                @if($homepagesections->home_page_section_name == 'Testimonials')

                                {{ Form::number('home_page_section_child_footer_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Footer Title']) }}
                                @else
                                {{ Form::text('home_page_section_child_footer_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Footer Title']) }}
                                @endif
                              </div>
                            </div>
                            @endif
                            @if(in_array('footer_sub_title',$home_page_section_type))
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('home_page_section_child_footer_sub_title', 'Home Page Section Child Footer Sub Title ') }}
                                {{ Form::text('home_page_section_child_footer_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Footer Sub Title']) }}
                              </div>
                            </div>
                            @endif
                            @if(in_array('video_url',$home_page_section_type))
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('home_page_section_child_video_url', 'Home Page Section Child Video URL ') }}
                                {{ Form::text('home_page_section_child_video_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Child Video URL']) }}
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

                            <div class="col-md-12 col-12">
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



                          <div class="col-12 d-flex justify-content-start mt-2">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                          </div>
                        </div>
                      </div>
                    {{ Form::close() }}
                    <h4> Images</h4>
                    <div class="row mt-3">
                      @if(isset($home_page_section_child->home_page_section_child_images))
                        <div class="col-xl-6 col-md-6 img-top-card">
                            <div class="card widget-img-top">
                              <div class="card-content">
                                <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/home_page_section_child_images/') }}/{{ $home_page_section_child->home_page_section_child_images }}" alt="Home Page Image">
                              </div>
                            </div>
                          </div>
                      @endif
                    </div>
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
            gethomepagesectionchilds(color_id,size_id,product_type,product_sku);
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
            gethomepagesectionchilds(color_id,size_id,product_type,product_sku);
          }
        });
        function gethomepagesectionchilds(color_id,size_id,product_type,product_sku)
        {
          if (product_type == 'configurable')
          {
            $.ajax({
                url: '{{url("admin/homepagesectionchilds/gethomepagesectionchilds")}}',
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
                url: '{{url("admin/homepagesectionchilds/addhomepagesectionchilds")}}',
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
      });
    </script>
@endsection
