@extends('backend.layouts.app')
@section('title', 'Create Coupon')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Coupon</h5>
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
                  <a href="{{ route('admin.coupon') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Coupon</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.coupon.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('coupon_title', 'Coupon Name *') }}
                              {{ Form::text('coupon_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('coupon_code', 'Coupon Code *') }}
                              {{ Form::text('coupon_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Code', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::text('start_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Enter Start Date', 'required' => true]) }}
                              {{ Form::label('start_date', 'Start Date *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::text('end_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Enter End Date', 'required' => true]) }}
                              {{ Form::label('end_date', 'End Date *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('coupon_type', 'Type *') }}
                              {{ Form::select('coupon_type', ['flat'=>'Flat','percentage'=>'Percentage'], null, ['class'=>'select2 form-control']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('value', 'Coupon Value *') }}
                              {{ Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Value', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('status', 'Status *') }}
                              {{ Form::select('status', ['0'=>'Active','1'=>'Disable'], null, ['class'=>'select2 form-control']) }}
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
@endsection
