@extends('frontend.layouts.app')
@section('title','Addresses')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Edit Address</h1>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>
<!--order progrrss section start-->
<div class="container top-padding pt-3 pb-4 container-myaccounts">
	<div class="row delivery-details-row">

		<div class="col-md-5 col-sm-12 col-12 order-details-box2">
			<div class="order-details-box">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="order-address">
						<h2>EDIT ADDRESS</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">
			            @include('frontend.includes.errors')
									<form class="odr-progress-form" action="{{ url('/addresses/updateaddress') }}" method="post">
										{{ csrf_field() }}
										<input type="hidden" name="shipping_address_id" value="{{ $shipping_address->shipping_address_id }}">
										<div class="form-row">
											<p>DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_full_name" required value="{{ $shipping_address->shipping_full_name }}">
													<label class="" for="user">Full Name <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12"><div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h" type="text entermobno" name="shipping_mobile_no" value="{{ $shipping_address->shipping_mobile_no }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" required>
													<label class="enter_Mobile_number" for="user">Enter Mobile Number <span class="star">*</span></label>
												</div>
											
											
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h" type="text" name="shipping_alt_mobile_no" value="{{ $shipping_address->shipping_alt_mobile_no }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" >
													<label class="enter_Mobile_number" for="user">Alternate Mobile Phone Number </label>
												</div>
												
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="email" id="email" name="shipping_email" required value="{{ $shipping_address->shipping_email }}">
													<label for="user">Email <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>
											<p>ADDRESS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line1" required value="{{ $shipping_address->shipping_address_line1 }}">
													<label class="" for="user">Address Line 1 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line2" required value="{{ $shipping_address->shipping_address_line2 }}">
													<label class="" for="user">Address Line 2 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_landmark" required value="{{ $shipping_address->shipping_landmark }}">
													<label class="" for="user">Locality / Landmark <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_city" required value="{{ $shipping_address->shipping_city }}">
													<label class="" for="user">Village / Town / City <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_pincode" required id="shipping_pincode" maxlength="6" value="{{ $shipping_address->shipping_pincode }}">
													<label class="" for="user">Pincode <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_district" required id="shipping_district" value="{{ $shipping_address->shipping_district }}">
													<label class="" for="user">District <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_state" required id="shipping_state" value="{{ $shipping_address->shipping_state }}">
													<label class="" for="user">State <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">This is my <span class="star">*</span></span>
												<input type="radio" id="home" name="shipping_address_type" value="home" @if($shipping_address->shipping_address_type=='home')checked @endif>
												<label for="home" class="common_checkbox">Home</label>
												<input type="radio" id="office" name="shipping_address_type" value="office" @if($shipping_address->shipping_address_type=='office')checked @endif>
												<label for="office" class="common_checkbox">Office</label>
												<input type="radio" id="other" name="shipping_address_type" value="other" @if($shipping_address->shipping_address_type=='other')checked @endif>
    										<label for="other" class="common_checkbox">Other</label>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">Set as Default Address </span>
												<input type="checkbox" class="set_addr_check" id="default_address_flag" name="default_address_flag" value="1" @if($shipping_address->default_address_flag=='1')checked @endif>
												<!-- <label for="default_address_flag">Set as Default Address</label> -->
											</div>
											<div class="form-group col-md-6">
												<!-- <button type="button" class="odr-cancel-btn w-100 text-center" href="#">CANCEL</button> -->
												<a href="{{ url('/addresses') }}" class="btn odr-cancel-btn w-100 text-center">CANCEL</a>
											</div>
											<div class="form-group col-md-6 ">
												<button type="submit" class="odr-save-btn w-100 text-center" href="#">SAVE CHANGES</button>
											</div>
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

<!--order progrrss section end-->
<script>
$(document).ready(function()
{
	$('#shipping_pincode').on('keyup',function()
	{
		var shipping_pincode = $(this).val();
		// alert(shipping_pincode.length);
		if (shipping_pincode.length == 6)
		{
			pindata(shipping_pincode);
		}
	});

	function pindata(shipping_pincode)
	{
		// alert(pincode);
		$.ajax({
				url: '{{url("/addresses/getpincodedata")}}',
				type: 'post',
				data:
				{
					shipping_pincode: shipping_pincode ,_token: "{{ csrf_token() }}",
				},
				success: function (data)
				{
					console.log(data);
					if (data != 'N')
					{
						$('#shipping_district').val(data['district']);
						$('#shipping_state').val(data['state']);
					}
				}
		 });
	}
});
</script>
@endsection
