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
            <h5 class="content-header-title float-left pr-1 mb-0">Edit Website Logo</h5>
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
              <a href="{{ route('admin.homepagesections.logo') }}" class="btn btn-outline-secondary float-right"><i
                  class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
              <h4 class="card-title">Edit Website Logo</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                @include('backend.includes.errors')
                <form method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.homepagesections.logo.update') }}" class="form">
                  {{ csrf_field() }}

                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-12 col-12">
                        <div class="form-group">
                          {{ Form::label('logo', 'Website Logo *') }}
                          <div class="custom-file">
                            {{ Form::file('logo', ['class' => 'custom-file-input', 'id' => 'product_images']) }}
                            <label class="custom-file-label" for="product_images">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                      <div class="form-group">
                      <img src="{{asset('/assets/images/' . $logo->logo_path)}}" alt="">
                      </div>
                      </div>

                      <div class="col-12 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
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