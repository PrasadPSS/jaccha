@extends('frontend.layouts.app')
@section('title','Add Bank Account Details')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Add Bank Account Details</h1>
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
						<h2>Bank Account Details</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">
								@if(!Session::has('success'))
			            			@include('frontend.includes.errors')
								@endif
									<form class="odr-progress-form" action="{{ url('/myaccount/storebank') }}" method="post">
										{{ csrf_field() }}
										<input type="hidden" name="order_id" value="{{ $order_id }}">
										<div class="form-row">
										@if(isset($banks) && count($banks)>0)
										<div class="form-group col-md-12">
										<label class="form-check-label" for="bank_id">Select Bank</label>
											<select class="form-control-h form-control " id="bank_id" name="bank_id">
												<option value="">Please Select a bank</option>
												@foreach($banks as $bank)
													<option value="{{$bank->bank_id}}" data-bank_name="{{$bank->bank_name}}" data-customer_name="{{$bank->customer_name}}" data-account_number="{{$bank->account_number}}" data-bank_ifsc_code="{{$bank->bank_ifsc_code}}" data-branch_name="{{$bank->branch_name}}" data-account_type="{{$bank->account_type}}" >{{$bank->bank_name.'('.$bank->account_number.')'}}</option>
												@endforeach
											</select>
										</div>
										@endif
											<p>DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required>
													<label class="" for="user">Customer name(as per the bank records) <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text"  name="account_number" value="{{ old('account_number') }}" id="account_number" required>
													<label for="user">Account Number <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>

											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text"  id="account_number_confirmation" name="account_number_confirmation" value="{{ old('account_number_confirmation') }}" required>
													<label for="user">Re-enter Account Number </label>
													<span class="number-msg" id="messages"></span>
												</div>

								     		</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text"  id="bank_ifsc_code" name="bank_ifsc_code" value="{{ old('bank_ifsc_code') }}" required>
													<label for="user">Bank IFSC Code <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>

											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" required>
													<label class="" for="user">Bank Name <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="branch_name" name="branch_name" value="{{ old('branch_name') }}" required>
													<label class="" for="user">Branch Name <span class="star">*</span></label>
												</div>
											</div>


											<div class="form-group col-md-12 address-type">
												<span class="mr-3">Account Type <span class="star">*</span></span><br>
												<input type="radio" name="account_type" id="account_type_saving" class="" value="saving" @if(old('account_type')=='saving')checked @endif>
												<label for="account_type_saving" class="common_checkbox mt-3">Saving Account</label><br>
												<input type="radio" name="account_type" id="account_type_current" value="current" @if(old('account_type')=='current')checked @endif>
												<label for="account_type_current" class="common_checkbox">Current Account</label>

											</div>
											<div class="form-group col-md-12 address-type">
                                                <!--<label> Note</label>-->
												<span class="mr-2"><h6> By adding this account, you are authorizing Dadreeios to share your bank account details with its banking partner in order to facilate your refund.</h6> </span>

											</div>
											<div class="form-group col-md-6">
												<!-- <button type="button" class="odr-cancel-btn w-100 text-center" href="#">CANCEL</button> -->
												<a href="{{ url('/myaccount/orders/return/'.$order_id) }}" class="btn odr-cancel-btn w-100 text-center">CANCEL</a>
											</div>
											<div class="form-group col-md-6 ">
												<button type="submit" class="odr-save-btn w-100 text-center">CONFIRM RETURN</button>
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

	$('#bank_id').on('change',function()
	{
		var bank_id = $(this).val();
		console.log($(this).val());
		// alert(shipping_pincode.length);
		if (bank_id != '')
		{
			$('#customer_name').val($("#bank_id option:selected").data('customer_name'));
			$('#account_number').val($("#bank_id option:selected").data('account_number'));
			$('#account_number_confirmation').val($("#bank_id option:selected").data('account_number'));
			$('#bank_ifsc_code').val($("#bank_id option:selected").data('bank_ifsc_code'));
			$('#bank_name').val($("#bank_id option:selected").data('bank_name'));
			$('#branch_name').val($("#bank_id option:selected").data('branch_name'));
			if($("#bank_id option:selected").data('account_type') == 'saving')
			{
				$('#account_type_saving').prop('checked',true);
				$('#account_type_current').prop('checked',false);
				console.log('test1');
				console.log($("#bank_id option:selected").data('account_type'));
			}
			else
			{
				$('#account_type_current').prop('checked',true);
				$('#account_type_saving').prop('checked',false);
				console.log('test2');
				console.log($("#bank_id option:selected").data('account_type'));
			}
		}
		else
		{
			$('#customer_name').val('');
			$('#account_number').val('');
			$('#account_number_confirmation').val('');
			$('#bank_ifsc_code').val('');
			$('#bank_name').val('');
			$('#branch_name').val('');
			$('#account_type').val('');
			$('#account_type_current').prop('checked',false);
			$('#account_type_saving').prop('checked',false);
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
