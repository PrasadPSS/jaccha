@extends('frontend.layouts.myaccount')
@section('title','MyAccount')
@section('content')


<!--Account panel section start-->
<div class="container top-padding container-myaccounts">
  <div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="account-panel">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-6">
						<div class="">
							<img src="{{ asset('frontend-assets/images/user.jpg') }}" class="ac-user img-fluid" alt="">
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-6">
						<div class="ac-panel-edit">
							<button type="submit" name="button" id="togglebutton">EDIT</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-6">
						<div class="ac-name-edit">
							<p>ACCOUNT:  {{ $user->name }}</p>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-6">
						<div class="ac-name-edit ac-panel-edit">
							<p>Edit your profile details and change password</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row ac-over-form-row">
		<div class="col-md-4 col-sm-12 col-12">
			@include('frontend.myaccount.includes.myaccountmenu')
		</div>
		<div class="col-md-8 col-sm-12 col-12 margin-ac-over-form">
      		<!-- <div id="empty-box"></div> -->
			<div class="ac-over-form " id="editform">
				<div class="ac-form" >
            		@include('frontend.includes.errors')
					<form class="account-form form-field" action="{{ url('/myaccount/storeprofile') }}" method="post" onsubmit="return myRegistration()">
              			{{ csrf_field() }}
						<div class="form-row">
							<div class="form-group col-md-12">
								<div class="input-wrapper">
									<input class="form-control form-control-h" type="text" name="name" value="{{ $user->name }}" required="">
									<label class="" for="user">Full Name <span class="star">*</span></label>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="input-wrapper">
									<input class="form-control form-control-h" type="email" name="email" value="{{ $user->email }}" required="" autocomplete="off">
									<label for="user">Email ID <span class="star">*</span></label>
								</div>
							</div>
							<div class="form-group col-md-12 remove-margin">
								<div class="form-row">
									<div class="col-md-8 col-12  ">
										<div class="input-wrapper">
											<input class="password form-control form-control-h show_password" id="change_password" name="change_password" type="password" autocomplete="off">
											<label for="user">Enter Password <span class="star">*</span></label>
											<div class="hide-show" style="display: block;">
												<span class="show">Show</span>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-12 ">
										<button class="w-100 ac-password-btn" id="change_password_btn" type="button" name="button">CHANGE PASSWORD</button>
									</div>
								</div>
							</div>
							<div class = "form-group col-md-12">
								<div class="input-wrapper shipping_mob_no">
									<input class="form-control form-control-h enter-mob-no" type="text " name="mobile_no" value="{{ $user->mobile_no }}" id="mobile_no" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" required>
									<label class="enter_Mobile_number" for="user">Enter Mobile Number <span class="star">*</span></label>
									@if($user->verified_mobile_no == 1)
										<div class="verifiy-box" id="verify_box" style="display: block;">
											<span class="verified">Verified</span>
										</div>
									@else 
										<div class="verifiy-box" id="verify_box" style="display: block;">
											<!-- <span class="verify">Verify</span> -->

											<!-- Button trigger modal -->
                                            <button type="button" class="btn verify" id="send_otp" data-toggle="modal" data-target="#exampleModalCenter">
                                             Verify
                                            </button>

										</div>
									@endif
								</div>					
							</div>
							<div class = "form-group col-md-12">
								<div class="input-wrapper shipping_mob_no">
									<input class="form-control form-control-h" type="text" name="alt_mobile_no" value="{{ $user->alt_mobile_no }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" >
									<label class="enter_Mobile_number" for="user">Alternate Mobile Phone Number </label>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="input-wrapper icon-calendar">
									<input class="form-control form-control-h" type="text" data-date-format="dd-mm-yyyy" id="datepicker" name="dob" value="{{ $user->dob }}" readonly>
									<label for="user">Date Of Birth</label>
									<!-- <span class="calendar"><i class="fa fa-calendar" aria-hidden="true"></i></span> -->
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="form-row">
									<div class="col-md-4 col-4 my-auto">
										<label class="select-gender" for="user">Select Gender</label>
									</div>
									<div class="col-md-4 col-4 male-col gender-mf">
										<div class="regi-radio-btn {{ ($user->gender=='male')?'active':'' }} " >
											<input type="radio" id="male" name="gender" value="male" {{ ($user->gender=='male')?'checked="checked"':'' }}>
											<label class="float-right" for="male">Male</label>
										</div>
									</div>
									<div class="col-md-4 col-4 female-col gender-mf">
										<div class="regi-radio-btn {{ ($user->gender=='female')?'active':'' }}" >
											<input type="radio" id="female" name="gender" value="female" {{ ($user->gender=='female')?'checked="checked"':'' }}>
											<label class="float-right" for="female">Female</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12  terms-conditions-size">
								<button type="submit" class="ac-save-btn btn-block  text-center " href="#">SAVE CHANGES</button>
							</div>
						</div>
					</form>
          		</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Verify with OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <!--<form class="login-form form-field" method="post">-->
                        <!--<input type="hidden" name="mobile_no" value="{{ $user->mobile_no }}">-->
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <div class="form-group col-md-12">
                            <p class="mb-0 py-2 set-otp">OTP sent to your Mobile Number</p>
                            <div class="input-wrapper">
                                <input class="password form-control form-control-h" style="width: 50%; margin: 0 auto;" id="otp" name="otp" type="number"
                                    required>
                                <label for="user">Enter OTP <span class="star">*</span></label>
                            </div>

                        </div>
                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                            <button type="submit" id="verify_otp" class="success-btn btn-block  text-center ">Submit</button>
                        </div>
                    </form>
                    <form class="login-form form-field" method="post">
                        <input type="hidden" name="mobile_no" value="">
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                            <div id="timer" class="mt-2"></div>
                            <button type="submit" class="cancel-btn btn-block mt-3 text-center" id="resend_otp"
                                disabled>Resend OTP</button>
                        </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
