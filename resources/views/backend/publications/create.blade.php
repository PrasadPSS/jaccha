@extends('backend.layouts.app')
@section('title', 'Create Publication Page')

@section('content')
@php
$column_types = ['quick_links'=>'Quick Links','conntect_us'=>'Connect With Us On','our_policies'=>'Our Policies'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Publication</h5>
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
                  <a href="{{ route('admin.publications') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Publication </h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.publications.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('publications_title', 'Publication Title *') }}
                              {{ Form::text('publications_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Publication Title', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('publications_sub_title', 'Publication Sub Title *') }}
                              {{ Form::text('publications_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Publication Sub Title', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('publications_date', 'Publication Date *') }}
                                {{ Form::text('publications_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Enter Publication Date', 'required' => true]) }}
                              </div>
                            </div>

                          <!-- <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('column_type', 'Column ',['class'=>'']) }}
                                </div>
                                {{ Form::select('column_type', $column_types , null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Column','id'=>'column_type']) }}
                              </div>
                            </fieldset>
                          </div> -->
                          <div class="col-md-12 col-12" id="publications_content_div">
                            <div class="form-group">
                              {{ Form::label('publications_content', 'Publication Content *') }}
                              {{ Form::textarea('publications_content', null, ['class' => 'form-control', 'placeholder' => 'Enter Publication Content', 'id'=>'editor2']) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12" style="display:none;" id="publications_link_div">
                            <div class="form-group">
                              {{ Form::label('publications_link', 'External Links *') }}
                              {{ Form::text('publications_link', null, ['class' => 'form-control', 'placeholder' => 'Enter External Links',]) }}
                            </div>
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
<script>
$(document).ready(function()
{
  var load_column_type = $('#column_type').val();
  column_div(load_column_type);
  $('#column_type').on('change',function()
  {
    var column_type = $(this).val();
    column_div(column_type);
  });
  function column_div(column_type)
  {
    if (column_type == 'conntect_us')
    {
      $('#publications_link_div').show();
      $('#publications_content_div').hide();
    }
    else if (column_type == 'quick_links' || column_type == 'our_policies')
    {
      $('#publications_link_div').hide();
      $('#publications_content_div').show();
    }
    else
    {
      $('#publications_link_div').hide();
      $('#publications_content_div').show();
    }
  }
});
</script>
@endsection
