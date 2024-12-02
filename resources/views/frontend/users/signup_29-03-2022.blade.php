@extends('frontend.layouts.login')
@section('title','Sign up')
@section('content')

<!-- Registration -->
<div class="container-fluidcustom top-padding login-page regi-page">  <!-- pt-5 -->
    <div class="login-box">
      <div class="row login-row pt-2"> <!-- pt-4 -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="login-signin-link">
            <p class="login">Sign up </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-auto">
          <div class="style-text">
            <p class="mb-0">Hurry up! You are very close to signing up!</p>
          </div>
        </div>
    </div>

    <div class="row login-row pb-5">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="border-login">
          <div class="using-box">
                  <p class="text-right my-auto"><span class="star">*</span>All fields are mandatory</p><br>
                  @include('frontend.includes.errors')
              <form class="registration-form form-field" action="{{ url('register') }}" method="POST" onsubmit="return myRegistration()">
                {{ csrf_field() }}
                <div class="form-row">
                <div class="form-group col-md-12 pb-4">
                <div class="input-wrapper">
                  <input class="form-control form-control-h" type="text" name="name" value="{{ old('name') }}" required>
                  <label class="" for="user">Full Name <span class="star">*</span></label>
                </div>
                </div>
                <div class = "form-group col-md-12 pb-4">
                <!-- <div class="input-wrapper">
                <input class="form-control form-control-h" type="text" id="mobnumber" name="mobile_no" maxlength="10" required>
                <label for="user">Mobile Phone Number <span class="star">*</span></label>
                <span class="number-msg" id="messages"></span>
                </div> -->
                      <div class="input-wrapper shipping_mob_no">
                          <input class="form-control form-control-h" type="text" id="mobnumber" name="mobile_no" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" value="{{ old('mobile_no') }}" required>
                          <label class="enter_Mobile_number" for="user">Mobile Phone Number <span class="star">*</span></label>
                      </div>
                      <div class="countryCode-wrap">
                          <div class="country-code-dropdown-icon d-flex justify-content-between align-items-center"><div class="cntry-mob-phone-code-item d-flex justify-content-start align-items-center"><img src="{{ asset('frontend-assets/images/') }}/flag-img.png" alt="country flag"><span>+91</span></div></div>
                      </div>
                </div>
                <div class="form-group col-md-12 pb-4">
                <div class="input-wrapper">
                <input class="form-control form-control-h" type="email" name="email" value="{{ old('email') }}" required>
                <label for="user">Email ID <span class="star">*</span></label>
                </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="input-wrapper">
                    <input class="password form-control form-control-h show_password"  name="password" type="password" value="{{ old('password') }}" required>
                  <label for="user">Enter Password <span class="star">*</span></label>
                  <div class="hide-show">
                    <span>Show</span>
                  </div>
                  <div class="terms-conditions-size">
                    <p ><i class="fa fa-info" aria-hidden="true"></i> Password must be at least 8 characters alphanumerical.</p>

                  </div>
                  </div>
                  </div>

                <div class="form-group col-md-12 pb-1">
                  <div class="input-wrapper">
                <input class="password form-control form-control-h show_confirm_password"  name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required>
                  <label for="user">Re Enter Password <span class="star">*</span></label>
                  <div class="hide-showRe">
                    <span>Show</span>
                  </div>
                  </div>
                  </div>
                <div class="form-group col-md-12">
                  <div class="form-row">
                    <div class="col-md-4 col-4 my-auto">
                      <label class="select-gender" for="user">Select Gender <span class="star">*</span></label>
                    </div>
                    <div class="col-md-4 col-4 male-col gender-mf">
                      <div class="regi-radio-btn ">
                        <!-- <input type="radio" name='gender' checked ><label for="radioBanana">Female</label> -->
                        <input type="radio" id="male" name="gender" value="male">
                        <label class="float-right" for="male">Male</label>
                      </div>
                        </div>
                    <div class="col-md-4 col-4 female-col gender-mf">
                      <div class="regi-radio-btn">
                        <!-- <input type="radio" name='gender' ><label for="radioBanana">male</label> -->
                        <input type="radio" id="female" name="gender" value="female">
                        <label class="float-right" for="female">Female</label>
                      </div>
                        </div>
                  </div>
                </div>
            <div class="form-group col-md-12 pt-3 terms-conditions-size">
              <p class="m-0">We will send you a verification code to verify your phone number.</p>
              <p class="m-0"><i class="fa fa-info" aria-hidden="true"></i> Message and Data rates may apply.</p>
            </div>

            <div class="form-group col-md-12  mb-0 terms-conditions-size">
                  <button type="submit" class="cobntinue-btn btn-block  text-center " href="#">Sign up</button>
                  <p class=" p-0 pb-1">By sign up, you agree to Dadreeios.com’s <a href="{{ url('/') }}/pages/terms-and-conditions" class="terms-underline"> Terms & Conditions</a> and <a href="{{ url('/') }}/pages/privacy-policy"class="terms-underline">Privacy Policy</a>.</p>
                  <p class="using-box-border"></p>
            </div>
            </div>
              </form>

              <div class="row using-box text-center pb-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="num-text mb-0">
                    <span>Already have an account? <span><a class="signin" href="{{ url('login') }}">Login</a></span></span>
                  </div>
                </div>
              </div>


            </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-12" >
          <!-- <a href="#"><img class="img-fluid img-responsive w-100 h-100 regi-img" src="images/banner5.jpg" alt="Img"></a> -->
          <a href="#"><img class="img-fluid img-responsive w-100 h-100 regi-img" src="{{ asset('frontend-assets/images/banner5.jpg') }}" alt="Img"></a>

      </div>
    </div>
  </div>
  </div>
  <!-- Registration end -->






@endsection
