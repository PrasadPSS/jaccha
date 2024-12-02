@extends('backend.layouts.app')
@section('title', 'Create COD Limit')

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
            <h5 class="content-header-title float-left pr-1 mb-0">Create COD Limit</h5>
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
              <a href="{{ route('admin.dailycodlimit') }}" class="btn btn-outline-secondary float-right"><i
                  class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
              <h4 class="card-title">Create COD Limit</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                @include('backend.includes.errors')
                {!! Form::model($order_cancel, [
                'method' => 'POST',
                'url' => ['admin/dailycodlimit/update'],
                'class' => 'form'
                ]) !!}
                <div class="form-body">
                  <div class="row">
                    {{-- <div class="col-md-6 col-12">
                      <fieldset class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            {{ Form::label('user_id', 'User ',['class'=>'']) }}
                          </div>
                          {{ Form::select('user_id', $user_list, null,['class'=>'select2 form-control ', 'placeholder'
                          => 'Please Select User Email','id'=>'user_id']) }}
                        </div>
                      </fieldset>
                    </div> --}}
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        {{ Form::label('status', 'Status *') }}
                        {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],$order_cancel->status,
                        array('class' =>
                        'form-control','id'=>'status','placeholder'=>'Select Status','required'=> true)) }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">

                        {{ Form::label('count', 'Cod Limit *') }}
                        {{ Form::number('count', null, ['class' => 'form-control', 'placeholder' => 'Enter Cod Limit',
                        'required' => true]) }}

                      </div>
                    </div>

                    {{ Form::hidden('id', $order_cancel->id) }}
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