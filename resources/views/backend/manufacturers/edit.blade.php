@extends('backend.layouts.app')
@section('title', 'Update Manufacturers')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Manufacturers</h5>
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
                  <a href="{{ route('admin.manufacturers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Manufacturers</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($manufacturer, [
                        'method' => 'POST',
                        'url' => ['admin/manufacturers/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('manufacturer_id', $manufacturer->manufacturer_id) }}
                                {{ Form::text('manufacturer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Manufacturer Name', 'required' => true]) }}
                                {{ Form::label('manufacturer_name', 'Manufacturer Name *') }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                {{ Form::email('manufacturer_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Manufacturer Email', 'required' => true]) }}
                                {{ Form::label('manufacturer_email', 'Manufacturer Email *') }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                {{ Form::text('manufacturer_mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Manufacturer Mobile No', 'required' => true]) }}
                                {{ Form::label('manufacturer_mobile_no', 'Manufacturer Mobile No *') }}
                              </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                              <fieldset class="form-label-group">
                                  {{ Form::textarea('manufacturer_address', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Address', 'required' => true, 'rows'=>3]) }}
                                  {{ Form::label('manufacturer_address', 'Manufacturer Address *') }}
                              </fieldset>
                              <!-- , 'data-length'=>200 -->
                              <!-- <small class="counter-value float-right"><span class="char-count">0</span> / 200 </small> -->
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
@endsection
