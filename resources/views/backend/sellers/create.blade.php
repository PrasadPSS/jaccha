@extends('backend.layouts.app')
@section('title', 'Create Seller')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Seller</h5>
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
                  <a href="{{ route('admin.sellers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Seller</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.sellers.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('seller_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Seller Name', 'required' => true]) }}
                              {{ Form::label('seller_name', 'Seller Name *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::email('seller_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Seller Email', 'required' => true]) }}
                              {{ Form::label('seller_email', 'Seller Email *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('seller_mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Seller Mobile No', 'required' => true]) }}
                              {{ Form::label('seller_mobile_no', 'Seller Mobile No *') }}
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <fieldset class="form-label-group">
                                {{ Form::textarea('seller_address', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Address', 'required' => true, 'rows'=>3]) }}
                                {{ Form::label('seller_address', 'Seller Address *') }}
                            </fieldset>
                            <!-- , 'data-length'=>200 -->
                            <!-- <small class="counter-value float-right"><span class="char-count">0</span> / 200 </small> -->
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
