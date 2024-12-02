@extends('backend.layouts.app')
@section('title', 'MyProfile')
@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">MyProfile</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">MyProfile
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
                  <h4 class="card-title">Update Profile</h4>
                </div>
                <div class="card-content mt-2">
                  <div class="card-body">
                    @include('backend.includes.errors')
					{!! Form::model($adminuser, [
                        'method' => 'POST',
                        'url' => ['admin/update_profile'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('admin_user_id', $adminuser->admin_user_id) }}
                              {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                              {{ Form::label('first_name', 'First Name *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                              {{ Form::label('last_name', 'Last Name *') }}
                            </div>
                          </div>
						  <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required' => true]) }}
                              {{ Form::label('mobile_no', 'Mobile *') }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'readonly' => 'readonly']) }}
                              {{ Form::label('email', 'Email *') }}
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
@endsection