@extends('backend.layouts.app')
@section('title', 'Create Hsn Code')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create Hsn Code</h5>
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
                  <a href="{{ url('admin/hsncodes') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Hsn Code</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.hsncodes.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('hsncode_name', 'Hsn Code  *') }}
                              {{ Form::text('hsncode_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Hsn Code ', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('category_id', 'Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('category_id', $categories, null,['class'=>'select2 form-control category', 'placeholder' => 'Please Select Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('subcategory_id', 'Sub Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('subcategory_id', $sub_categories, null,['class'=>'select2 form-control subcategory', 'placeholder' => 'Please Select Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          
                          
                          <!--<div class="col-lg-12 col-md-12">-->
                          <!--  <fieldset class="form-group">-->
                          <!--    {{ Form::label('hsncode_desc', 'Hsn Code Description *') }}-->
                          <!--      {{ Form::textarea('hsncode_desc', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Description', 'rows'=>3]) }}-->
                          <!--  </fieldset>-->
                          <!--</div>-->

                          <div class="col-12 d-flex justify-content-start">
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
<script>
  $(document).ready(function()
  {
    // if ($(".category").val() != '')
    // {
    //   subcategories($(".category").val());
    // }
    $(".category").change(function(){
      // alert('test');
      var category_id = $(this).val();
      subcategories(category_id);
    });
    $(".subcategory").change(function(){
      var subcategory_id = $(this).val();
      var category_id = $(".category").val();
      // console.log(subcategory_id);
      subsubcategories(category_id,subcategory_id);
    });
    function subcategories(category_id)
    {
      $.ajax({
          url: '{{url("admin/products/getsubcategory")}}',
          type: 'post',
          data:
          {
            category_id: category_id ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            console.log(data);
            $('.subcategory').html(data);
            $('.subsubcategory').html('');
          }
        });
    }
    function subsubcategories(category_id,subcategory_id)
    {
      $.ajax({
          url: '{{url("admin/products/getsubsubcategory")}}',
          type: 'post',
          data:
          {
            category_id: category_id, subcategory_id: subcategory_id, _token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            //console.log(data);
            $('.subsubcategory').html(data);
          }
        });
    }
  });
</script>
@endsection
