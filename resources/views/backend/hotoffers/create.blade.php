@extends('backend.layouts.app')
@section('title', 'Create Hot Offers')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Hot Offers</h5>
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
                  <a href="{{ url('admin/hotoffers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Hot Offers</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.hotoffers.store') }}" class="form" enctype ="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('col_type', 'Column Type *') }}
                              {{ Form::select('col_type',['1'=>'1 Box','2'=>'2 Box','4'=>'4 Box'],'', array('class' => 'form-control','id'=>'col_type','placeholder'=>'Select Column Type','required'=> true)) }}
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('short_order', 'Short Order *') }}
                              {{ Form::number('short_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Short Order', 'required' => true,'min'=>1]) }}
                            </div>
                          </div>
                        </div>
                        <div class="row" id="first_image">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('first_image', 'First Image *') }}
                              <div class="custom-file">
                                {{ Form::file('first_image', ['class' => 'custom-file-input']) }}
                                <label class="custom-file-label" for="first_image">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('first_image_url', 'First Image Url *') }}
                              {{ Form::text('first_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row" id="second_image">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('second_image', 'Second Image *') }}
                              <div class="custom-file">
                                {{ Form::file('second_image', ['class' => 'custom-file-input']) }}
                                <label class="custom-file-label" for="second_image">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('second_image_url', 'Second Image Url *') }}
                              {{ Form::text('second_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row" id="third_image">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('third_image', 'Third Image *') }}
                              <div class="custom-file">
                                {{ Form::file('third_image', ['class' => 'custom-file-input']) }}
                                <label class="custom-file-label" for="third_image">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('third_image_url', 'Third Image Url *') }}
                              {{ Form::text('third_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row" id="fourth_image">
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('fourth_image', 'Fourth Image *') }}
                              <div class="custom-file">
                                {{ Form::file('fourth_image', ['class' => 'custom-file-input']) }}
                                <label class="custom-file-label" for="fourth_image">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              {{ Form::label('fourth_image_url', 'Fourth Image Url *') }}
                              {{ Form::text('fourth_image_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Image url']) }}
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
      $( document ).ready(function() {
        $("#first_image").hide();
        $("#second_image").hide();
        $("#third_image").hide();
        $("#fourth_image").hide();

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
