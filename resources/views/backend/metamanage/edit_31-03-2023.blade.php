@extends('backend.layouts.app')
@section('title', 'Create COD Limit')

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
            <h5 class="content-header-title float-left pr-1 mb-0">Create COD Limit</h5>
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
              <a href="{{ route('admin.dailycodlimit') }}" class="btn btn-outline-secondary float-right"><i
                  class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
              <h4 class="card-title">Create COD Limit</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                @include('backend.includes.errors')
                {!! Form::model($order_cancel, [
                'method' => 'POST',
                'url' => ['admin/metamanage/update'],
                'class' => 'form'
                ]) !!}
                <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-group">

                          {{ Form::label('meta_title', 'META TITLE *') }}
                          {{ Form::Text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title',
                          'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">

                          {{ Form::label('meta_desc', 'META DESCRIPTION *') }}
                          {{ Form::Text('meta_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description',
                          'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">

                          {{ Form::label('meta_keywords', 'META KEYWORDS *') }}
                          {{ Form::Text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Keywords',
                          'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">

                          {{ Form::label('og_title', 'OG TITLE *') }}
                          {{ Form::Text('og_title', null, ['class' => 'form-control', 'placeholder' => 'Enter OG Title',
                          'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">

                          {{ Form::label('og_desc', 'OG DESCRIPTION *') }}
                          {{ Form::Text('og_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter OG Description',
                          'required' => true]) }}
                        </div>
                      </div>
                      {{ Form::hidden('meta_id', $order_cancel->meta_id) }}
                      <div class="col-12 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
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