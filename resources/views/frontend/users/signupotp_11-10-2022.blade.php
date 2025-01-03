@extends('frontend.layouts.login')
@section('title','OTP')
@section('content')

<!-- login -->
<section class="container-fluidcustom signupotp-container top-padding login-page common-space">
  <div class="login-box">

  <div class="row  text-center pt-4">
      <div class="col-md-12">
        <div class="login-page-head">
          <h1>Verify with OTP</h1>
        </div>
      </div>
    </div>


    <div class="row py-5">
      <div class="col-md-12">
        <div class="container container-custom">
          <div class="row">
            <div class="col-md-6">
              <div class="border-login py-4">
                <div class="login-inner-head pl-4">
                  <h6>Authentication is necessary in order to change password</h6>
                </div>
                <div class="using-box py-4">

                <div class="row ">
                  <div class="col-md-12 col-sm-12 col-12">
                    <div class="login">
                      @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                      @endif
                        @include('frontend.includes.errors')
                      <form class="login-form form-field" action="{{ route('changeforgotpassword.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12">
                          <div class="input-wrapper">
                            <input class="password form-control form-control-h" id="otp"  name="otp" type="number" required >
                          <label for="user">Enter OTP <span class="star">*</span></label>
                          </div>
                          {{--<p class="mb-0 py-2 set-otp">OTP sent to your Email Id</p>--}}

                          </div>
                          <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                          <button type="submit" class="success-btn btn-block  text-center " >Submit</button>
                          </div>
                      </form>
                      <form class="login-form form-field" action="{{ route('resendotp') }}" method="post">
                        {{ csrf_field() }}
                        {{--<input type="hidden" name="email" id="email" value="{{$email}}">--}}
                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                      <button type="submit" class="cancel-btn btn-block mt-3 text-center" >Resend OTP</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </div>



        <div class="col-md-6">
              <div class="otp-img">
              <img class="img-fluid img-responsive w-100 h-100 regi-img" src="{{ asset('frontend-assets/images/otp-img.png') }}" alt="Img">
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
{{--<script>--}}
{{--  function resendOTP() {--}}
{{--    $.ajax({--}}
{{--      url:"/dadreeios/resendotp",--}}
{{--      type:"POST",--}}
{{--      data:{--}}
{{--       email:$('#email').val()--}}
{{--      },--}}
{{--      success:function (dataResult) {--}}
{{--        console.log(dataResult)--}}
{{--      },--}}
{{--      error:function (dataResult) {--}}
{{--        console.log(dataResult)--}}
{{--      }--}}
{{--    })--}}
{{--  }--}}
{{--</script>--}}
