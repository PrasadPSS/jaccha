@extends('frontend.layouts.app')
@section('title','Login')
@section('content')

<!-- login -->
<div class="container-fluidcustom top-padding">
  <div class="login-box">
    <div class="row text-center pt-4">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="login-page-head">
          <h1>WELCOME TO DADREEIOS.COM</h1>
        </div>
      </div>
    </div>

    <div class="row login-row pt-4">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="login-signin-link ">
          <a class="login" href="#">Login </a><span>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-auto">
          <span class="style-text">Let’s Start Journey to Discover Fashion & Styles!</span>
      </div>
    </div>

    <div class="row login-row pt-1 pb-4">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="border-login h-100">

          <div class="row using-box">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="num-text">
                <div class="row">
                  <div class="col-md-12">
                    <div class="float-right pt-5 pb-3">
                      <a class="forgot-pass" href="#">Forgot Password</a>
                    </div>
                  </div>
                </div>
                @include('frontend.includes.errors')
                <form class="contact-form" action="{{ url('/loginstore') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="email" value="{{ $email }}">
                  <div class="form-group ">
                    <div class="input-wrapper">
                      <input class="password form-control form-control-h show_password" id="change_passsword"  name="password" type="password" required autocomplete="off">
                    <label for="user">Enter Password <span class="star">*</span></label>
                    <div class="hide-show">
                      <span>Show</span>
                    </div>
                    </div>
                    </div>
                  <div class="form-group mb-0 terms-conditions-size">
                        <button type="submit" class="cobntinue-btn btn-block  text-center " href="#">Login</button>
                        <!-- <p class=" p-0 pb-1">By continuing, you agree to Dadreeios.com’s <a href="#" class="terms-underline"> Terms & Conditions</a> and <a href="#"class="terms-underline">Privacy Policy</a>.</p> -->

                  </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->

      <!--  -->
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
        <a href="#"><img class="w-100 h-100 img-responsive login-img" src="{{ asset('frontend-assets/images/banner3.jpg') }}" alt="Img"></a>
      </div>

    </div>
  </div>
</div>


<!-- login end-->






@endsection
