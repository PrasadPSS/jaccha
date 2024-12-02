@extends('backend.layouts.app')
@section('title', 'Create Featured Product')

@section('content')
@php
$faq_types = ['default'=>'Default','price'=>'Price','color'=>'Color','size'=>'Size'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Featured Product</h5>
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
                  <a href="{{ route('admin.homepagefeaturedproducts') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Featured Product</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.homepagefeaturedproducts.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('home_page_featured_product_name', 'Featured Product Name *') }}
                              {{ Form::text('home_page_featured_product_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Featured Product Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('home_page_featured_product_type', 'Product Selection Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('home_page_featured_product_type', ['manual'=>'Manual','auto'=>'Automatic'], null,['class'=>'select2 form-control', 'placeholder' => 'Please Select Type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('product_id', 'Products ',['class'=>'']) }}
                                </div>
                                {{ Form::select('product_id[]', $products, null,['class'=>'select2 form-control product','multiple'=>true]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12 ">
                            <div class="form-group">
                              {{ Form::label('sort_order', 'Sort Order *') }}
                              {{ Form::text('sort_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sort Order', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-6">
                            {{ Form::label('visibility', 'Show / Hide') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('visibility','1',true,['id'=>'radioshow']) }}
                                {{ Form::label('radioshow', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('visibility','0',false,['id'=>'radiohide']) }}
                                {{ Form::label('radiohide', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-12 d-flex justify-content-start mt-2">
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
