@extends('backend.layouts.app')
@section('title', 'Create Size Chart')

@section('content')
@php
$size_types = ['upper'=>'Uppers','lower'=>'Lowers','shoes'=>'Shoes'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Size Chart</h5>
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
                  <a href="{{ url('admin/sizecharts/index/') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Size Chart</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.sizecharts.store') }}" class="form" enctype='multipart/form-data'>
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('size_chart_name', 'Size Chart Name') }}
                              {{ Form::text('size_chart_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Size Chart Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('size_type', 'Size Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('size_type', $size_types, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Size Type','id'=>'size_type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('size_ids', 'Sizes ',['class'=>'']) }}
                                </div>
                                {{ Form::select('size_ids[]', $sizes, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Sizes','id'=>'size_ids', 'multiple'=>'multiple']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-lg-12 col-md-12 mt-1 repeater-default" style="display:block;" id="sizechartdiv">
                            <h3>Size Chart</h3>
                            <table class="table table-responsive table-bordered">
                              <thead>
                                <tr id="trupper" style="display:none;">
                                  <th>Size</th>
                                  <th>Length(inch)</th>
                                  <th>Chest/Bust(inch)</th>
                                  <th>Shoulder(inch)</th>
                                  <th>Sleeve Length(inch)</th>
                                  <th>Waist(inch)</th>
                                  <th>Neck(inch)</th>
                                  <th>Hip(inch)</th>
                                  <th>Inseam Length(inch)</th>
                                </tr>
                                <tr id="trlower" style="display:none;">
                                  <th>Size</th>
                                  <th>Length(inch)</th>
                                  <th>Chest/Bust(inch)</th>
                                  <th>Shoulder(inch)</th>
                                  <th>Sleeve Length(inch)</th>
                                  <th>Waist(inch)</th>
                                  <th>Neck(inch)</th>
                                  <th>Hip(inch)</th>
                                  <th>Inseam Length(inch)</th>
                                </tr>
                                <tr id="trshoes" style="display:none;">
                                  <th>Size</th>
                                  <th>Length(inch)</th>
                                  <th>Chest/Bust(inch)</th>
                                  <th>Shoulder(inch)</th>
                                  <th>Sleeve Length(inch)</th>
                                  <th>Waist(inch)</th>
                                  <th>Neck(inch)</th>
                                  <th>Hip(inch)</th>
                                  <th>Inseam Length(inch)</th>
                                </tr>
                              </thead>
                              <tbody id="sizecharttable" data-repeater-list="size_chart_childs">

                              </tbody>
                            </table>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <fieldset class="form-group">
                              {{ Form::label('size_chart_desc', 'Description') }}
                                {{ Form::textarea('size_chart_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Description', 'rows'=>3]) }}
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-6">
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
                            {{ Form::label('product_page_visibility', 'Show / Hide on Product Page') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('product_page_visibility','1',true,['id'=>'radioproshow']) }}
                                {{ Form::label('radioproshow', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('product_page_visibility','0',false,['id'=>'radioprohide']) }}
                                {{ Form::label('radioprohide', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12 mt-2">
                            <div class="form-group">
                              {{ Form::label('size_chart_image', 'Size Chart Images') }}
                              <div class="custom-file">
                                {{ Form::file('size_chart_image', ['class' => 'custom-file-input','id'=>'size_chart_image']) }}
                                <label class="custom-file-label" for="size_chart_image">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
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
    var load_size_type = $("#size_type1").val();
    sizes(load_size_type);
    $("#size_type").change(function(){
      var size_type = $(this).val();
      sizes(size_type);
    });
    function sizes(size_type)
    {
      $.ajax({
          url: '{{url("admin/sizecharts/getsizes")}}',
          type: 'post',
          data:
          {
            size_type: size_type ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            //console.log(data);
            $('#size_ids').html(data);
          }
       });
    }


  });
</script>
@endsection
