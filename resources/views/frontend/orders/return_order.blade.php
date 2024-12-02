@extends('frontend.layouts.myaccount')
@section('title','Return Order')
@section('content')

<!--order details section start-->
<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Return Order</h1>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>
@if(isset($orders))


<div class="container order-padding1 container-myaccounts">
	<div class="row delivery-details-row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-12">
			<div class="confirm-goback-product">
				@include('frontend.includes.errors')
				<p>Please tell the reason for returning your order<span class="star">*</span></p>
				<p>Please tell us a correct reason for returning your order. This information is only used to improve our service.<!-- <span class="star">*</span> --></p>
				<form class="confirm-product-form" action="{{ url('/myaccount/orders/return')}}" method="get" >
					{{ csrf_field() }}
					<div class = "form-group select-dropdown">
			  			<div class="select-arrrow">
							{{ Form::hidden('order_id', $orders->order_id) }}
							{{ Form::select('order_return_reason_id', $reasons, null,['class'=>'form-control-h form-control ', 'placeholder' => 'Please Select a Reason',]) }}
						</div>
					</div>
					<div class="form-check mt-3 mb-2">
						<input class="form-check-input" type="checkbox" value="1" name="confirm" id="defaultCheck1">
						<label class="common_checkbox" for="defaultCheck1">
							I confirm that the product/s is/are in orignal condition, unused and with original tags, labels, accessories and packaging intact.
						</label>
					</div>  
					<div class="confirm-product-btn">
						<!-- <button class="goback-btn" type="button" name="button">GO BACK</button> -->
						<a class="btn goback-btn" href="{{ url('/myaccount/ordersreturn') }}">GO BACK</a>
						@if($orders->payment_mode=='payumoney')
						<button class="confirm-btn" type="submit" name="button">CONFIRM RETURN </button>
						@elseif($orders->payment_mode=='cod')
						<button class="confirm-btn" type="submit" name="button">PICKUP ADDRESS</button>
						@else
						<button class="confirm-btn" type="submit" name="button">CONFIRM RETURN</button>
						@endif
						
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4 col-sm-12 col-12">

		</div>
	</div>
</div>
<!--order details section end-->
 @endif
<!-- hide show content -->
<script>
$('.viewdetails-content').click(function() {
    $('#targetshow').toggle(0);
});
</script>
@endsection
