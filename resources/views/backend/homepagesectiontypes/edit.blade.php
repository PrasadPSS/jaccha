@extends('backend.layouts.app')
@section('title', 'Update Home Page Section Type')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Home Page Section Type</h5>
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
                  <a href="{{ route('admin.homepagesectiontypes') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Home Page Section Type</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($home_page_section_type, [
                        'method' => 'POST',
                        'url' => ['admin/homepagesectiontypes/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('home_page_section_type_id', $home_page_section_type->home_page_section_type_id) }}
                                {{ Form::label('home_page_section_type_name', 'Home Page Section Type Name *') }}
                                {{ Form::text('home_page_section_type_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Page Section Type Name', 'required' => true]) }}
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('home_page_section_field_id', 'Select Fields ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('home_page_section_field_id[]', $home_page_section_field_list, isset($home_page_section_type->home_page_section_field_id)?explode(',',$home_page_section_type->home_page_section_field_id):'',['class'=>'select2 form-control ', 'id'=>'home_page_section_field_id','multiple'=>'multiple']) }}
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
