  @extends('backend.layouts.app')
@section('title', 'Edit Home Page Section')

@section('content')
@php
$status = ['No'=>'No','Yes'=>'Yes'];
$size_types = ['upper'=>'Uppers','lower'=>'Lowers','shoes'=>'Shoes'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Home Page Section</h5>
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
                  <h4 class="card-title">Edit Home Page Section</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($homepagesections, [
                        'method' => 'POST',
                        'url' => ['admin/homepagesections/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::hidden('home_page_section_id', $homepagesections->home_page_section_id,['id'=>'home_page_section_id']) }}
                              {{ Form::label('home_page_section_name', 'Home Page Section Name') }}
                              {{ Form::text('home_page_section_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Name', 'required' => true]) }}
                            </div>
                          </div>
                          
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('home_page_section_type_id', 'Section Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('home_page_section_type_id', $home_page_section_type_list, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Section Type','id'=>'home_page_section_type_id']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_no_prod', 'Home Page Section No of Items to be Display') }}
                              {{ Form::number('home_page_section_no_prod', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section No of Items to be Display', 'min'=>'1']) }}
                            </div>
                          </div>
                          @if($homepagesections->home_page_section_code == 'HeroSection')
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('home_page_section_product', 'Product ',['class'=>'']) }}
                                </div>
                                {{ Form::select('home_page_section_product', $products, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Product','id'=>'home_page_section_products']) }}
                              </div>
                            </fieldset>
                          </div>
                          @endif
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_title', 'Home Page Section Title') }}
                              {{ Form::text('home_page_section_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Title']) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_section_sub_title', 'Home Page Section Sub Title') }}
                              {{ Form::text('home_page_section_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Sub Title']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" id="start_date_div">
                            {{ Form::label('home_page_section_start_date', 'Start Date ') }}
                            <fieldset class="form-group position-relative has-icon-left">
                              {{ Form::text('home_page_section_start_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Select Date', 'required' => true]) }}
                              <div class="form-control-position">
                                <i class='bx bx-calendar'></i>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12" id="end_date_div">
                            {{ Form::label('home_page_section_end_date', 'End Date ') }}
                            <fieldset class="form-group position-relative has-icon-left">
                              {{ Form::text('home_page_section_end_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Select Date', 'required' => true]) }}
                              <div class="form-control-position">
                                <i class='bx bx-calendar'></i>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12" id="footer_title_div" style="display:none;">
                            <div class="form-group">
                              {{ Form::label('home_page_section_footer_title', 'Home Page Section Footer Title') }}
                              {{ Form::text('home_page_section_footer_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Footer Title']) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12" id="footer_sub_title_div" style="display:none;">
                            <div class="form-group">
                              {{ Form::label('home_page_section_footer_sub_title', 'Home Page Section Footer Sub Title') }}
                              {{ Form::text('home_page_section_footer_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Footer Sub Title']) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12" id="url_div" style="display:none;">
                            <div class="form-group">
                              {{ Form::label('home_page_section_url', 'Home Page Section URL') }}
                              {{ Form::text('home_page_section_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section URL']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-6 mb-2">
                            {{ Form::label('visibility', 'Show / Hide') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('visibility','1',true,['id'=>'radioshow']) }}
                                {{ Form::label('radioshow', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('visibility','0',false,['id'=>'radiohide']) }}
                                {{ Form::label('radiohide', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-6">
                            <div class="form-group">
                              {{ Form::label('home_page_section_priority', 'Home Page Section Priority') }}
                              {{ Form::number('home_page_section_priority', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Priority']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-6">
                            <div class="form-group">
                              {{ Form::label('padding_top', 'Home Page Section Top Padding') }}
                              {{ Form::text('padding_top', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Top Padding']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-6">
                            <div class="form-group">
                              {{ Form::label('padding_bottom', 'Home Page Section Bottom Padding') }}
                              {{ Form::text('padding_bottom', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Bottom Padding']) }}
                            </div>
                          </div>


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

        var home_page_section_type_id_load = $("#home_page_section_type_id").val();
        showtrending(home_page_section_type_id_load);

        $("#home_page_section_type_id").change(function()
        {
          var home_page_section_type_id = $(this).val();
          showtrending(home_page_section_type_id);
        });

        function showtrending(home_page_section_type_id)
        {
          if(home_page_section_type_id =='8')
          {
            $("#footer_title_div").show();
            $("#footer_sub_title_div").show();
            $("#url_div").show();
            $("#start_date_div").show();
            $("#end_date_div").show();
          }
          else
          {
            $("#footer_title_div").hide();
            $("#footer_sub_title_div").hide();
            $("#url_div").hide();
            $("#start_date_div").hide();
            $("#end_date_div").hide();
          }
        }


      });
    </script>
@endsection
