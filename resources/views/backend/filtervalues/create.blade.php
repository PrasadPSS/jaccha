@extends('backend.layouts.app')
@section('title', 'Create Filter Value')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Filter Value</h5>
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
                  <a href="{{ url('admin/filtervalues/index/'.$filter_id) }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Filter Value</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.filtervalues.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          {{ Form::hidden('filter_id', $filter_id) }}

                          @if($filter_type=='default')
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('filter_value', 'Filter Value *') }}
                              {{ Form::text('filter_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Value', 'required' => true]) }}
                            </div>
                          </div>
                          @elseif($filter_type=='size')
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('filter_value', 'Sizes ',['class'=>'']) }}
                                </div>
                                {{ Form::select('filter_value', $sizes, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Size',]) }}
                              </div>
                            </fieldset>
                          </div>
                          @elseif($filter_type=='color')
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('filter_value', 'Colors ',['class'=>'']) }}
                                </div>
                                {{ Form::select('filter_value', $colors, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Color',]) }}
                              </div>
                            </fieldset>
                          </div>
                          @elseif($filter_type=='material')
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('filter_value', 'Material ',['class'=>'']) }}
                                </div>
                                {{ Form::select('filter_value', $materials, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Material',]) }}
                              </div>
                            </fieldset>
                          </div>
                          @elseif($filter_type=='price')
                          <div class="col-md-4 col-12">
                            <div class="form-group">
                              {{ Form::label('filter_value', 'Filter Value *') }}
                              {{ Form::text('filter_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Value', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="form-group">
                              {{ Form::label('filter_min_value', 'Filter Min Value *') }}
                              {{ Form::text('filter_min_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Min Value', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="form-group">
                              {{ Form::label('filter_max_value', 'Filter Max Value *') }}
                              {{ Form::text('filter_max_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Max Value', 'required' => true]) }}
                            </div>
                          </div>
                          @elseif($filter_type=='discount')
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('filter_value', 'Filter Value *') }}
                                {{ Form::text('filter_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Value', 'required' => true]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('filter_min_value', 'Filter Percent *') }}
                                {{ Form::text('filter_min_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Percent', 'required' => true]) }}
                              </div>
                            </div>
                            @elseif($filter_type=='ratings')
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('filter_value', 'Filter Value *') }}
                                {{ Form::text('filter_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Value', 'required' => true]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('filter_min_value', 'Filter Rating *') }}
                                {{ Form::text('filter_min_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Rating', 'required' => true]) }}
                              </div>
                            </div>
                          @else
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('filter_value', 'Filter Value *') }}
                              {{ Form::text('filter_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Value', 'required' => true]) }}
                            </div>
                          </div>
                          @endif
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
                          <div class="col-md-6 col-6">
                            {{ Form::label('product_page_visibility', 'Show / Hide on Product Page') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('product_page_visibility','1',true,['id'=>'radioproshow']) }}
                                {{ Form::label('radioproshow', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('product_page_visibility','0',false,['id'=>'radioprohide']) }}
                                {{ Form::label('radioprohide', 'No') }}
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
