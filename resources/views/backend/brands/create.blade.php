@extends('backend.layouts.app')
@section('title', 'Create Brand')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Brand</h5>
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
                  <a href="{{ url('admin/brands/index') }}/{{ $id }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Brand</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.brands.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('brand_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Brand Name', 'required' => true]) }}
                              {{ Form::label('brand_name', 'Brand Name *') }}
                            </div>
                          </div>

                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('manufacturer_id', 'Manufacturer ',['class'=>'']) }}
                                </div>
                                {{ Form::select('manufacturer_id', $manufacturers, $id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Manufacturer',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <fieldset class="form-label-group">
                                {{ Form::textarea('brand_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Description', 'rows'=>3]) }}
                                {{ Form::label('brand_desc', 'Brand Description *') }}
                            </fieldset>
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
@endsection
