@extends('frontend.layouts.app')
@section('title','Select Address')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Select Address</h1>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>
<!--order progrrss section start-->
<div class="container top-padding address-top-spc pt-3 pb-4 container-myaccounts">

	<div class="row delivery-details-row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
					<div class="order-address borderh2">
						<h2>Select Address</h2>
					</div>
					@if(isset($shipping_addresses))
					<form class="odr-progress-form" action="{{ url('/addresses/sotreselectedaddress') }}" method="post">
						{{ csrf_field() }}
					<div class="row mb-4">
						@foreach($shipping_addresses as $shipping_address)
							<!-- <hr class="w-100"> -->
								<div class="col-md-6 col-sm-6 col-12 mt-4">
									<div class="ord-address border select__addr">
										<p class="ord-name">
											<span class="ord-name-space">{{ $shipping_address->shipping_full_name }}</span>
											<span class="home-link">@if($shipping_address->shipping_address_type=='home')HOME @elseif($shipping_address->shipping_address_type=='office')OFFICE @elseif($shipping_address->shipping_address_type=='other')OTHER @endif</span>
											<span class="ord-contact">@if($shipping_address->default_address_flag==1)(Default) @endif</span>
											<span class="form-group address-type">
												<input type="radio" id="address_{{ $shipping_address->shipping_address_id }}" name="shipping_address_id" value="{{ $shipping_address->shipping_address_id }}" @if($shipping_address->default_address_flag=='1')checked @endif>
												<label for="address_{{ $shipping_address->shipping_address_id }}"></label>
											</span>
										</p>
										<p class="ord-add">{{ $shipping_address->shipping_address_line1 }}, {{ $shipping_address->shipping_address_line2 }}<br>{{ $shipping_address->shipping_landmark }}</br>{{ $shipping_address->shipping_city }} - {{ $shipping_address->shipping_pincode }}
											<br>{{ $shipping_address->shipping_district }}, {{ $shipping_address->shipping_state }}</p>
										<p class="ord-contact">Contact Number: {{ $shipping_address->shipping_mobile_no }} </p>

									</div>

								</div>
								<!-- <div class="col-md-4 col-sm-4 plus-div col-12 align-self-end justify-content-center">
									<div class="ord-add-btn1">
										<p class="add-link1 text-center "><a href="#"> + </a></p>
									</div>
									<div class="addnew-butn">
										<button class="ord-addnew-address" type="submit" name="button">ADD NEW ADDRESS</button>
									</div>
								</div> -->
						@endforeach
					@endif

				</div>
				<div class="row">
					<div class="form-group col-md-2">
						<!-- <button type="button" class="odr-cancel-btn w-100 text-center" href="#">CANCEL</button> -->
						<a href="{{ url('/cart/checkout') }}" class="btn odr-cancel-btn w-100 text-center">CANCEL</a>
					</div>
					<div class="form-group col-md-2 ">
						<button type="submit" class="odr-save-btn w-100 text-center">SAVE CHANGES</button>
					</div>
				</div>
			</form>


			</div>
		</div>

	</div>
</div>

<!--order progrrss section end-->

@endsection
