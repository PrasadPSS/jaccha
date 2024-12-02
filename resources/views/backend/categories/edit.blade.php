@extends('backend.layouts.app')
@section('title', 'Edit Caterory')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Caterory</h5>
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
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($categories, [
                        'method' => 'POST',
                        'url' => ['admin/categories/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::hidden('category_id', $categories->category_id) }}
                              {{ Form::label('category_name', 'Category Name *') }}
                              {{ Form::text('category_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('category_description', 'Category Description *') }}
                              {{ Form::text('category_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Description', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('text_color', 'Text Color') }}
                              {{ Form::text('text_color', null, ['class' => 'form-control', 'placeholder' => 'Enter Text Color', ]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('drop_down_menu_text_color', 'Dropdown Menu Text Color') }}
                              {{ Form::text('drop_down_menu_text_color', null, ['class' => 'form-control', 'placeholder' => 'Enter Dropdown Menu Text Color',]) }}
                            </div>
                          </div>
                          
                          <div class="col-md-3 col-6">
                            {{ Form::label('has_subcategories', 'Has Subcategories ?') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('has_subcategories','1',true,['id'=>'radioyes']) }}
                                {{ Form::label('radioyes', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('has_subcategories','0',false,['id'=>'radiono']) }}
                                {{ Form::label('radiono', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-3 col-6">
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
