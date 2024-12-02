@extends('backend.layouts.app')
@section('title', 'Update First Level Contents')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update First Level Contents</h5>
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
                  <a href="{{ route('admin.productlisting') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update First Level Contents</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($filters, [
                        'method' => 'POST',
                        'url' => ['admin/productlisting/firstlevel/update'],
                        'class' => 'form'
                    ]) !!}
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          {{-- {{dd($filters->content_date)}} --}}
                          <div class="col-md-12 col-12">
                            {{ Form::hidden('category_id', $categories->category_id) }}
                            <div class="form-group">
                              {{ Form::label('content_date', 'Products Content Date *') }}
                              {{ Form::date('content_date', null, ['class' => 'form-control', 'id'=>'datepicker','placeholder' => 'Enter Products Content Date', 'required' => true]) }}
                            </div>
                          </div>

                          <div class="col-md-12 col-12" id="cms_pages_content_div">
                            <div class="form-group">
                              {{ Form::label('contents', 'Firstlevel Products Content *') }}
                              {{ Form::textarea('contents', null, ['class' => 'form-control', 'placeholder' => 'Enter Firstlevel Products Content', 'id'=>'editor2','required' => true]) }}
                            </div>
                          </div>
                     

                        
                              <div class="col-md-6 col-12">
                                <div class="form-group">
        
                                  {{ Form::label('meta_title', 'META TITLE *') }}
                                  {{ Form::Text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title']) }}
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="form-group">
        
                                  {{ Form::label('meta_desc', 'META DESCRIPTION *') }}
                                  {{ Form::Text('meta_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description']) }}
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="form-group">
        
                                  {{ Form::label('meta_keywords', 'META KEYWORDS *') }}
                                  {{ Form::Text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Keywords']) }}
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="form-group">
        
                                  {{ Form::label('og_title', 'OG TITLE *') }}
                                  {{ Form::Text('og_title', null, ['class' => 'form-control', 'placeholder' => 'Enter OG Title']) }}
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="form-group">
        
                                  {{ Form::label('og_desc', 'OG DESCRIPTION *') }}
                                  {{ Form::Text('og_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter OG Description']) }}
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
