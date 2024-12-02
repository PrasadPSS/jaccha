@extends('frontend.layouts.app')
@section('title','Pickup Address')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Pickup Address</h1>
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
						<h2>Pickup Address</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">
						            @include('frontend.includes.errors')
									<form class="odr-progress-form" action="{{ url('/myaccount/storeaddress') }}" method="post">
										{{ csrf_field() }}
										
										<input type="hidden" name="order_id" value="{{ $order_id }}">
										<div class="form-row">
											@if(isset($shipping_addresses) && count($shipping_addresses)>0)
											<div class="form-group col-md-12">
											<label class="form-check-label" for="shipping_address_id">Select or Edit Address</label>
												<select class="form-control-h form-control " id="shipping_address_id" name="shipping_address_id">
													<option value="">Please Select Address</option>
													@foreach($shipping_addresses as $shipping_addresse)
														<option value="{{$shipping_addresse->shipping_address_id}}" data-shipping_full_name="{{$shipping_addresse->shipping_full_name}}" data-shipping_mobile_no="{{$shipping_addresse->shipping_mobile_no}}" data-shipping_alt_mobile_no="{{$shipping_addresse->shipping_alt_mobile_no}}" data-shipping_address_line1="{{$shipping_addresse->shipping_address_line1}}" data-shipping_address_line2="{{$shipping_addresse->shipping_address_line2}}" data-shipping_landmark="{{$shipping_addresse->shipping_landmark}}" 
														data-shipping_city="{{$shipping_addresse->shipping_city}}" data-shipping_pincode="{{$shipping_addresse->shipping_pincode}}" data-shipping_district="{{$shipping_addresse->shipping_district}}" data-shipping_state="{{$shipping_addresse->shipping_state}}" data-shipping_address_type="{{$shipping_addresse->shipping_address_type}}" data-default_address_flag="{{$shipping_addresse->default_address_flag}}" data-shipping_email="{{$shipping_addresse->shipping_email}}">{{$shipping_addresse->shipping_full_name.'('.$shipping_addresse->shipping_city.')'}}</option>
													@endforeach
												</select>
											</div>
											@endif
											<p>DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="shipping_full_name" name="shipping_full_name" required value="{{ $shipping_address->shipping_full_name }}" readOnly>
													<label class="" for="user">Full Name <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12"><div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h" type="text entermobno" id="shipping_mobile_no" name="shipping_mobile_no" value="{{ $shipping_address->shipping_mobile_no }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" required readOnly>
													<label class="enter_Mobile_number" for="user">Enter Mobile Number <span class="star">*</span></label>
												</div>
											<!-- <div class="countryCode-wrap">
												<div class="country-code-dropdown-icon d-flex justify-content-between align-items-center"><div class="cntry-mob-phone-code-item d-flex justify-content-start align-items-center"><img src="{{ asset('frontend-assets/images/') }}/flag-img.png" alt="country flag"><span>+91</span></div></div>
											</div> -->
											
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h" type="text" id="shipping_alt_mobile_no" name="shipping_alt_mobile_no" value="{{ $shipping_address->shipping_alt_mobile_no }}" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" readOnly>
													<label class="enter_Mobile_number" for="user">Alternate Mobile Phone Number </label>
												</div>
												<!-- <div class="countryCode-wrap">
													<div class="country-code-dropdown-icon d-flex justify-content-between align-items-center"><div class="cntry-mob-phone-code-item d-flex justify-content-start align-items-center"><img src="{{ asset('frontend-assets/images/') }}/flag-img.png" alt="country flag"><span>+91</span></div></div></div> -->
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="email" id="shipping_email" name="shipping_email" required value="{{ $shipping_address->shipping_email }}" readOnly>
													<label for="user">Email <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>
											<p>ADDRESS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="shipping_address_line1" name="shipping_address_line1" required value="{{ $shipping_address->shipping_address_line1 }}">
													<label class="" for="user">Address Line 1 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="shipping_address_line2" name="shipping_address_line2" required value="{{ $shipping_address->shipping_address_line2 }}">
													<label class="" for="user">Address Line 2 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="shipping_landmark" name="shipping_landmark" required value="{{ $shipping_address->shipping_landmark }}">
													<label class="" for="user">Locality / Landmark <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_city" required id="shipping_city" value="{{ $shipping_address->shipping_city }}">
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
												<input type="radio" id="shipping_address_type_home" name="shipping_address_type" value="home" @if($shipping_address->shipping_address_type=='home')checked @endif>
												<label for="shipping_address_type_home" class="common_checkbox">Home</label>
												<input type="radio" id="shipping_address_type_office" name="shipping_address_type" value="office" @if($shipping_address->shipping_address_type=='office')checked @endif>
												<label for="shipping_address_type_office" class="common_checkbox">Office</label>
												<input type="radio" id="shipping_address_type_other" name="shipping_address_type" value="other" @if($shipping_address->shipping_address_type=='other')checked @endif>
    											<label for="shipping_address_type_other" class="common_checkbox">Other</label>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">Set as Default Address </span>
												<input type="checkbox" class="set_addr_check" id="default_address_flag" name="default_address_flag" value="1" @if($shipping_address->default_address_flag=='1')checked @endif>
												<!-- <label for="default_address_flag">Set as Default Address</label> -->
											</div>
											<div class="form-group col-md-6">
												<!-- <button type="button" class="odr-cancel-btn w-100 text-center" href="#">CANCEL</button> -->
												<a href="{{ url('/myaccount/orders/return/'.$order_id) }}" class="btn odr-cancel-btn w-100 text-center">CANCEL</a>
											</div>
											<div class="form-group col-md-6 ">
												@if($orders->payment_mode=='cod')
												<button type="submit" class="odr-save-btn w-100 text-center" >SAVE PICKUP ADDRESS</button>
												@elseif($orders->payment_mode=='payumoney')
												<button type="submit" class="odr-save-btn w-100 text-center" >CONFIRM RETURN</button>
												@else
												<button type="submit" class="odr-save-btn w-100 text-center" >CONFIRM RETURN</button>
												@endif
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
	$('#shipping_address_id').val('{{isset($shipping_address->shipping_address_id)?$shipping_address->shipping_address_id:""}}');
	$('#shipping_address_id').on('change',function()
	{
		var shipping_address_id = $(this).val();
		console.log($(this).val());
		// alert(shipping_pincode.length);
		if (shipping_address_id != '')
		{
			$('#shipping_full_name').val($("#shipping_address_id option:selected").data('shipping_full_name'));
			$('#shipping_mobile_no').val($("#shipping_address_id option:selected").data('shipping_mobile_no'));
			$('#shipping_alt_mobile_no').val($("#shipping_address_id option:selected").data('shipping_alt_mobile_no'));
			$('#shipping_email').val($("#shipping_address_id option:selected").data('shipping_email'));
			$('#shipping_address_line1').val($("#shipping_address_id option:selected").data('shipping_address_line1'));
			$('#shipping_address_line2').val($("#shipping_address_id option:selected").data('shipping_address_line2'));
			$('#shipping_landmark').val($("#shipping_address_id option:selected").data('shipping_landmark'));
			$('#shipping_city').val($("#shipping_address_id option:selected").data('shipping_city'));
			$('#shipping_pincode').val($("#shipping_address_id option:selected").data('shipping_pincode'));
			$('#shipping_district').val($("#shipping_address_id option:selected").data('shipping_district'));
			$('#shipping_state').val($("#shipping_address_id option:selected").data('shipping_state'));
			
			if($("#shipping_address_id option:selected").data('shipping_address_type') == 'home')
			{
				$('#shipping_address_type_home').prop('checked',true);
				$('#shipping_address_type_office').prop('checked',false);
				$('#shipping_address_type_other').prop('checked',false);
			}
			else if($("#shipping_address_id option:selected").data('account_type') == 'office')
			{
				$('#shipping_address_type_home').prop('checked',false);
				$('#shipping_address_type_office').prop('checked',true);
				$('#shipping_address_type_other').prop('checked',false);
			}
			else
			{
				$('#shipping_address_type_home').prop('checked',false);
				$('#shipping_address_type_office').prop('checked',false);
				$('#shipping_address_type_other').prop('checked',true);
			}

			if($("#shipping_address_id option:selected").data('default_address_flag') == 'home')
			{
				$('#default_address_flag').prop('checked',true);
			}
			else
			{
				$('#default_address_flag').prop('checked',false);
			}
		}
		else
		{
			$('#shipping_full_name').val('');
			$('#shipping_mobile_no').val('');
			$('#shipping_alt_mobile_no').val('');
			$('#shipping_email').val('');
			$('#shipping_address_line1').val('');
			$('#shipping_address_line2').val('');
			$('#shipping_landmark').val('');
			$('#shipping_city').val('');
			$('#shipping_pincode').val('');
			$('#shipping_district').val('');
			$('#shipping_state').val('');
			$('#shipping_address_type_home').prop('checked',false);
			$('#shipping_address_type_office').prop('checked',false);
			$('#shipping_address_type_other').prop('checked',false);
			$('#default_address_flag').prop('checked',false);
		}
	});
});
</script>
@endsection
