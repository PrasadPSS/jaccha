@extends('frontend.layouts.login')
@section('title','Login')
@section('content')

<!-- login -->
<section class="container-fluidcustom top-padding login-page common-space">
  <div class="login-box">
    <div class="row py-5">
      <div class="col-md-12">
        <div class="container container-custom">
          <div class="row">
            <div class="col-md-12">
              <div class="border-login py-4">
                <div class="login-inner-head pl-4">
                  <h6>Login</h6>
                </div>
                <div class="using-box py-4">
              <div class="row pb-2">
                <div class="col-md-12 ">
                  <div class="float-right">
                    <a class="forgot-pass" href="{{ url('/forgotpassword') }}">Forgot Password</a>
                  </div>
                </div>
              </div>
                <div class="row ">
                  <div class="col-md-12 col-sm-12 col-12">
                    <div class="login">
                      @include('frontend.includes.errors')
                      <form class="login-form form-field" action="{{ url('/loginstore') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group  col-md-12">
                          <div class="input-wrapper">
                            <input class="password form-control form-control-h change_passsword show_password"  name="password" type="password" required autocomplete="off" autofocus>
                            <label for="user">Enter Password <span class="star">*</span></label>
                            <div class="hide-show">
                              <span>Show</span>
                            </div>
                            <div class="terms-conditions-size">
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-12 mb-0 terms-conditions-size pt-1">
                          <button type="submit" class="cobntinue-btn btn-block  text-center " href="#">Login</button>
                          <p class=" mb-0">By Login, you agree to Dadreeios.com’s <a href="#" class="terms-underline"> Terms & Conditions</a> and <a href="#" class="terms-underline">Privacy Policy</a>.</p>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<!-- login end-->






@endsection
