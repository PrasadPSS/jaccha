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
                  <h6>Please Enter OTP</h6>
                </div>
                <div class="using-box py-4">

                <div class="row ">
                  <div class="col-md-12 col-sm-12 col-12">
                    <div class="login">
                      <!-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                      @endif -->
                        @if (!session()->has('success'))
                            @include('frontend.includes.errors')
                        @endif
                      <form class="login-form form-field" action="{{ route('verifyotp') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="mobile_no" value="{{ $mobile_no }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
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
                      <form class="login-form form-field" action="{{ route('resendmobileotp') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="mobile_no" value="{{ $mobile_no }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                        <div id="timer" class="mt-2"></div>
                        <button type="submit" class="cancel-btn btn-block mt-3 text-center" id="resend_btn" disabled>Resend OTP</button>
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
@section('extrajs')
<script>
  $(document).ready(function()
  {
    var timeoutHandle;
    function countdown(minutes, seconds) 
    {
      function tick() 
      {
        var counter = document.getElementById("timer");
        counter.innerHTML =
        "Resend OTP in: "+minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        seconds--;
        if (seconds >= 0) 
        {
          timeoutHandle = setTimeout(tick, 1000);
        } 
        else 
        {
          if (minutes >= 1) 
          {
            setTimeout(function () {
            countdown(minutes - 1, 59);
            }, 1000);
          }
          else
          {
            $('#timer').hide();
            $("#resend_btn").prop('disabled',false);
          }
        }
      }
      tick();
    }

    countdown(00, 30);
  });
</script>
@endsection