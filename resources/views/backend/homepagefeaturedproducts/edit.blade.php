@extends('backend.layouts.app')
@section('title', 'Update Featured Product')

@section('content')
@php
$home_page_featured_product_types = ['default'=>'Default','price'=>'Price','color'=>'Color','size'=>'Size'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Update Featured Product</h5>
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
                  <a href="{{ route('admin.homepagesections') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Featured Product</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($home_page_featured_product, [
                        'method' => 'POST',
                        'url' => ['admin/homepagefeaturedproducts/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::hidden('home_page_featured_product_id', $home_page_featured_product->home_page_featured_product_id) }}
                                {{ Form::label('home_page_featured_product_name', 'Featured Product Name *') }}
                                {{ Form::text('home_page_featured_product_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Featured Product Name', 'required' => true]) }}
                              </div>
                            </div>
                            <!-- <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('home_page_featured_product_type', 'Product Selection Type ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('home_page_featured_product_type', ['manual'=>'Manual','auto'=>'Automatic'], null,['class'=>'select2 form-control', 'placeholder' => 'Please Select Type']) }}
                                </div>
                              </fieldset>
                            </div> -->
                            <div class="col-md-12 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_id', 'Products ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('product_id[]', $products, isset($home_page_featured_product->product_id)?explode(',',$home_page_featured_product->product_id):'',['class'=>'select2 form-control product','multiple'=>true]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12 ">
                              <div class="form-group">
                                {{ Form::label('sort_order', 'Sort Order *') }}
                                {{ Form::text('sort_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sort Order', 'required' => true]) }}
                              </div>
                            </div>
                           
                          <div class="col-12 d-flex justify-content-start mt-2">
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
