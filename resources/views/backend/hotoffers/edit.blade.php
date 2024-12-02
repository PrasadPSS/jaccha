@extends('backend.layouts.app')
@section('title', 'Edit Hot Offers')

@section('content')
@php

@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Hot Offers</h5>
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
                  <a href="{{ url('admin/hotoffers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Edit Hot Offers</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($hotoffers, [
                        'method' => 'POST',
                        'url' => ['admin/hotoffers/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      {{ csrf_field() }}
                          {{ Form::hidden('hotoffers_id', $hotoffers->hotoffers_id) }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('col_type', 'Column Type *') }}
                              {{ Form::select('col_type',['1'=>'1 Box','2'=>'2 Box','4'=>'4 Box'],null, array('class' => 'form-control','id'=>'col_type','placeholder'=>'Select Column Type','required'=> true)) }}
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('short_order', 'Short Order *') }}
                              {{ Form::number('short_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Short Order', 'required' => true,'min'=>1]) }}
                            </div>
                          </div>
                        </div>
                        <div class="card p-2" id="first_image" style="background: #eceeef;">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="card mx-auto mb-0">
                                <div class="card-content">
                                  <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffers->first_image }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="form-group">
                                {{ Form::label('first_image_url', 'First Image Url *') }}
                                {{ Form::text('first_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                              </div>
                              <div class="form-group">
                                {{ Form::hidden('first_image_old', $hotoffers->first_image) }}
                                {{ Form::label('first_image', 'First Image *') }}
                                <div class="custom-file">
                                  {{ Form::file('first_image', ['class' => 'custom-file-input']) }}
                                  <label class="custom-file-label" for="first_image">Choose file</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card p-2" id="second_image" style="background: #eceeef;">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="card mx-auto mb-0">
                                <div class="card-content">
                                  <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffers->second_image }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="form-group">
                                {{ Form::label('second_image_url', 'Second Image Url *') }}
                                {{ Form::text('second_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                              </div>
                              <div class="form-group">
                                {{ Form::hidden('second_image_old', $hotoffers->second_image) }}
                                {{ Form::label('second_image', 'Second Image *') }}
                                <div class="custom-file">
                                  {{ Form::file('second_image', ['class' => 'custom-file-input']) }}
                                  <label class="custom-file-label" for="second_image">Choose file</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card p-2" id="third_image" style="background: #eceeef;">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="card mx-auto mb-0">
                                <div class="card-content">
                                  <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffers->third_image }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="form-group">
                                {{ Form::label('third_image_url', 'Third Image Url *') }}
                                {{ Form::text('third_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                              </div>
                              <div class="form-group">
                                {{ Form::hidden('third_image_old', $hotoffers->third_image) }}
                                {{ Form::label('third_image', 'Third Image *') }}
                                <div class="custom-file">
                                  {{ Form::file('third_image', ['class' => 'custom-file-input']) }}
                                  <label class="custom-file-label" for="third_image">Choose file</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card p-2" id="fourth_image" style="background: #eceeef;">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="card mx-auto mb-0">
                                <div class="card-content">
                                  <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffers->fourth_image }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="form-group">
                                {{ Form::label('fourth_image_url', 'Fourth Image Url *') }}
                                {{ Form::text('fourth_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                              </div>
                              <div class="form-group">
                                {{ Form::hidden('fourth_image_old', $hotoffers->fourth_image) }}
                                {{ Form::label('fourth_image', 'Fourth Image *') }}
                                <div class="custom-file">
                                  {{ Form::file('fourth_image', ['class' => 'custom-file-input']) }}
                                  <label class="custom-file-label" for="fourth_image">Choose file</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 d-flex justify-content-start">
                          <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                          <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
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
      $( document ).ready(function() {
        $("#first_image").hide();
        $("#second_image").hide();
        $("#third_image").hide();
        $("#fourth_image").hide();

        var col_type_old = $("#col_type").val();
        if(col_type_old == 1)
        {
          $("#first_image").show();
          $("#second_image").hide();
          $("#third_image").hide();
          $("#fourth_image").hide();
        }else if(col_type_old == 2)
        {
          $("#first_image").show();
          $("#second_image").show();
          $("#third_image").hide();
          $("#fourth_image").hide();
        }else
        {
          $("#first_image").show();
          $("#second_image").show();
          $("#third_image").show();
          $("#fourth_image").show();
        }

        $('select').on('change', function() {
          var col_type = (this.value);
          // alert(col_type);
          if(col_type == 1)
          {
            $("#first_image").show();
            $("#second_image").hide();
            $("#third_image").hide();
            $("#fourth_image").hide();
          }else if(col_type == 2)
          {
            $("#first_image").show();
            $("#second_image").show();
            $("#third_image").hide();
            $("#fourth_image").hide();
          }else
          {
            $("#first_image").show();
            $("#second_image").show();
            $("#third_image").show();
            $("#fourth_image").show();
          }
        });

          
      });
    </script>

@endsection
