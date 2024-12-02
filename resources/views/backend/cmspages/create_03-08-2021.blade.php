@extends('backend.layouts.app')
@section('title', 'Create CMS Page')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Create CMS Page</h5>
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
                  <a href="{{ route('admin.cmspages') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create CMS Page</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.cmspages.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('cms_pages_title', 'CMS Page Title *') }}
                              {{ Form::text('cms_pages_title', null, ['class' => 'form-control', 'placeholder' => 'Enter CMS Page Title', 'required' => true]) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('column_type', 'Column ',['class'=>'']) }}
                                </div>
                                {{ Form::select('column_type', $column_types , null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Column','id'=>'column_type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12" id="cms_pages_content_div">
                            <div class="form-group">
                              {{ Form::label('cms_pages_content', 'CMS Page Content *') }}
                              {{ Form::textarea('cms_pages_content', null, ['class' => 'form-control', 'placeholder' => 'Enter CMS Page Content', 'id'=>'editor2']) }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12" style="display:none;" id="cms_pages_link_div">
                            <div class="form-group">
                              {{ Form::label('cms_pages_link', 'External Links *') }}
                              {{ Form::text('cms_pages_link', null, ['class' => 'form-control', 'placeholder' => 'Enter External Links',]) }}
                            </div>
                          </div>
                          <div class="col-md-4 col-4">
                            {{ Form::label('cms_pages_top', 'Display at Top') }}
                            <fieldset class="">
                              <div class="radio radio-success">
                                {{ Form::radio('cms_pages_top','1',true,['id'=>'radioshowtop']) }}
                                {{ Form::label('radioshowtop', 'Yes') }}
                              </div>
                            <!-- </fieldset>
                            <fieldset> -->
                              <div class="radio radio-danger">
                                {{ Form::radio('cms_pages_top','0',false,['id'=>'radiohidetop']) }}
                                {{ Form::label('radiohidetop', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-4 col-4">
                            {{ Form::label('cms_pages_footer', 'Display at Footer') }}
                            <fieldset class="">
                              <div class="radio radio-success">
                                {{ Form::radio('cms_pages_footer','1',true,['id'=>'radioshowfooter']) }}
                                {{ Form::label('radioshowfooter', 'Yes') }}
                              </div>
                            <!-- </fieldset>
                            <fieldset> -->
                              <div class="radio radio-danger">
                                {{ Form::radio('cms_pages_footer','0',false,['id'=>'radiohidefooter']) }}
                                {{ Form::label('radiohidefooter', 'No') }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-4 col-4">
                            {{ Form::label('show_hide', 'Show / Hide') }}
                            <fieldset class="">
                              <div class="radio radio-success">
                                {{ Form::radio('show_hide','1',true,['id'=>'radioshow']) }}
                                {{ Form::label('radioshow', 'Yes') }}
                              </div>
                            <!-- </fieldset>
                            <fieldset> -->
                              <div class="radio radio-danger">
                                {{ Form::radio('show_hide','0',false,['id'=>'radiohide']) }}
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
      $('#cms_pages_link_div').show();
      $('#cms_pages_content_div').hide();
    }
    else if (column_type == 'quick_links' || column_type == 'our_policies')
    {
      $('#cms_pages_link_div').hide();
      $('#cms_pages_content_div').show();
    }
    else
    {
      $('#cms_pages_link_div').hide();
      $('#cms_pages_content_div').show();
    }
  }
});
</script>
@endsection
