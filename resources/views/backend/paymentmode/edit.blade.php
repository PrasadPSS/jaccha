@extends('backend.layouts.app')
@section('title', 'Edit Payment Mode')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Payment Mode</h5>
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
                  <a href="{{ route('admin.paymentmode') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Edit Payment Mode ({{ $paymentmode->payment_mode_code }})</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.paymentmode.update') }}" class="form">
                      {{ csrf_field() }}
                      {{ Form::hidden('payment_mode_id', $paymentmode->payment_mode_id) }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('payment_mode_name', 'Payment Mode *') }}
                              {{ Form::text('payment_mode_name',$paymentmode->payment_mode_name , ['class' => 'form-control', 'placeholder' => 'Enter Payment Mode', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('status', 'Status *') }}
                              {{ Form::select('status',[1=>'Active', 0=>'InActive'],$paymentmode->status, array('class' =>'form-control','id'=>'status','placeholder'=>'Select Status','required'=> true)) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('default_selected', 'Default Selected *') }}
                              {{ Form::select('default_selected',[1=>'Active', 0=>'InActive'],$paymentmode->default_selected, array('class' =>'form-control','id'=>'status','placeholder'=>'Select Default_Selected','required'=> true)) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('priority', 'Priority *') }}
                              {{ Form::text('priority',$paymentmode->priority , ['class' => 'form-control', 'placeholder' => 'Enter Priority', 'required' => true]) }}
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
