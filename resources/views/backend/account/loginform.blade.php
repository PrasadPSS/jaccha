@extends('backend.layouts.empty')
@section('title', 'Admin Login')
@section('content')
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-8 col-11">
     <div class="card bg-authentication mb-0">
        <div class="row m-0">
           <!-- left section-login -->
           <div class="col-md-6 col-12 px-0">
              <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                 <div class="card-header pb-1">
                    <div class="card-title">
                       <h4 class="text-center mb-2">Dadreeios Control Panel</h4>
                       <hr>
                       <p class="text-center">Please fill out the following fields to login:</p>
                       @include('backend.includes.errors')
                    </div>
                 </div>
                 <div class="card-content">
                    <div class="card-body">
                       <!-- <div class="d-flex flex-md-row flex-column justify-content-around"> -->

                       <!-- </div> -->
                       <!-- <div class="divider"> -->
                          <!-- <div class="divider-text text-uppercase text-muted"><small>or login with
                             email</small>
                          </div> -->
                       <!-- </div> -->
                       <form method="POST" action="{{ route('admin.login.submit') }}">
                         {{ csrf_field() }}
                          <div class="form-group mb-50">
                             <label class="text-bold-600" for="email">Email</label>
                             <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Email">
                          </div>
                          <div class="form-group">
                             <label class="text-bold-600" for="password">Password</label>
                             <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                                placeholder="Password">
                          </div>

                          <button type="submit" class="btn btn-primary glow w-100 position-relative">Login<i
                             id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                       </form>
                       <hr>

                    </div>
                 </div>
              </div>
           </div>
           <!-- right section image -->
           <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
              <div class="card-content">
                 <img class="img-fluid" src="{{ asset('backend-assets/images/pages/login.png') }}" alt="branding logo">
              </div>
           </div>
        </div>
     </div>
  </div>
</section>


@endsection
