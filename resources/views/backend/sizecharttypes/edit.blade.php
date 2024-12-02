@extends('backend.layouts.app')
@section('title', 'Update Size Chart Type')

@section('content')
@php
$type_sort = [1,3,12,6,2,5,4,8,10,7,11,9,13];
$size_chart_field_list = $size_chart_field_list->sortBy(function ($value, $key) use ($type_sort) {
  return array_search($key, $type_sort);
});
//dd($size_chart_field_list->all());
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Update Size Chart Type</h5>
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
                  <a href="{{ route('admin.sizecharttypes') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Size Chart Type</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($size_chart_type, [
                        'method' => 'POST',
                        'url' => ['admin/sizecharttypes/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('size_chart_type_id', $size_chart_type->size_chart_type_id) }}
                                {{ Form::label('size_chart_type_name', 'Size Chart Type Name *') }}
                                {{ Form::text('size_chart_type_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Size Chart Type Name', 'required' => true]) }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('size_chart_field_id', 'Size Chart Fields ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('size_chart_field_id[]', $size_chart_field_list, isset($size_chart_type->size_chart_field_id)?explode(',',$size_chart_type->size_chart_field_id):'',['class'=>'select2 form-control ', 'id'=>'size_chart_field_id','multiple'=>'multiple']) }}
                                </div>
                              </fieldset>
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
