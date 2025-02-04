@extends('frontend.layouts.login')
@section('title', 'Forgot Password')
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
                                        <h6>Authentication is necessary in order to change password</h6>
                                    </div>
                                    <div class="using-box py-4">

                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="login">
                                                    @include('frontend.includes.errors')
                                                    <form class="login-form form-field"
                                                        action="{{ route('sendotp.store') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group col-md-12">
                                                            <div class="input-wrapper">
                                                                <input class="password form-control form-control-h "
                                                                    name="mobile_no" type="number"
                                                                    value="{{ old('mobile_no') }}" required>
                                                                <label for="user">Enter Mobile No: <span
                                                                        class="star">*</span></label>
                                                            </div>
                                                            <p class="mb-0 py-1 set-otp">OTP will be sent to your mobile</p>

                                                        </div>
                                                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                            <button type="submit"
                                                                class="success-btn btn-block  text-center "
                                                                href="#">Submit</button>
                                                            <!-- <button type="submit" class="cancel-btn btn-block mt-4 text-center " href="#">Resend OTP</button> -->
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
