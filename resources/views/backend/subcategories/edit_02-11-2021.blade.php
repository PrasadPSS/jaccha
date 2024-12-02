@extends('backend.layouts.app')
@section('title', 'Create Sub Categorys')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Sub Category</h5>
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
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Sub Category</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($subcategories, [
                        'method' => 'POST',
                        'url' => ['admin/subcategories/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('subcategory_id', $subcategories->subcategory_id) }}
                              {{ Form::text('subcategory_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Sub Category Name', 'required' => true]) }}
                              {{ Form::label('subcategory_name', 'Sub Category Name *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('subcategory_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Sub Category Description', 'required' => true]) }}
                              {{ Form::label('subcategory_description', 'Sub Category Description *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::select('category_id', $category_list, null,['class'=>'select2 form-control']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-6">
                            {{ Form::label('has_sub_subcategories', 'Has Sub Subcategories ?') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('has_sub_subcategories','1',true,['id'=>'radioyes']) }}
                                {{ Form::label('radioyes', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('has_sub_subcategories','0',false,['id'=>'radiono']) }}
                                {{ Form::label('radiono', 'No') }}
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-12 d-flex justify-content-start">
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
