@extends('backend.layouts.app')
@section('title', 'Update COD')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update COD</h5>
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
                  <a href="{{ route('admin.codmanagement') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update COD</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                      {!! Form::model($cod_management, [
                        'method' => 'POST',
                        'url' => ['admin/codmanagement/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::hidden('cod_management_id', $cod_management->cod_management_id) }}
                              {{ Form::label('cod_purchase_min_limit', 'COD Min Purchase Limit *') }}
                              {{ Form::text('cod_purchase_min_limit', null, ['class' => 'form-control', 'placeholder' => 'Enter COD Min Purchase Limit', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('cod_purchase_max_limit', 'COD Max Purchase Limit *') }}
                              {{ Form::text('cod_purchase_max_limit', null, ['class' => 'form-control', 'placeholder' => 'Enter COD Max Purchase Limit', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-3 col-12">
                            <div class="form-group">
                              {{ Form::label('cod_collection_charge', 'COD (Cash) Collection Charge *') }}
                              {{ Form::text('cod_collection_charge', null, ['class' => 'form-control', 'placeholder' => 'Enter COD (Cash) Collection Charge', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-3 col-12">
                            <div class="form-group">
                              {{ Form::label('cod_cgst_percent', 'COD CGST Percent *') }}
                              {{ Form::text('cod_cgst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter COD CGST Percent', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-3 col-12">
                            <div class="form-group">
                              {{ Form::label('cod_sgst_percent', 'COD SGST Percent *') }}
                              {{ Form::text('cod_sgst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter COD SGST Percent', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-3 col-12">
                            <div class="form-group">
                              {{ Form::label('cod_igst_percent', 'COD IGST Percent *') }}
                              {{ Form::text('cod_igst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter COD IGST Percent', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('status', 'Status *') }}
                              {{ Form::select('status', ['1'=>'Active','0'=>'Deactive'], null, ['class'=>'select2 form-control']) }}
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
