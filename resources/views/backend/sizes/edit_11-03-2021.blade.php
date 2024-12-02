@extends('backend.layouts.app')
@section('title', 'Update Sizes')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Sizes</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Update
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
                  <a href="{{ route('admin.sizes') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Sizes</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($size, [
                        'method' => 'POST',
                        'url' => ['admin/sizes/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::hidden('size_id', $size->size_id) }}
                              {{ Form::label('size_name', 'Size Name ') }}
                              {{ Form::text('size_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Size Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('size_type', 'Size Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('size_type', $size_types, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Size Type','id'=>'size_type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('size_code', 'Size Value ') }}
                              {{ Form::text('size_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Size Value', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="length_in_div">
                            <div class="form-group">
                              {{ Form::label('length_in', 'Lenght(inch) ') }}
                              {{ Form::text('length_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Lenght(inch)']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="chest_in_div">
                            <div class="form-group">
                              {{ Form::label('chest_in', 'Chest(inch) ') }}
                              {{ Form::text('chest_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Chest(inch)']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="shoulder_in_div">
                            <div class="form-group">
                              {{ Form::label('shoulder_in', 'Shoulder(inch) ') }}
                              {{ Form::text('shoulder_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Shoulder(inch)']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="sleeve_lenght_in_div">
                            <div class="form-group">
                              {{ Form::label('sleeve_lenght_in', 'Sleeve Length ') }}
                              {{ Form::text('sleeve_lenght_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Sleeve Length']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="waist_in_div">
                            <div class="form-group">
                              {{ Form::label('waist_in', 'Waist(inch) ') }}
                              {{ Form::text('waist_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Waist(inch)']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="neck_in_div">
                            <div class="form-group">
                              {{ Form::label('neck_in', 'Neck ') }}
                              {{ Form::text('neck_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Neck']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="hip_in_div">
                            <div class="form-group">
                              {{ Form::label('hip_in', 'Hip ') }}
                              {{ Form::text('hip_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Hip']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12" style="display:none;" id="inseam_length_in_div">
                            <div class="form-group">
                              {{ Form::label('inseam_length_in', 'Inseam Length ') }}
                              {{ Form::text('inseam_length_in', null, ['class' => 'form-control', 'placeholder' => 'Enter Inseam Length']) }}
                            </div>
                          </div>


                          <div class="col-12 d-flex justify-content-start">
                            <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
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
  $(document).ready(function(){
    var load_size_type = $('#size_type').val();
    if(load_size_type != '')
    {
      size_fields(size_type);
    }
    $('#size_type').on('change',function(){
      var size_type = $(this).val();
      size_fields(size_type);
    });
  });
  function size_fields(size_type)
  {
    if (size_type == 'upper')
    {
      //shirt t-shirt tops kurtas
      $('#length_in_div').show();
      $('#chest_in_div').show();
      $('#shoulder_in_div').show();
      $('#sleeve_lenght_in_div').show();
      $('#waist_in_div').show();
      $('#neck_in_div').show();
      $('#hip_in_div').show();
      $('#inseam_length_in_div').hide();
    }
    else if (size_type == 'lower')
    {
      //jeans
      $('#length_in_div').hide();
      $('#chest_in_div').hide();
      $('#shoulder_in_div').hide();
      $('#sleeve_lenght_in_div').hide();
      $('#waist_in_div').show();
      $('#neck_in_div').hide();
      $('#hip_in_div').show();
      $('#inseam_length_in_div').show();
    }
    else if (size_type == 'shoes')
    {
      //footware
      $('#length_in_div').show();
      $('#chest_in_div').hide();
      $('#shoulder_in_div').hide();
      $('#sleeve_lenght_in_div').hide();
      $('#waist_in_div').hide();
      $('#neck_in_div').hide();
      $('#hip_in_div').hide();
      $('#inseam_length_in_div').hide();
    }
    else
    {
      //none
      $('#length_in_div').hide();
      $('#chest_in_div').hide();
      $('#shoulder_in_div').hide();
      $('#sleeve_lenght_in_div').hide();
      $('#waist_in_div').hide();
      $('#neck_in_div').hide();
      $('#hip_in_div').hide();
      $('#inseam_length_in_div').hide();
    }
  }
</script>
@endsection
