@extends('backend.layouts.app')
@section('title', 'Update Company')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update Company</h5>
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
                  <a href="{{ route('admin.company') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Company</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($company, [
                        'method' => 'POST',
                        'url' => ['admin/company/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                          <div class="row">
                              <div class="col-md-12 col-12">
                                  <div class="form-group">
                                      {{ Form::hidden('id', $company->id) }}
                                      {{ Form::label('name', 'Company Name *') }}
                                      {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('email', 'Company Email *') }}
                                      {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Email', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('mobile_no', 'Company Phone Number *') }}
                                      {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Phone Number', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-12 col-12">
                                  <div class="form-group">
                                      {{ Form::label('address_line1', 'Address Line 1 *') }}
                                      {{ Form::text('address_line1', null, ['class' => 'form-control', 'placeholder' => 'Enter Address Line 1', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-12 col-12">
                                  <div class="form-group">
                                      {{ Form::label('address_line2', 'Address Line 2 *') }}
                                      {{ Form::text('address_line2', null, ['class' => 'form-control', 'placeholder' => 'Enter Address Line 2', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-12 col-12">
                                  <div class="form-group">
                                      {{ Form::label('landmark', 'Landmark *') }}
                                      {{ Form::text('landmark', null, ['class' => 'form-control', 'placeholder' => 'Enter Landmark', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('city', 'City *') }}
                                      {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Enter City', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('district', 'District *') }}
                                      {{ Form::text('district', null, ['class' => 'form-control', 'placeholder' => 'Enter District', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('state', 'State *') }}
                                      {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'Enter State', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('country', 'Country *') }}
                                      {{ Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Enter Country', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('pincode', 'Pin Code *') }}
                                      {{ Form::text('pincode', null, ['class' => 'form-control', 'placeholder' => 'Enter Pin Code', 'required' => true]) }}
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      {{ Form::label('gstno', 'GST No. *') }}
                                      {{ Form::text('gstno', null, ['class' => 'form-control', 'placeholder' => 'Enter GST No.', 'required' => true]) }}
                                  </div>
                              </div>
                              <!--<div class="col-lg-12 col-md-12">-->
                              <!--    {{ Form::label('address', 'Address *') }}-->
                              <!--    <fieldset class="form-group">-->
                              <!--        {{ Form::textarea('address', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Address', 'required' => true, 'rows'=>3]) }}-->
                              <!--    </fieldset>-->
                              <!--</div>-->

                              <!--<div class="col-lg-12 col-md-12">-->
                              <!--    {{ Form::label('bankdetail', 'Bank Detail *') }}-->
                              <!--    <fieldset class="form-group">-->
                              <!--        {{ Form::textarea('bankdetail', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter Bank Detail', 'rows'=>3]) }}-->
                              <!--    </fieldset>-->
                              <!--</div>-->

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
