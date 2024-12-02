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
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Size Chart</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {{ Form::open(array('url' => 'admin/sizecharts/store','enctype' => 'multipart/form-data')) }}
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
                                {{ Form::select('size_type', $size_chart_type_list, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Size Type','id'=>'size_type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('size_ids', 'Sizes ',['class'=>'']) }}
                                </div>
                                {{ Form::select('size_ids[]', $sizes, null,['class'=>'select2 form-control ','id'=>'size_ids', 'multiple'=>'multiple']) }}
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-lg-12 col-md-12 mt-1 repeater-default" style="display:none;" id="sizechartdiv">
                            <h3>Size Chart(in Inches) </h3>
                            <table class="table table-responsive table-bordered">
                              <thead id="sizeheaders">

                              </thead>
                              <tbody id="sizecharttable" data-repeater-list="chartchilds">

                              </tbody>
                            </table>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <fieldset class="form-group">
                              {{ Form::label('size_chart_desc', 'Header Description') }}
                              {{ Form::textarea('size_chart_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Header Description', 'rows'=>3, 'id'=>'editor1']) }}
                            </fieldset>
                          </div>

                          <div class="col-lg-12 col-md-12">
                            <fieldset class="form-group">
                              {{ Form::label('size_chart_footer_desc', 'Footer Description') }}
                              {{ Form::textarea('size_chart_footer_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Footer Description', 'rows'=>3, 'id'=>'editor2']) }}
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

                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('size_chart_images', 'Size Chart Images *') }}
                              <div class="custom-file">
                                {{ Form::file('size_chart_images[]', ['class' => 'custom-file-input','id'=>'size_chart_images','multiple'=>'multiple']) }}
                                <label class="custom-file-label" for="size_chart_images">Choose file</label>
                              </div>
                            </div>
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
        $("#size_type").change(function()
        {
          var size_type = $(this).val();
          var size_ids = $("#size_ids").val();
          // $("#size_ids").html('');
          $("#sizecharttable").html('');
          // console.log(size_type);
          if(size_type !='' && size_ids !='')
          {
            sizechartchilds(size_type,size_ids);
          }
        });
        $("#size_ids").change(function()
        {
          var size_ids = $(this).val();
          var size_type = $("#size_type").val();
          // console.log(size_type);
          if(size_type !='' && size_ids !='')
          {
            sizechartchilds(size_type,size_ids);
          }
        });


        function sizechartchilds(size_type,size_ids)
        {

          var added_childs = $('input[name^="chartchilds"]').serialize();


          $.ajax({
              url: '{{url("admin/sizecharts/getsizechartchilds")}}',
              type: 'post',
              data:
              {
                size_type: size_type, added_childs: added_childs,
                size_ids: size_ids, _token: "{{ csrf_token() }}",
              },
              dataType: 'json',
              success: function (data)
              {
                console.log(data['header']);
                $('#sizechartdiv').show();
                if (data.flag == "new")
                {
                  $('#sizeheaders').html(data['header']);
                  $('#sizecharttable').html(data['table']);
                }
                else
                {
                  if (data.remove)
                  {
                    for (var i = 0; i < data.remove.length; i++)
                    {
                      $('#tr-'+data.remove[i]).remove();
                    }
                  }
                  $('#sizeheaders').html(data['header']);
                  $('#sizecharttable').append(data['table']);
                  // $('#sizecharttable').html(data);
                }


              }
           });
        }

      });
    </script>
@endsection
