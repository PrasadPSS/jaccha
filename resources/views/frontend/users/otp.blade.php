@extends('frontend.layouts.login')
@section('title', 'OTP')
@section('content')
    @php
        //dd(request()->get('mobile_no'));
    @endphp
    {{-- {{ dd($user) }} --}}
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
                                        <h6>Authentication is necessary in order to change passwordddd</h6>
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
                                                    <form class="login-form form-field"
                                                        action="{{ route('changeforgotpassword.store') }}" method="post">
                                                        {{ csrf_field() }}

                                                        <div class="form-group col-md-12">
                                                            <div class="input-wrapper">
                                                                <input class="password form-control form-control-h"
                                                                    id="otp" name="otp" type="number" required>
                                                                <label for="user">Enter OTP <span
                                                                        class="star">*</span></label>

                                                                {{-- {{ dd($user->toArray()) }} --}}
                                                                <input class="password form-control form-control-h"
                                                                    id="mobile_no" name="mobile_no"
                                                                    value="{{ $mobile_no }}" type="hidden" required>




                                                            </div>
                                                            {{--                          <p class="mb-0 py-2 set-otp">OTP sent to your Email Id</p> --}}

                                                        </div>
                                                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                            <button type="submit"
                                                                class="success-btn btn-block  text-center ">Submit</button>
                                                        </div>
                                                    </form>
                                                    {{-- <form class="login-form form-field" action="{{ route('resendotp') }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{--                        <input type="hidden" name="email" id="email" value="{{$email}}"> --}}
                                                    {{-- <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                            <button type="submit"
                                                                class="cancel-btn btn-block mt-3 text-center">Resend
                                                                OTP</button>



                                                                
                                                        </div>
                                                    </form> --}}
                                                    {{-- <form class="login-form form-field"> --}}
                                                    <input type="hidden" name="mobile_no" value="">
                                                    <input type="hidden" name="user_id" value="">
                                                    <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                        <div id="timer" class="mt-2"></div>
                                                        <button type="submit" class="cancel-btn btn-block mt-3 text-center"
                                                            id="resend_otp" disabled>Resend OTP</button>
                                                    </div>
                                                    {{-- </form> --}}
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

    <script>
        $(document).ready(function() {
            var timeoutHandle;

            function countdown(minutes, seconds) {
                function tick() {
                    var counter = document.getElementById("timer");
                    counter.innerHTML =
                        "Resend OTP in: " + minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                    seconds--;
                    if (seconds >= 0) {
                        timeoutHandle = setTimeout(tick, 1000);
                    } else {
                        if (minutes >= 1) {
                            setTimeout(function() {
                                countdown(minutes - 1, 59);
                            }, 1000);
                        } else {
                            $('#timer').hide();
                            $("#resend_otp").prop('disabled', false);
                        }
                    }
                }
                tick();
            }

            countdown(00, 30);

            $("#resend_otp").on('click', function() {
                var mobile_no = $("#mobile_no").val();

                if (mobile_no != '') {

                    $.ajax({
                        url: '{{ url('/resendsignupotp') }}',
                        type: 'post',
                        data: {
                            mobile_no: mobile_no,

                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            // console.log(data);
                            if (data.status == 'success') {
                                // $('#verify_box').html('<span class="verified">Verified</span>');
                                // $('#exampleModalCenter').modal('toggle');
                            }
                            alert(data.message);
                            // $('#brand_id').html(data);
                        }
                    });
                } else {
                    alert('Please Enter Mobile Number');
                }
            });
        });
    </script>
    <!-- login end-->
@endsection
{{-- <script> --}}
{{--  function resendOTP() { --}}
{{--    $.ajax({ --}}
{{--      url:"/dadreeios/resendotp", --}}
{{--      type:"POST", --}}
{{--      data:{ --}}
{{--       email:$('#email').val() --}}
{{--      }, --}}
{{--      success:function (dataResult) { --}}
{{--        console.log(dataResult) --}}
{{--      }, --}}
{{--      error:function (dataResult) { --}}
{{--        console.log(dataResult) --}}
{{--      } --}}
{{--    }) --}}
{{--  } --}}
{{-- </script> --}}
