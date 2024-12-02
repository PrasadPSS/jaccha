@extends('frontend.layouts.myaccount')
@section('title','Order Details')
@section('content')

<!--order details section start-->
<div class="container top-padding container-myaccounts">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Order Details</h1>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>
@if(isset($orders))
<div class="container container-myaccounts" id="targetshow">
	<div class="row delivery-details-row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
				<div class="">
					<div class="row ">
						<div class="col-md-12 col-sm-12 col-12 ">
							<div class="order-info">
								<p>
									<span class="mr-4">Order Number: {{ $orders->orders_counter_id }}</span>
									<span class="">Order Confirmation Date: {{ date('jS F, Y',strtotime($orders->created_at)) }}     </span>
								</p>
							</div>
							<!-- <div class="delivery-period">
								<p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
							</div> -->
						</div>
					</div>
					@if(isset($orders->orderproducts))
					@foreach($orders->orderproducts as $orderproducts)

					@php
						//dd($orderproducts);
						$join_table = 'products';
						$product_thumb_location = 'product_thumbs';
						$product_image = '';
						if($orderproducts->product_type=="configurable")
						{
							$join_table = 'product_variant';
							$product_thumb_location = 'product_variant_thumbs';
						}
						if(isset($orderproducts->{$join_table}->product_thumb) && $orderproducts->{$join_table}->product_thumb != '' && $orderproducts->{$join_table}->product_thumb != null)
						{
							$product_image = $orderproducts->{$join_table}->product_thumb;
						}
						else
						{
							$product_thumb_location = 'product_thumbs';
							$product_image = isset($orderproducts->products)?$orderproducts->products->product_thumb:'';
						}
					@endphp
					<div class="row mb-3 tracker-details-row">
						<div class="col-md-3 col-sm-3 col-4 ">
							<div class="">
								<img src="{{ asset('backend-assets/uploads/'.$product_thumb_location.'/') }}/{{ $product_image }}" class="img-fluid" alt="">
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-8 ">
							<div class="delivery-product-info">
								<p><span class="delivery-pro-name">{{ $orderproducts->product_sub_title }}</span></p>
								<p><span class="delivery-pro-type">{{ $orderproducts->product_title }}</span></p>
								<p>
									@if($orderproducts->product_discounted_price!=null && $orderproducts->product_discount!=0)
										<span class="delivery-pro-price">₹ {{ isset($orderproducts->product_discount)?$orderproducts->product_discounted_price:$orderproducts->product_price }}</span>
										<span class="delivery-pro-original">₹ {{ $orderproducts->product_price }}</span>
									@elseif($orderproducts->product_discounted_price!=null && $orderproducts->product_discount==0)
										<span class="delivery-pro-price">₹  {{$orderproducts->product_discounted_price}}</span>
									@else
										<span class="delivery-pro-original">₹ {{$orderproducts->product_price}}</span>
									@endif
									@if($orderproducts->product_discount_type!=null && $orderproducts->product_discount_type=='percent' && $orderproducts->product_discount!=0)
										<span class="delivery-pro-discount">({{ $orderproducts->product_discount }}% OFF)</span>
									@elseif($orderproducts->product_discount_type!=null && $orderproducts->product_discount_type=='flat' && $orderproducts->product_discount!=0)
										<span class="delivery-pro-discount">(₹ {{ $orderproducts->product_discount }} OFF)</span>
									@endif
								</p>
								@if(isset($orderproducts->product_discount) && $orderproducts->product_discount!=0)
								<p>
									<span class="delivery-pro-description">
										You are saving  ₹ {{ $orderproducts->product_price-$orderproducts->product_discounted_price }} on this Order
									</span>
								</p>
								@endif
								<p>
									<span class="delivery-pro-color"><b>Colour:</b> {{ $orderproducts->product_color }}</span>
									<span class="delivery-pro-size"><b>Size:</b> {{ $orderproducts->product_size }}</span>
									<span class="delivery-pro-quantity"><b>Quantity:</b> {{ $orderproducts->qty }}</span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
				@endif
				@if($orders->cancel_order_flag==0)
					<div class="row ">
						<div class="col-md-12 trace-product">
							<div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
								<div class="step @if($orders->confirmed_stage==1)completed @endif">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-cart"></i></div>
									</div><h4 class="step-title">Confirmed</h4>
								</div>
								<div class="step @if($orders->preparing_order_stage==1)completed @endif">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-config"></i></div>
									</div><h4 class="step-title">Preparing your Order</h4>
								</div>
								<div class="step @if($orders->shipped_stage==1)completed @endif">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-medal"></i></div>
									</div><h4 class="step-title">Shipped</h4>
								</div>
								<div class="step @if($orders->out_for_delivery_stage==1)completed @endif">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-car"></i></div>
									</div><h4 class="step-title">Out for Delivery</h4>
								</div>
								<div class="step @if($orders->delivered_stage==1)completed @endif">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-home"></i>
										</div>
									</div><h4 class="step-title">Delivered</h4>
								</div>
							</div>
						</div>
					</div>
				@else
				<div class="row ">
            <div class="col-md-6 trace-product">
                <div class="ord-confirm-view-btn mt-0 mb-2">
                    <button class="btn viewdetails-content ord-confirmed ord-view btn-sm" type="button" name="button">ORDER CANCELLED @if(isset($orders->cancelreason) && $orders->cancelreason->for_dadreeios ==1) BY DADREEIOS @endif</button>
                </div>
            </div>
			<div class="col-md-6">

			</div>
			<div class="col-md-8 col-12">
				<p><b>Reason:</b> {{$orders->cancel_reason}}</p>
			</div>
			<div class="col-md-4 col-12">
				<p><b>Date:</b> {{$orders->cancel_order_date}}</p>
			</div>
        </div>
				@endif
				</div>
			</div>
			@if($orders->cancel_order_flag==0  && $orders->shipped_stage==0)
			<div class="delivery-details-row  order-details-box">
				@php
					$cancel_status = order_cancel_days_status($orders);
					//dd($cancel_status);
				@endphp
				@if($cancel_status && $orders->delivered_stage==0)
				<div class="row ">
					<div class="col-md-12">
						<div class="cancel-order">
							<button type="button" name="button"><a class="" href="{{ url('/myaccount/orders/cancel',$orders->order_id) }}">CANCEL</a></button>

							<p>
								@if($order_cancel->order_cancel_max_days>0)
								{{$order_cancel->order_cancel_max_days}} days
								@endif
								{{$order_cancel->order_cancel_max_hours}} hours
							</p>
						</div>
					</div>
				</div>
				@endif
				<div class="row ">
					<div class="col-md-12">
						<div class="odr-note">
							<p><span>PLEASE NOTE: </span>{{$order_cancel->order_cancel_note}}</p>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="price-details">
							<h2>SHIPPING DETAILS</h2>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<p class="ord-name">
									<span class="ord-name-space">{{ $orders->shipping_full_name }}</span>
									<span class="home-link">
										@if($orders->shipping_address_type=='home')
	                    HOME
	                  @elseif($orders->shipping_address_type=='office')
	                    OFFICE
	                  @elseif($orders->shipping_address_type=='other')
	                    OTHER
	                  @endif
									</span>
								</p>
								<p class="ord-add">
									{{ $orders->shipping_address_line1 }}, {{ $orders->shipping_address_line2 }}
									{{ $orders->shipping_landmark }}</br>
                	                {{ $orders->shipping_city }} - {{ $orders->shipping_pincode }}<br>
                	                {{ $orders->shipping_district }}, {{ $orders->shipping_state }}
								</p>
								<p class="ord-contact">Contact Number: {{ $orders->shipping_mobile_no }}{{ ($orders->shipping_alt_mobile_no!='')?'/'.$orders->shipping_alt_mobile_no:'' }}  </p>
							</div>
						</div>
					</div>

			</div>
			<div class="order-details-box mb-0">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="price-details">
							<h2>PRICE DETAILS</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<table class="price-details-table">
						  <tbody>
						    <tr class="price-total">
						      <td>TOTAL M.R.P. (Inclusive of all taxes)</td><td class="text-right">₹ {{ ($orders->total_mrp!='')?$orders->total_mrp:0 }}</td>
						    </tr>
								<tr>
								 <td>DISCOUNT ON M.R.P. </td><td class="text-right price-color">- ₹ {{ ($orders->total_mrp_dicount!='')?$orders->total_mrp_dicount:0 }}</td>
							 </tr>
							 <tr>
								 <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹ {{ ($orders->coupon_discount!='')?$orders->coupon_discount:0 }}</td>
							 </tr>
						    <tr>
						      <td>SHIPPING CHARGES</td><td class="text-right price-color">{{ ($orders->shipping_method_code=='flat' && $orders->shipping_amount>0)?'₹ '.$orders->shipping_amount:'FREE' }}</td>
						    </tr>
								@if($orders->payment_mode=='cod')
								<tr>
									<td>COD COLLECTION CHARGE</td><td class="text-right price-color">₹ {{ $orders->cod_collection_charge_amount }}</td>
								</tr>
								@endif


						    <!-- <tr>
						      <td>ADDITIONAL DISCOUNT</td><td class="text-right price-color">- ₹10</td>
						    </tr> -->
								<tr class=" total-amount">
						      <td class="pt-4">SUB TOTAL </td><td class="text-right pt-4">₹ {{ $orders->total }}</td>
						    </tr>
						    <tr class=" total-amount">
						      <td>TOTAL PAYABLE AMOUNT</td><td class="text-right">₹ {{ $orders->total }}</td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row  ">
				<div class="col-md-12 col-sm-12 col-12 ">
					<div class="grand-total">
						<table class="price-details-table">
							<tbody>
								<tr>
									@php
										$payment_status = '';
										if($orders->payment_mode=='cod' && $orders->paymentinfo->status=='processing')
										{
											$payment_status = 'TO BE ';
										}
									@endphp
									<td>TOTAL AMOUNT {{$payment_status}}PAID</td><td class="text-right">₹ {{ $orders->total }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container pb-4">
	<!-- <div class="row delivery-details-row">
		<div class="col-md-8 col-sm-12 col-12">
			<div class="confirm-goback-product">

					<p>Please select the reason for cancellation of your order<span class="star">*</span></p>

				<form class="confirm-product-form" action="" method="post" >
				<div class = "form-group ">
			  <div class="select-arrrow">
			  <select class="form-control form-control-h" placeholder="Source Type" required>
			    <option hidden>Don’t want this product</option>
			    <option>Want to order same product in a different size</option>
			    <option>Want to order same product in a different colour</option>
			    <option>Want to order different product</option>
			    <option>Ordered this product by mistake</option>
			    <option>This is duplicate order</option>
			    <option>Product Return Related</option>
			    <option>Delivery date is too long</option>
			    <option>Others</option>
			  </select>
			  </div>
			  </div>
				<div class="confirm-product-btn">
					<button class="goback-btn" type="button" name="button">GO BACK</button>
					<button class="confirm-btn" type="button" name="button">CONFIRM</button>
				</div>
			</form>
			</div>
		</div>
		<div class="col-md-4 col-sm-12 col-12">

		</div>
	</div> -->
</div>
<!--order details section end-->
 @endif
<!-- hide show content -->
<script>
$('.viewdetails-content1').click(function() {
    $('#targetshow').toggle(0);
});
</script>
@endsection
