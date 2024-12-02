@extends('backend.layouts.app')
@section('title', 'Update Filter for First Level')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Filter for First Level</h5>
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
                  <a href="{{ url('admin/filterassign/') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Filter for First Level : {{ $categories->category_name }}</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($filters, [
                        'method' => 'POST',
                        'url' => ['admin/filterassign/firstlevel/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-group checkbox checkbox-primary">
                              {{ Form::hidden('category_id', $categories->category_id) }}
                              <input type="checkbox" id="ckbCheckAll" />
                              <label for="ckbCheckAll">Select All</label>
                            </div>
                          </div>
                          @foreach($filters as $filter)
                          @php
                            $filter_ids = [];
                            $filter_value_ids = [];
                            if(isset($assign_category_filters))
                            {
                              $filter_ids = explode(',',$assign_category_filters->filter_ids);
                              $filter_value_ids = explode(',',$assign_category_filters->filter_value_ids);
                            }
                          @endphp
                              <div class="col-md-12 col-12">

                                <h4 class="card-title">
                                  <div class="checkbox checkbox-primary">
                                    {{ Form::checkbox('filter_ids[]', $filter->filter_id, in_array($filter->filter_id,$filter_ids), ['id'=>'filter_ids['.$filter->filter_id.']','class'=>'filter_id_'.$filter->filter_id.' filter_check_all_values','data-id'=>$filter->filter_id]) }}
                                    {{ Form::label('filter_ids['.$filter->filter_id.']', $filter->filter_name) }}
                                  </div>
                                </h4>
                                <div class="col-md-12 col-12 mt-2 menu_permissions">
                                  <ul class="list-unstyled mb-0">
                                    @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
                                    @foreach($filter->filtervalues as $filtervalue)

                                    <li class="d-inline-block mr-2 mb-1">
                                      <fieldset>
                                        <div class="checkbox checkbox-primary">
                                          {{ Form::checkbox('filter_value_ids['.$filtervalue->filter_value_id.']', $filtervalue->filter_value_id, in_array($filtervalue->filter_value_id,$filter_value_ids), ['id'=>'filter_value_ids['.$filtervalue->filter_value_id.']','class'=>'filter_value_check filter_value_check_sub_value_'.$filter->filter_id,'data-id'=>$filter->filter_id]) }}
                                          
                                          @if($filter->filter_type=='color') 
                                            @if(isset($filtervalue) && $filtervalue->reference_data == 'multi')
                                              {{ Form::label('filter_value_ids['.$filtervalue->filter_value_id.']', ' ') }} 
                                              <img height="25" width="25" src="{{ asset('backend-assets/uploads/color_code/'.$filtervalue->filter_value) }}" alt="Color">
                                            @else 
                                            {{ Form::label('filter_value_ids['.$filtervalue->filter_value_id.']', ' ') }} 
                                            <span style="background-color: {{ $filtervalue->filter_value }}; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            @endif
                                            {{isset($colors[$filtervalue->filter_value])?'('.$colors[$filtervalue->filter_value].')':''}}
                                          @else 
                                            {{ Form::label('filter_value_ids['.$filtervalue->filter_value_id.']', $filtervalue->filter_value) }} 
                                          @endif
                                        </div>
                                      </fieldset>
                                    </li>
                                    @endforeach
                                    @endif
                                  </ul>
                                </div>
                                </div>
                          @endforeach

                          <div class="col-12 d-flex justify-content-start mt-2">
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

@section('scripts')
  <script>
    $(document).ready(function()
    {
      checkallcheckbox();
      $('.filter_check_all_values').on('change',function()
      {
        var filter_id = $(this).data('id');
        if($(this).prop('checked'))
        {
          $('.filter_value_check_sub_value_'+filter_id).prop('checked',true);
        }
        else
        {
          $('.filter_value_check_sub_value_'+filter_id).prop('checked',false);
        }
        checkallcheckbox();
        // alert(filter_id);
      });
      $('.filter_value_check').on('change',function()
      {
        var filter_id = $(this).data('id');
        if(!($('.filter_id_'+filter_id).prop('checked')))
        {
          $('.filter_id_'+filter_id).prop('checked',true);
        }

        checkallcheckbox();
      });

      $('#ckbCheckAll').on('change',function()
      {
        if(($(this).prop('checked')))
        {
          $('.filter_check_all_values').prop('checked',true);
          $('.filter_value_check').prop('checked',true);
        }
        else
        {
          $('.filter_check_all_values').prop('checked',false);
          $('.filter_value_check').prop('checked',false);
        }
        alert(filter_id);
      });

      function checkallcheckbox()
      {
        if ( $('.filter_value_check').length == $('.filter_value_check:checked').length) 
        // if ( $('.filter_value_check:checked').length>0 || $('.filter_check_all_values:checked').length>0) 
        {
          $('#ckbCheckAll').prop('checked',true);
        }
        else
        {
          $('#ckbCheckAll').prop('checked',false);
        }
      }
    });
  </script>                            
@endsection