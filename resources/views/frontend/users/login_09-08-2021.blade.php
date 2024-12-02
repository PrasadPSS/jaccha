@extends('frontend.layouts.app')
@section('title','Login')
@section('content')

<!-- login -->
<section class="container-fluidcustom top-padding login-page">
  <div class=" login-box">
    <div class="row  text-center pt-4">
      <div class="col-md-12">
        <div class="login-page-head">
          <h1>WELCOME TO DADREEIOS.COM</h1>
        </div>
      </div>
    </div>

    <div class="row pt-4 login-row ">
      <div class="col-md-6">
        <div class="login-signin-link">
          <a class="login" href="#">Login </a>
        </div>
      </div>
      <div class="col-md-6 my-auto">
          <p class="style-text mb-0">Let’s Start Journey to Discover Fashion & Styles!</p>
      </div>
    </div>

    <div class="row login-row pb-4">
      <div class="col-md-6">
        <div class="border-login">
          <div class="using-box">
          <div class="row pt-1">
            <div class="col-md-12">
              <p class="using-text">Using</p>
            </div>
          </div>
          <div class="row text-center pt-1">
            <div class="col-md-6 col-sm-6 col-6">
                  <a class="social-text facebook btn-block" href="{{ url('login/facebook') }}">
                    <img src="{{ asset('frontend-assets/images/facebook-logo.png') }}" alt="" width="30"> Login with Facebook
                  </a>
            </div>
            <div class="col-md-6 col-sm-6 col-6 ">
                <a class="social-text google btn-block" href="{{ url('login/google') }}">
                  <img src="{{ asset('frontend-assets/images/google-logo.png') }}" alt="" width="30"> Login with Google
                </a>
            </div>
          </div>
          <div class="row pt-3 text-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-auto">
              <p class="or-text">OR</p>
            </div>
          </div>
          <div class="row ">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="login">
                @include('frontend.includes.errors')

                <form class="login-form form-field" action="{{ url('/loginpassword') }}" method="post">
                    {{ csrf_field() }}
                  <div class="form-group form-control-h pb-3">
                  <div class="input-wrapper">
                    <input class="form-control form-control-h" type="email" name="email" value="{{ old('email') }}" required>
                  <label for="user">Email ID </label>
                  </div>
                  </div>
                  <div class="form-group mb-0 terms-conditions-size pt-3">
                        <button type="submit" class="cobntinue-btn btn-block text-center">Continue</button>
                        <p class=" p-0 pb-1">By continuing, you agree to Dadreeios.com’s <a href="#" class="terms-underline"> Terms & Conditions</a> and <a href="#" class="terms-underline">Privacy Policy</a>.</p>
                        <p class="using-box-border"></p>
                  </div>
              </form>
              </div>
            </div>
          </div>

          <div class="row  text-center pb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="num-text">
                <p class="mb-0">New to Dadreeios.com?</p>
                <a class="signin" href="{{ url('/signup') }}">Sign up</a>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-6 ">
        <a href="#"><img class="w-100 h-100 img-responsive login-img" src="{{ asset('frontend-assets/images/banner3.jpg') }}" alt="Img"></a>
      </div>
    </div>
  </div>
</section>

<!-- login end-->






@endsection