</div>







<!--Account panel section end-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#togglebutton").click(function() {
    $("#editform").toggle();
    $("#empty-box").toggle();
  });
});
</script>
<script type="text/javascript">
$('#datepicker').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
	});

</script>

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
            $("#resend_otp").prop('disabled',false);
          }
        }
      }
      tick();
    }

    countdown(00, 30);
  });
</script>

<script>
$(document).ready(function()
{
  $("#change_password_btn").on('click',function(){
    var change_password = $("#change_password").val();
    if (change_password)
    {

      $.ajax({
          url: '{{url("/myaccount/changepassword")}}',
          type: 'post',
          data:
          {
            change_password: change_password ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            console.log(data);
            alert(data);
            // $('#brand_id').html(data);
          }
       });
     }
     else
     {
       alert('Please Enter Password');
     }
  });
  $("#send_otp").on('click',function(){
    var mobile_no = $("#mobile_no").val();
    if (mobile_no)
    {

      $.ajax({
          url: '{{url("/profileotp")}}',
          type: 'post',
          data:
          {
            mobile_no: mobile_no ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            // console.log(data);
            alert(data.message);
            // $('#brand_id').html(data);
          }
       });
     }
     else
     {
       alert('Please Enter Mobile Number');
     }
  });
  
  $("#verify_otp").on('click',function(){
    var mobile_no = $("#mobile_no").val();
    var user_id = $("#user_id").val();
    var otp = $("#otp").val();
    if (mobile_no != '' && otp != '')
    {

      $.ajax({
          url: '{{url("/verifyprofileotp")}}',
          type: 'post',
          data:
          {
            mobile_no: mobile_no ,user_id: user_id ,otp: otp ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            // console.log(data);
            alert(data.message);
            $('#verify_box').html('<span class="verified">Verified</span>');
            $('#exampleModalCenter').hide();
            $('.close').click();
            // $('#brand_id').html(data);
          }
       });
     }
     else
     {
       alert('Please Enter Mobile Number');
     }
  });
  
  $("#resend_otp").on('click',function(){
    var mobile_no = $("#mobile_no").val();
    var user_id = $("#user_id").val();
    var otp = $("#otp").val();
    if (mobile_no != '' && otp != '')
    {

      $.ajax({
          url: '{{url("/resendmobileotp")}}',
          type: 'post',
          data:
          {
            mobile_no: mobile_no ,user_id: user_id ,otp: otp ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            // console.log(data);
            if(data.status == 'success')
            {
                $('#verify_box').html('<span class="verified">Verified</span>');
                $('#exampleModalCenter').modal('toggle');
            }
            alert(data.message);
            // $('#brand_id').html(data);
          }
       });
     }
     else
     {
       alert('Please Enter Mobile Number');
     }
  });

});
</script>

@endsection
