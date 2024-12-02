@extends('frontend.layouts.app')
@section('title','Addresses')
@section('content')

<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Addresses</h1>
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
	<div class="row">
		<div class="col-md-2">
			<!-- <div class="col-md-4 col-sm-4 plus-div col-12 align-self-end justify-content-center"> -->
				<!-- <div class="ord-add-btn1">
					<p class="add-link1 text-center "><a href="#"> + </a></p>
				</div> -->
				<div class="addnew-butn">
					<!-- <button class="ord-addnew-address" type="submit" name="button">ADD NEW ADDRESS</button> -->
					<a href="{{ url('/addresses/addaddress') }}" class="btn ord-addnew-address">ADD NEW ADDRESS</a>
				</div>
			<!-- </div> -->
		</div>
	</div>
	<div class="row delivery-details-row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
					<div class="order-address borderh2">
						<h2>Address</h2>
					</div>
					@if(isset($shipping_addresses))
					<!-- <hr class="w-100"> -->
							<div class="row mb-4">
						@foreach($shipping_addresses as $shipping_address)
							
								<div class="col-md-4 col-sm-4 col-12 ord-address-box">
									<div class="ord-address">
										<p class="ord-name">
											<span class="ord-name-space">{{ $shipping_address->shipping_full_name }}</span>
											<span class="home-link">@if($shipping_address->shipping_address_type=='home')HOME @elseif($shipping_address->shipping_address_type=='office')OFFICE @elseif($shipping_address->shipping_address_type=='other')OTHER @endif</span>
											<span class="ord-contact">@if($shipping_address->default_address_flag==1)(Default) @endif</span>
										</p>
										<p class="ord-add">{{ $shipping_address->shipping_address_line1 }}, {{ $shipping_address->shipping_address_line2 }}<br>{{ $shipping_address->shipping_landmark }}</br>{{ $shipping_address->shipping_city }} - {{ $shipping_address->shipping_pincode }}
											<br>{{ $shipping_address->shipping_district }}, {{ $shipping_address->shipping_state }}</p>
										<p class="ord-contact">Contact Number: {{ $shipping_address->shipping_mobile_no }} </p>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="ord-edit-remove">
												<!-- <button class="ord-edit" type="submit" name="button">EDIT</button> -->
												<a href="{{ url('/addresses/editaddress',$shipping_address->shipping_address_id) }}" class="btn ord-edit">EDIT</a>
												<!-- <button class="ord-remove" type="submit" name="button">REMOVE</button> -->
												<a href="{{ url('/addresses/deleteaddress',$shipping_address->shipping_address_id) }}" class="btn ord-remove">REMOVE</a>
											</div>
										</div>
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
						</div>
					@endif


			</div>
		</div>

	</div>
</div>

<!--order progrrss section end-->

@endsection
