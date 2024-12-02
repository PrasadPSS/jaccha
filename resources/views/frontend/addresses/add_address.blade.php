@extends('frontend.layouts.app')
@section('title','Addresses')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Add Address</h1>
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
						<h2>ADD ADDRESS</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">
			            @include('frontend.includes.errors')
									<form class="odr-progress-form" action="{{ url('/addresses/storeaddress') }}" method="post">
										{{ csrf_field() }}
										<div class="form-row">
											<p>DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_full_name" value="{{ old('shipping_full_name') }}" required>
													<label class="" for="user">Full Name <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_mobile_no" value="{{ old('shipping_mobile_no') }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" required>
													<label for="user">Mobile Phone Number <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
																
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_alt_mobile_no" value="{{ old('shipping_alt_mobile_no') }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*">
													<label for="user">Alternate Mobile Phone Number </label>
													<span class="number-msg" id="messages"></span>
												</div>
											
								     		</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="email" id="email" name="shipping_email" value="{{ old('shipping_email') }}" required>
													<label for="user">Email <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>
											<p>ADDRESS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line1" value="{{ old('shipping_address_line1') }}" required>
													<label class="" for="user">Address Line 1 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line2" value="{{ old('shipping_address_line2') }}" required>
													<label class="" for="user">Address Line 2 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_landmark" value="{{ old('shipping_landmark') }}" required>
													<label class="" for="user">Locality / Landmark <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_city" value="{{ old('shipping_city') }}" required>
													<label class="" for="user">Village / Town / City <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_pincode" id="shipping_pincode" maxlength="6" value="{{ old('shipping_pincode') }}"  minlength="6" inputmode="numeric" required>
													<label class="" for="pincode">Pincode <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_district" id="shipping_district" value="{{ old('shipping_district') }}" required>
													<label class="" for="user">District <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_state" id="shipping_state" value="{{ old('shipping_state') }}"  required>
													<label class="" for="user">State <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">This is my <span class="star">*</span></span>
												<input type="radio" id="home" name="shipping_address_type" value="home" checked>
												<label for="home" class="common_checkbox">Home</label>
												<input type="radio" id="office" name="shipping_address_type" value="office" >
												<label for="office" class="common_checkbox">Office</label>
												<input type="radio" id="other" name="shipping_address_type" value="other" >
    										<label for="other" class="common_checkbox">Other</label>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">Set as Default Address </span>
												<input type="checkbox" class="set_addr_check" id="default_address_flag" name="default_address_flag" value="1">
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
