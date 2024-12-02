@extends('frontend.layouts.app')
@section('title','Delivery Addresses')
@section('content')


<!--order progrrss section start-->
<div class="container top-padding  pb-4">
	<div class="row delivery-details-row">
		<div class="col-lg-7 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
					<div class="order-address">
						<h2>Delivery Address</h2>
					</div>
					@if(isset($shipping_addresses))
						@foreach($shipping_addresses as $shipping_address)
							<div class="row">
								<div class="col-md-8 col-sm-8 col-12">
									<div class="ord-address">
										<p class="ord-name">
											<span class="ord-name-space">{{ $shipping_address->shipping_full_name }}</span>
											<span class="home-link">@if($shipping_address->shipping_address_type=='home')HOME @elseif($shipping_address->shipping_address_type=='office')OFFICE @elseif($shipping_address->shipping_address_type=='other')OTHER @endif</span>
										</p>
										<p class="ord-add">{{ $shipping_address->shipping_address_line1 }}, {{ $shipping_address->shipping_address_line2 }}<br>{{ $shipping_address->shipping_landmark }}</br>{{ $shipping_address->shipping_city }} - {{ $shipping_address->shipping_pincode }}
											<br>{{ $shipping_address->shipping_district }}, {{ $shipping_address->shipping_state }}</p>
										<p class="ord-contact">Contact Number: {{ $shipping_address->shipping_mobile_no }} </p>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="ord-edit-remove">
												<button class="ord-edit" type="submit" name="button">EDIT</button>
												<button class="ord-remove" type="submit" name="button">REMOVE</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 plus-div col-12 align-self-end justify-content-center">
									<div class="ord-add-btn1">
										<p class="add-link1 text-center "><a href="#"> + </a></p>
									</div>
									<form class="" action="{{ url('/cart/checkout') }}" method="get">
										<input type="hidden" name="shipping_address_id" value="{{ $shipping_address->shipping_address_id }}">
										<div class="addnew-butn">
											<!-- <a class="ord-addnew-address" href="#" >Deliver to this Address</a> -->
											<button class="ord-addnew-address" type="submit">Deliver to this Address</button>
										</div>
									</form>
								</div>
							</div>
						@endforeach
					@endif


			</div>
		</div>
		<div class="col-lg-5 col-md-12 col-sm-12 col-12 order-details-box2">
			<div class="order-details-box">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="order-address">
						<h2>ADD DELIVERY ADDRESS</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">
			            @include('frontend.includes.errors')
									<form class="odr-progress-form" action="{{ url('/cart/addshippingaddress') }}" method="post">
										{{ csrf_field() }}
										<div class="form-row">
											<p>DELIVERY DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_full_name" required>
													<label class="" for="user">Full Name <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_mobile_no" required>
													<label for="user">Mobile Phone Number <span class="star">*</span></label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_alt_mobile_no">
													<label for="user">Alternate Mobile Phone Number </label>
													<span class="number-msg" id="messages"></span>
												</div>
											</div>
											<p>ADDRESS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line1" required>
													<label class="" for="user">Address Line 1 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_address_line2" required>
													<label class="" for="user">Address Line 2 <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_landmark" required>
													<label class="" for="user">Locality / Landmark <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_city" required>
													<label class="" for="user">Village / Town / City <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_pincode" required>
													<label class="" for="user">Pincode <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_district" required>
													<label class="" for="user">District <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_state" required>
													<label class="" for="user">State <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-12 address-type">
												<span class="mr-3">This is my <span class="star">*</span></span>
												<input type="radio" id="home" name="shipping_address_type" value="home" checked>
												<label for="home">Home</label>
												<input type="radio" id="office" name="shipping_address_type" value="office" >
												<label for="office">Office</label>
												<input type="radio" id="other" name="shipping_address_type" value="other" >
    										<label for="other">Other</label>
											</div>
											<div class="form-group col-md-6">
												<button type="button" class="odr-cancel-btn w-100 text-center" href="#">CANCEL</button>
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

@endsection
