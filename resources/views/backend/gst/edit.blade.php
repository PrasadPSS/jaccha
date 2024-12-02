@extends('backend.layouts.app')
@section('title', 'Update Gst')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Gst</h5>
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
                  <a href="{{ route('admin.gst') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Gst</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($gst, [
                        'method' => 'POST',
                        'url' => ['admin/gst/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::hidden('gst_id', $gst->gst_id) }}
                              {{ Form::label('gst_name', 'GST Name *') }}
                              {{ Form::text('gst_name', null, ['class' => 'form-control', 'placeholder' => 'Enter GST Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gst_min_price', 'GST Min. Price *') }}
                              {{ Form::number('gst_min_price', null, ['class' => 'form-control', 'placeholder' => 'Enter GST Min. Price', 'required' => true,'min'=>0]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gst_max_price', 'GST Max. Price *') }}
                              {{ Form::number('gst_max_price', null, ['class' => 'form-control', 'placeholder' => 'Enter GST Max. Price', 'required' => true,'min'=>1]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gst_cgst_percent', 'CGST Percent *') }}
                              {{ Form::text('gst_cgst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter CGST Percent', 'required' => true,'min'=>1]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gst_sgst_percent', 'SGST Percent *') }}
                              {{ Form::text('gst_sgst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter SGST Percent', 'required' => true,'min'=>1]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gst_igst_percent', 'IGST Percent *') }}
                              {{ Form::text('gst_igst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter IGST Percent', 'required' => true,'min'=>1]) }}
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
@endsection
