@extends('backend.layouts.app')
@section('title', 'Create Company')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Company</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Company
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
                  <a href="{{ route('admin.company') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Company</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.company.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('name', 'Company Name *') }}
                              {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('email', 'Company Email *') }}
                              {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Email', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('mobile_no', 'Company Phone Number *') }}
                              {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Start Date', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('pincode', 'Pin Code *') }}
                              {{ Form::text('pincode', null, ['class' => 'form-control', 'placeholder' => 'Enter Pin Code', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('state', 'Coupon Value *') }}
                              {{ Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Value', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('country', 'Coupon Purchase Limit *') }}
                              {{ Form::text('coupon_purchase_limit', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Purchase Limit', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            {{ Form::label('address', 'Coupon Description *') }}
                            <fieldset class="form-group">
                              {{ Form::textarea('copoun_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Coupon Description', 'required' => true, 'rows'=>3]) }}
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('gstno', 'Coupon Usage Limit *') }}
                              {{ Form::text('coupon_usage_limit', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Usage Limit', 'required' => true]) }}
                            </div>
                          </div>

                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('bankdetail', 'Coupon Usage Limit *') }}
                              {{ Form::text('coupon_usage_limit', null, ['class' => 'form-control', 'placeholder' => 'Enter Coupon Usage Limit', 'required' => true]) }}
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
