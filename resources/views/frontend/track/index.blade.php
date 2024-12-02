@extends('frontend.layouts.app')
@section('title','Wishlist')
@section('content')

<!--order details section start-->
<div class="container top-padding ">
  <div class="row ">
		<div class="col-md-12 col-sm-12 col-12">
			<div class="order-details">
				<h1>Order Details</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
				<div class="order-address">
					<h2>Delivery Address</h2>
				</div>
				<div class="row">
					<div class="col-md-8 col-sm-8 col-12">
						<div class="ord-address">
							<p class="ord-name"><span class="ord-name-space">Dilip Parwani</span><span class="home-link">HOME</span></p>
							<p class="ord-add">501, Vishnu Darshan Apartment<br>Aman Talkies<br>Ulhasnagar - 421003</p>
							<p class="ord-contact">Contact Number: 9212548974 </p>
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
					<div class="col-md-4 col-sm-4 col-12 align-self-end justify-content-center">
						<div class="ord-add-btn">
							<p class="add-link text-center "><a href="#"> + </a></p>
						</div>
						<div class="">
							<button class="ord-addnew-address" type="submit" name="button">ADD NEW ADDRESS</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row delivery-details-row">
				<div class="col-md-12">
					<div class="delivery-details-box">
						<div class="delivery-details-head">
							<h2>Estimated Delivery Period</h2>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-12 ">
								<div class="delivery-period">
									<p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-sm-3 col-4 ">

									<img src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" class="img-fluid" alt="">

							</div>
							<div class="col-md-9 col-sm-9 col-8 ">
								<div class="delivery-product-info">
									<p><span class="delivery-pro-name">Kapachi</span></p>
									<p><span class="delivery-pro-type">Western Top</span></p>
									<p><span class="delivery-pro-price">₹500</span><span class="delivery-pro-original mrp-cut">₹1000</span><span class="delivery-pro-discount">(50% OFF)</span></p>
									<p><span class="delivery-pro-description">You are saving  ₹500 on this Order</span></p>
									<p><span class="delivery-pro-color">Colour: Pink</span><span class="delivery-pro-size">Size: 5XL</span><span class="delivery-pro-quantity">Quantity: 1</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-12 order-details-box2">
			<div class="order-details-box ">
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
						      <td>TOTAL M.R.P. (Inclusive of all taxes)</td><td class="text-right">₹1000</td>
						    </tr>
						    <tr>
						      <td>SHIPPING CHARGES</td><td class="text-right price-color">FREE</td>
						    </tr>
						    <tr>
						      <td>CART DISCOUNT </td><td class="text-right price-color">- ₹500</td>
						    </tr>
						    <tr>
						      <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹50</td>
						    </tr>
						    <tr>
						      <td>ADDITIONAL DISCOUNT</td><td class="text-right price-color">- ₹10</td>
						    </tr>
						    <tr class=" total-amount">
						      <td>TOTAL PAYABLE AMOUNT</td><td class="text-right">₹440</td>
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
									<td>GRAND TOTAL AMOUNT </td><td class="text-right">₹400</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12 ">
					<div class="ord-continue-btn">
						<button class="w-100" type="button" name="button">CONTINUE</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="order-details">
						<h1>Your Orders</h1>
					</div>
				</div>
			</div>
			<div class="row your-order-row">
				<div class="col-md-12">
					<div class="delivery-details-box">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-12 ">
								<div class="order-info">
									<p> <span class="mr-4">Order Number: 9998886660</span> <span class="">Order Confirmation Date: 16th January, 2021     </span></p>
								</div>
								<div class="delivery-period">
									<p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-sm-3 col-6 ">

									<img src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" class="img-fluid" alt="">

							</div>
							<div class="col-md-6 col-sm-6 col-6 ">
								<div class="delivery-product-info">
									<p><span class="delivery-pro-name">Kapachi</span></p>
									<p><span class="delivery-pro-type">Western Top</span></p>
									<p><span class="delivery-pro-price">₹500</span><span class="delivery-pro-original mrp-cut">₹1000</span><span class="delivery-pro-discount">(50% OFF)</span></p>
									<p><span class="delivery-pro-description">You are saving  ₹500 on this Order</span></p>
									<p><span class="delivery-pro-color">Colour: Pink</span><span class="delivery-pro-size">Size: 5XL</span><span class="delivery-pro-quantity">Quantity: 1</span></p>
								</div>
							</div>
							<div class="col-md-3 col-sm-3 col-12 pr-0">
								<div class="ord-confirm-view-btn">
									<button class="ord-confirmed" type="button" name="button">CONFIRMED</button>
									<button class="ord-view viewdetails-content" type="button" name="button" >VIEW DETAILS</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-12 col-sm-12 col-12">

		</div>
	</div>
