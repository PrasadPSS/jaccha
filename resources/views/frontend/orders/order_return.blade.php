@extends('frontend.layouts.myaccount')
@section('title','Return Orders')
@section('content')

<!--order details section start-->
<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Return Orders</h1>
					</div>
				</div>
			</div>
			<div class="row your-order-row">
				@if(isset($orders) && count($orders)>0)
				@php $card_type = "return"; @endphp
				@foreach($orders as $order)
					@include('frontend.orders.includes.order_listing_card',compact('order','card_type'))
				@endforeach
				@else
					<div class="col-md-12">
						<div class="delivery-details-box delivery-details-border">
							No Record Found
						</div>
					</div>
				@endif

			</div>
		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>




<!--order details section end-->

<!-- hide show content -->
<script>
$('.viewdetails-content').click(function() {
    $('#targetshow').toggle(0);
});
</script>
@endsection
