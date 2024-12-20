@extends('backend.layouts.app')
@section('title', 'Change Password')
@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Change Password</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Change Password
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
                  <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-content mt-2">
                  <div class="card-body">
                    @include('backend.includes.errors')
					<form class="form" method="POST" action="{{ route('admin.update_password') }}" autocomplete="off">
                    {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Current Password *</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password" required>
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                                {{ Form::label('new_password', 'New Password *') }}
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                            </div>
                          </div>
						  <div class="col-md-6 col-12">
                            <div class="form-group">
                                {{ Form::label('new_password_confirmation', 'Confirm New Password *') }}
                                <input type="password" class="form-control" name="new_password_confirmation" placeholder="Enter New Password again" required>
                            </div>
                          </div>

                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
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
@endsection