</div>

<div class="container" id="targetshow">
	<div class="row delivery-details-row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
				<div class="">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-12 ">
							<div class="order-info">
								<p> <span class="mr-4">Order Number: 9998886660</span> <span class="">Order Confirmation Date: 16th January, 2021     </span></p>
							</div>
							<div class="delivery-period">
								<p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-3 col-3 ">
							<div class="">
								<img src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" class="img-fluid" alt="">
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-9 ">
							<div class="delivery-product-info">
								<p><span class="delivery-pro-name">Kapachi</span></p>
								<p><span class="delivery-pro-type">Western Top</span></p>
								<p><span class="delivery-pro-price">₹500</span><span class="delivery-pro-original">₹1000</span><span class="delivery-pro-discount">(50% OFF)</span></p>
								<p><span class="delivery-pro-description">You are saving  ₹500 on this Order</span></p>
								<p><span class="delivery-pro-color">Colour: Pink</span><span class="delivery-pro-size">Size: 5XL</span><span class="delivery-pro-quantity">Quantity: 1</span></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 trace-product">
							<div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
								<div class="step completed">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-cart"></i></div>
									</div><h4 class="step-title">Confirmed</h4>
								</div>
								<div class="step completed">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-config"></i></div>
									</div><h4 class="step-title">Preparing your Order</h4>
								</div>
								<div class="step completed">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-medal"></i></div>
									</div><h4 class="step-title">Shipped</h4>
								</div>
								<div class="step">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-car"></i></div>
									</div><h4 class="step-title">Out for Delivery</h4>
								</div>
								<div class="step">
									<div class="step-icon-wrap">
										<div class="step-icon"><i class="pe-7s-home"></i>
										</div>
									</div><h4 class="step-title">Delivered</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="delivery-details-row  order-details-box">
				<div class="row ">
					<div class="col-md-12">
						<div class="cancel-order">
							<button type="button" name="button">CANCEL</button>
							<p>12 hours</p>
						</div>
					</div>
				</div>
				<div class="row ">
					<div class="col-md-12">
						<div class="odr-note">
							<p><span>Please Note:</span>Once your Order is shipped by us. Thereafter you cannot cancel the Order.</p>
						</div>
					</div>
				</div>
			</div>
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
								<p class="ord-name"><span class="ord-name-space">Dilip Parwani</span><span class="home-link">HOME</span></p>
								<p class="ord-add">501, Vishnu Darshan Apartment<br>Aman Talkies<br>Ulhasnagar - 421003</p>
								<p class="ord-contact">Contact Number: 9212548974/9633336666  </p>
							</div>
						</div>
					</div>

			</div>
			<div class="order-details-box">
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
						      <td>TOTAL M.R.P. (Inclusive of all taxes)</td><td class="text-right">₹1000</td>
						    </tr>
						    <tr>
						      <td>SHIPPING CHARGES</td><td class="text-right price-color">FREE</td>
						    </tr>
						    <tr>
						      <td>CART DISCOUNT </td><td class="text-right price-color">- ₹500</td>
						    </tr>
						    <tr>
						      <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹50</td>
						    </tr>
						    <tr>
						      <td>ADDITIONAL DISCOUNT</td><td class="text-right price-color">- ₹10</td>
						    </tr>
						    <tr class=" total-amount">
						      <td>TOTAL PAYABLE AMOUNT</td><td class="text-right">₹440</td>
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
									<td>TOTAL AMOUNT PAID</td><td class="text-right">₹400</td>
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
	<div class="row delivery-details-row">
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
