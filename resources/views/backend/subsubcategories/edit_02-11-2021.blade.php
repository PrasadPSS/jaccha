@extends('backend.layouts.app')
@section('title', 'Update Sub Category')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Update Sub Category</h5>
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
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Sub Category</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($subsubcategories, [
                        'method' => 'POST',
                        'url' => ['admin/subsubcategories/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('sub_subcategory_id', $subsubcategories->sub_subcategory_id) }}
                              {{ Form::text('sub_subcategory_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Sub Sub Category Name', 'required' => true]) }}
                              {{ Form::label('sub_subcategory_name', 'Sub Sub Category Name *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('sub_subcategory_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Sub Sub Category Description', 'required' => true]) }}
                              {{ Form::label('sub_subcategory_description', 'Sub Sub Category Description *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::select('category_id', $category_list, null,['class'=>'select2 form-control category']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::select('subcategory_id', [], null,['class'=>'select2 form-control subcategory']) }}
                            </div>
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
    <script>
      $(document).ready(function(){
        if ($(".category").val() != '')
        {
          subcategories($(".category").val());
        }
        $(".category").change(function(){
          var category_id = $(this).val();
          subcategories(category_id);
        });
      function subcategories(category_id)
      {
        $.ajax({
          url: '{{url("admin/subsubcategories/getsubcategory")}}',
          type: 'post',
          data: {
                   category_id: category_id ,_token: "{{ csrf_token() }}",
               },
         success: function (data) {
           //console.log(data);
           $('.subcategory').html(data);
         }
    });
      }
      });
    </script>
@endsection
