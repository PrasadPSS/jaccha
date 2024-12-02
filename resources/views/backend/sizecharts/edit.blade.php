  @extends('backend.layouts.app')
@section('title', 'Edit Size Chart')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Size Chart</h5>
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
                  <h4 class="card-title">Edit Size Chart</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($sizecharts, [
                        'method' => 'POST',
                        'url' => ['admin/sizecharts/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::hidden('size_chart_id', $sizecharts->size_chart_id,['id'=>'size_chart_id']) }}
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
                                  {{ Form::select('size_ids[]', $sizes, isset($sizecharts->size_ids)?explode(',',$sizecharts->size_ids):'',['class'=>'select2 form-control ','id'=>'size_ids', 'multiple'=>'multiple']) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-lg-12 col-md-12 mt-1 repeater-default" style="display:block;" id="sizechartdiv">
                              <h3>Size Chart(Inches) </h3>
                              <table class="table table-responsive table-bordered">
                                <thead id="sizeheaders">
                                  @if(isset($size_chart_types))
                                    </tr>
                                      <th>Size</th>
                                      @foreach ($size_chart_types as $size_chart_type)
                                        <th>
                                        {{ $size_chart_type->size_chart_field_name }}
                                        </th>
                                      @endforeach
                                      <th>Action</th>
                                    </tr>
                                  @endif
                                </thead>
                                <tbody id="sizecharttable" data-repeater-list="chartchilds">
                                  @if(isset($sizechart_childs) && count($sizechart_childs)>0)
                                  @foreach($sizechart_childs as $chart_child)
                                    @if(isset($size_chart_types))
                                      <tr data-repeater-item id="tr-{{ $chart_child->size_id }}">
                                        <td>
                                          <input type="hidden" name="chartchilds[{{ $chart_child->size_id }}][size_chart_child_id]" value="{{ $chart_child->size_chart_child_id }}">
                                        <input type="hidden" name="chartchilds[{{ $chart_child->size_id }}][size_id]" value="{{ $chart_child->size_id }}">
                                        <input type="hidden" name="chartchilds[{{ $chart_child->size_id }}][size_type]" value="{{ $chart_child->size_type }}">
                                        {{ isset($chart_child->size->size_name)?$chart_child->size->size_name:'' }}
                                        </td>
                                        @foreach ($size_chart_types as $size_chart_type)
                                          <td>
                                            <input type="text" name="chartchilds[{{ $chart_child->size_id }}][{{ $size_chart_type->size_chart_field_code }}]" class="form-control" value="{{ $chart_child->{$size_chart_type->size_chart_field_code} }}" required>
                                          </td>
                                        @endforeach
                                        <td>
                                          <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"><i class="bx bx-x"></i></button>
                                        </td>
                                      </tr>

                                    @endif
                                    @endforeach
                                  @else
                                    <tr><td colspan="4">Chart Record Not Found</td></tr>
                                  @endif

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
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                          </div>
                        </div>
                      </div>
                    {{ Form::close() }}
                    <h4>Size Chart Images</h4>
                    <div class="row mt-1">
                      @if(isset($size_chart_images) && count($size_chart_images)>0)
                        @foreach($size_chart_images as $size_chart_image_id => $image_name)

                          <div class="col-xl-3 col-md-3 img-top-card">
                            <div class="card widget-img-top">
                              <div class="card-content">
                                <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/size_chart_images/') }}/{{ $image_name }}" alt="Size Chart Image">
                              </div>
                              <div class="card-footer text-center">
                                {!! Form::open([
                                    'method'=>'GET',
                                    'url' => ['admin/sizecharts/deleteimage', $size_chart_image_id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        @endforeach
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
        function sizechartchilds1(size_type,size_ids)
        {
          // alert('in');
          if (size_type == 'upper')
          {
            $('#sizechartdiv').show();

            // $('#trupper').show();
            // $('#trlower').hide();
            // $('#trshoes').hide();
          }
          else if (size_type == 'lower')
          {
            $('#sizechartdiv').show();

          //   $('#trupper').hide();
          //   $('#trlower').show();
          //   $('#trshoes').hide();
          }
          else if (size_type == 'shoes')
          {
            $('#sizechartdiv').show();

            // $('#trupper').hide();
            // $('#trlower').hide();
            // $('#trshoes').show();
          }
          else
          {
            $('#sizechartdiv').hide();
            $('#sizecharttable').html('');
            // $('#trupper').show();
            // $('#trlower').hide();
            // $('#trshoes').hide();

          }
        }

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
                //console.log(data);
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
