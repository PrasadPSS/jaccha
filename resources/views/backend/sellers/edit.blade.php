@extends('backend.layouts.app')
@section('title', 'Update Sellers')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Sellers</h5>
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
                  <a href="{{ route('admin.sellers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Sellers</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($seller, [
                        'method' => 'POST',
                        'url' => ['admin/sellers/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('seller_id', $seller->seller_id) }}
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
