@extends('frontend.layouts.app')
@section('title','Checkout')
@section('content')


<!--order details section start-->
<div class="container top-padding container-myaccounts">
  <div class="row ">
		<div class="col-md-12 col-sm-12 col-12">
			<div class="order-details">
				<h1>Order Details</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7 col-md-12 col-sm-12 col-12">
			<div class="order-details-box">
				<div class="order-address">
					<h2>Delivery Address
            <div class="col-md-4 col-sm-4 col-12 align-self-end justify-content-center float-right select-other-adr pr-0 pd-left">
              <a href="{{ url('/addresses/selectaddress') }}" class="btn  ord-addnew-address ord-select-address">SELECT OTHER ADDRESS</a>
            </div>
          </h2>
				</div>
				<div class="row checkout-main-row ">
					<div class="col-md-8 col-sm-8 col-12">
						<div class="ord-address">
							<p class="ord-name">
                <span class="ord-name-space">{{ $shipping_address->shipping_full_name }}</span>
                <span class="home-link">
                  @if($shipping_address->shipping_address_type=='home')
                    HOME
                  @elseif($shipping_address->shipping_address_type=='office')
                    OFFICE
                  @elseif($shipping_address->shipping_address_type=='other')
                    OTHER
                  @endif
                </span>
              </p>
							<p class="ord-add">
                {{ $shipping_address->shipping_address_line1 }}, {{ $shipping_address->shipping_address_line2 }}<br>
                {{ $shipping_address->shipping_landmark }}</br>
                {{ $shipping_address->shipping_city }} - {{ $shipping_address->shipping_pincode }}<br>
                {{ $shipping_address->shipping_district }}, {{ $shipping_address->shipping_state }}
              </p>
              <p class="ord-contact">Contact Number: {{ $shipping_address->shipping_mobile_no }} </p>
              @if($pin_response)
              <div style="background-color: rgba(224, 32, 32, 0.05); color: rgb(224, 32, 32);" class="mb-2">
			           <span>This pincode is currently not serviceable. Kindly change your address.</span>
              </div>
              @endif
              <input type="hidden" name="shipping_pincode" id="shipping_pincode" value="{{ $shipping_address->shipping_pincode }}">
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
					<div class="col-md-4 col-sm-4 col-12 align-self-end justify-content-center">
						<!-- <div class="ord-add-btn">
							<p class="add-link text-center "><a href="#"> + </a></p>
						</div> -->
						<div class="button-extra-spac">
							<button class="ord-addnew-address" id="addaddressbtn" type="submit" name="button">ADD NEW ADDRESS</button>
              <!-- <a href="{{ url('/addresses/addaddress') }}" class="btn ord-addnew-address">ADD NEW ADDRESS</a> -->

						</div>
					</div>
				</div>
			</div>
			<div class="row delivery-details-row">
				<div class="col-md-12">
					<div class="delivery-details-box border-estimated">
						<div class="delivery-details-head">
							<h2>Estimated Delivery Date</h2>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-12 ">
								<div class="delivery-period">
                  @php
                    $today = date('d-m-Y');
                    $no_of_days = ($order_delivery->order_delivery_max_days>0)?$order_delivery->order_delivery_max_days:7;
                    $estimated_delivery_date = date('dS F, Y', strtotime($today. ' + '.$no_of_days.' days'));
                  @endphp
									<p>Estimated Delivery Date: {{$estimated_delivery_date}}</p>
								</div>
							</div>
						</div>
            @php
              $total_price = $cart_amounts->cart->cart_discounted_total;
              $total_mrp = $cart_amounts->cart->cart_mrp_total;
              $total_discount = $cart_amounts->total_discount;
              $coupon_value = 0;
              $coupon_discount = 0;
              $product_info = "";
            @endphp
            @foreach($cart as $item)

            @php
              $join_table = 'products';
              $product_thumb_location = 'product_thumbs';
              $product_image = '';
              if($item->product_type=="configurable")
              {
                $join_table = 'product_variant';
                $product_thumb_location = 'product_variant_thumbs';
              }
              if(isset($item->{$join_table}->product_thumb) && $item->{$join_table}->product_thumb != '' && $item->{$join_table}->product_thumb != null)
              {
                $product_image = $item->{$join_table}->product_thumb;
              }
              else
              {
                $product_thumb_location = 'product_images';
                $product_image = isset($item->product_images[0])?$item->product_images[0]->image_name:'';
              }
            @endphp
						<div class="row display-products">
							<div class="col-md-3 col-sm-3 col-4 ">
								<div class="">
									<img src="{{ asset('backend-assets/uploads/'.$product_thumb_location.'/') }}/{{ $product_image }}" class="img-fluid" alt="">
								</div>
							</div>
							<div class="col-md-9 col-sm-9 col-8 ">
								<div class="delivery-product-info">
									<p>
                    <span class="delivery-pro-name">
                      @if(isset($item->products->brands->brand_name))
                      {{ $item->products->brands->brand_name }}
                      @else &nbsp;
                      @endif
                    </span>
                  </p>
									<p><span class="delivery-pro-type">{{ $item->{$join_table}->product_title }}</span></p>
									<p>
                    @if($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount!=0)
                      <span class="delivery-pro-price">₹ {{ isset($item->{$join_table}->product_discount)?$item->{$join_table}->product_discounted_price:$item->{$join_table}->product_price }}</span>
                      <span class="delivery-pro-original mrp-cut">₹ {{ $item->{$join_table}->product_price }}</span>
                    @elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
                      <span class="delivery-pro-price">₹ {{$item->{$join_table}->product_discounted_price}}</span>
                    @else
                      <span class="delivery-pro-original mrp-cut">₹ {{$item->{$join_table}->product_price}}</span>
                    @endif
                    @if($item->{$join_table}->product_discount_type!=null && $item->{$join_table}->product_discount_type=='percent' && $item->{$join_table}->product_discount!=0)
                      <span class="delivery-pro-discount">({{ $item->{$join_table}->product_discount }}% OFF)</span>
                    @elseif($item->{$join_table}->product_discount_type!=null && $item->{$join_table}->product_discount_type=='flat' && $item->{$join_table}->product_discount!=0)
                      <span class="delivery-pro-discount">(₹ {{ $item->{$join_table}->product_discount }} OFF)</span>
                    @endif
                  </p>
									@if(isset($item->{$join_table}->product_discount) && $item->{$join_table}->product_discount!=0)
                  <p>
                    <span class="delivery-pro-description">
                      You are saving  ₹ {{ $item->{$join_table}->product_price-$item->{$join_table}->product_discounted_price }} on this Order
                    </span>
                  </p>
                  @endif
									<p>
                    <span class="delivery-pro-color"><b>Colour :</b> {{ isset($item->{$join_table}->color)?$item->{$join_table}->color->color_name:'' }}</span>
                    <span class="delivery-pro-size"><b>Size :</b> {{ isset($item->{$join_table}->size)?$item->{$join_table}->size->size_name:'FREE' }}</span>
                    <span class="delivery-pro-quantity"><b>Quantity :</b> {{ $item->qty }}</span>
                  </p>
								</div>
							</div>
						</div>
            @php
              $product_info .= $item->{$join_table}->product_title.",";
            @endphp
            @endforeach
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-5 col-md-12 col-sm-12 col-12 order-details-box2">

      <div class="order-details-box mb-3" id='deliveryaddbox' style="display:none;">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="order-address">
						<h2>ADD NEW ADDRESS</h2>
					</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ord-address">
								<div class="odr-form">

									<form class="odr-progress-form" action="{{ url('/addresses/storeaddress') }}" method="post">
										{{ csrf_field() }}
                    <input type="hidden" name="checkout_flag" value="1">
										<div class="form-row">
											<p>DETAILS</p>
											<div class="form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_full_name" required>
													<label class="" for="user">Full Name <span class="star">*</span></label>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h entermobno" type="text" name="shipping_mobile_no" value="" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" required> <!-- required -->
													<label class="enter_Mobile_number" for="user">Enter Mobile Number <span class="star">*</span></label>
												</div>
												
											</div>
											
											<div class = "form-group col-md-12">
												<div class="input-wrapper shipping_mob_no">
													<input class="form-control form-control-h" type="text" name="shipping_alt_mobile_no" value="" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*" >
													<label class="enter_Mobile_number" for="user">Alternate Mobile Phone Number </label>
												</div>
											</div>
											<div class = "form-group col-md-12">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="email" id="email" name="shipping_email" required>
													<label for="user">Email <span class="star">*</span></label>
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
													<input class="form-control form-control-h" type="text" name="shipping_pincode" required id="shipping_pincode_add" maxlength="6">
													<label class="" for="user">Pincode <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_district" required id="shipping_district_add">
													<label class="" for="user">District <span class="star">*</span></label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-wrapper">
													<input class="form-control form-control-h" type="text" name="shipping_state" required id="shipping_state_add" >
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
												<input type="checkbox" id="default_address_flag" class="set_addr_check" name="default_address_flag" value="1">
												<!-- <label for="default_address_flag">Set as Default Address</label> -->
											</div>
											<div class="form-group col-md-6">
												<button type="button" onclick="hide()" class="ord-addnew-address odr-cancel-btn w-100 text-center" href="#">CANCEL</button>
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
			<div class="order-details-box mb-0">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<div class="price-details">
							<h2>PRICE DETAILS ({{ $cart->sum('qty') }} Item{{ ($cart->sum('qty')>1)?'s':'' }})</h2>
						</div>
					</div>
				</div>
        @if(isset($cart_coupon))
        @php
          $coupon_discount = $cart_amounts->coupon_discount;
        @endphp
        @endif
				<div class="row">
					<div class="col-md-12 col-sm-12 col-12 ">
						<table class="price-details-table">
						  <tbody>
						    <tr class="price-total">
						      <td>TOTAL M.R.P. (Inclusive of all taxes)</td>
                  <td class="text-right">₹ {{ $total_mrp }}</td>
						    </tr>
                <tr>
						      <td>DISCOUNT ON M.R.P. </td><td class="text-right price-color">- ₹ {{ $total_discount }}</td>
						    </tr>
                <tr>
						      <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹ {{ $coupon_discount }}</td>
						    </tr>
						    <tr>
						      <td>SHIPPING CHARGES</td>
                  <td class="text-right price-color">
                    @if(isset($shipping_amount) && $shipping_amount>0)

                      ₹ {{ $shipping_amount}}
                    @else
                    @php
                      $shipping_amount = 0;
                    @endphp
                      FREE
                    @endif
                  </td>
						    </tr>
                <tr id="cod_tr" style="display:none;">
						      <td>COD COLLECTION CHARGE</td><td class="text-right price-color" id="cod_amount">₹ 0</td>
						    </tr>

						    <!-- <tr>
						      <td>ADDITIONAL DISCOUNT</td><td class="text-right price-color">- ₹10</td>
						    </tr> -->
                <tr class=" total-amount">
						      <td class="pt-4">SUB TOTAL</td><td class="pt-4 text-right update_all_cod_amounts">₹ {{ $total_mrp+$shipping_amount-$total_discount-$coupon_discount }}</td>
						    </tr>
						    <tr class=" total-amount">
						      <td>TOTAL PAYABLE AMOUNT</td><td class="text-right update_all_cod_amounts">₹ {{ $total_mrp+$shipping_amount-$total_discount-$coupon_discount }}</td>
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
                    $grand_total = $total_mrp+$shipping_amount-$total_discount-$coupon_discount;
                  @endphp
									<td>GRAND TOTAL AMOUNT </td><td class="text-right update_all_cod_amounts">₹ {{ $grand_total }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="col-md-12 col-sm-12 col-12 ">
					<div class="ord-continue-btn">
            @include('frontend.includes.errors')
            <form class="" action="{{url('cart/payment')}}" method="post">
              {{ csrf_field() }}
              <!--pDejLD-->
              <!--AgchnRvO-->
              <input type="hidden" name="key" value="{{ 'pDejLD' }}" />
              <input type="hidden" name="hash" value=""/>
              <input type="hidden" name="txnid" value="{{ $increment_id }}" />
              <input type="hidden" name="amount" id='gateway_amount' value="{{$grand_total}}" />
              @php
                $name = strtok($user->name," ");
                //dd($name);
              @endphp
              <input type="hidden" name="firstname" id="firstname" value="{{ $shipping_address->shipping_full_name }}" />
              <input type="hidden" name="email" id="email" value="{{ $shipping_address->shipping_email }}" />
              <input type="hidden" name="phone" value="{{ $shipping_address->shipping_mobile_no }}" />
              <input type="hidden" name="productinfo" value="{{ rtrim($product_info,",") }}" />
              <input type="hidden" name="surl" value="{{url('cart/paymentsuccess')}}" size="64" />
              <input type="hidden" name="furl" value="{{url('cart/paymentfailure')}}" size="64" />
              <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
              <!-- payu_paisa -->
              <input type="hidden" name="address1" value="{{ $shipping_address->shipping_address_line1 }}" />
              <input type="hidden" name="city" value="{{ $shipping_address->shipping_city }}" />
              <input type="hidden" name="state" value="{{ $shipping_address->shipping_state }}" />
              <input type="hidden" name="country" value="{{ $shipping_address->shipping_state }}" />
              <input type="hidden" name="zipcode" value="{{ $shipping_address->shipping_pincode }}" />
              <input type="hidden" name="shipping_id" value="{{ $shipping_address->shipping_address_id }}" />

              <!-- <input type="hidden" name="paymentmode" value="payumoney" /> -->
              @if($payment_mode)
              <div class="row payment__box">
                <h2 class="payment__heading">Select Payment Method</h2>
              @foreach($payment_mode as $mode)
                @php
                  $id = str_replace(" ",'_',$mode->payment_mode_name);
                  if($cod_status && $mode->payment_mode_code=='cod')
                  {
                    $disable = "disabled";
                    $title = $cod_rmk;
                  }
                  else
                  {
                    $title = $cod_rmk;
                    $disable = "";
                  }
                @endphp
                  <div class="radio payment_methods col-md-6 reviewcart-payment pl-0">
                    <input name="paymentmode" type="radio" value="{{$mode->payment_mode_code}}" class="payment_mode_cod" id="{{$id}}" {{$mode->default_selected==1?"checked":""}} {{$disable}} required />
                    <label for="{{$id}}" class="radio-label">{{$mode->payment_mode_name}}</label>
                  </div>

              @endforeach
                <div class="coupon-section mt-2">
                    <p>
                        {{$cod_message}}
                    </p>
                </div>
              </div>
              @endif
              <button class="w-100 mb-3" type="submit" name="button" @if($pin_response)disabled @endif>PLACE ORDER</button>
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--order details section end-->

<script>
  $(document).ready(function()
  {
    var shipping_pincode = $("#shipping_pincode").val();
    if (false)
    {

      $.ajax({
          url: 'https://staging-express.delhivery.com/c/api/pin-codes/json/',
          // url: 'https://staging-express.delhivery.com/c/api/pin-codes/json/?token=ec1ee821dc6ca3355a018d48828d3e2ccb892de7&filter_codes='+shipping_pincode,
          type: 'get',
          dataType: "jsonp",
          data: {
            token:'ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
            filter_codes: shipping_pincode,
          },
          success: function (data)
          {
            console.log(data);
            // alert(data);
            // $('#brand_id').html(data);
          }
       });
       //way bill number
       var wbn = '';
       $.ajax({
         url: 'https://staging-express.delhivery.com/waybill/api/fetch/json/',
           // url: 'https://staging-express.delhivery.com/waybill/api/fetch/json/?token=ec1ee821dc6ca3355a018d48828d3e2ccb892de7&filter_codes='+shipping_pincode,
           type: 'get',
           dataType: "jsonp",
           data: {
             token:'ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
             cl: 'GR0068088SURFACE-B2C',
           },
           success: function (data)
           {
             console.log(data);
             // alert(data);
             wbn = data ;
             // $('#brand_id').html(data);
           }
        });

        //bulk waybill api

        $.ajax({
          url: 'https://staging-express.delhivery.com/waybill/api/bulk/json/',
            // url: 'https://staging-express.delhivery.com/waybill/api/fetch/json/?token=ec1ee821dc6ca3355a018d48828d3e2ccb892de7&filter_codes='+shipping_pincode,
            type: 'get',
            dataType: "jsonp",
            data: {
              token:'ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
              cl: 'GR0068088SURFACE-B2C',
              count: 4,
            },
            success: function (data)
            {
              console.log(data);
              // alert(data);
              // wbn = data ;
              // $('#brand_id').html(data);
            }
         });

         //shipping charges

         $.ajax({
           url: 'https://track.delhivery.com/api/kinko/v1/invoice/charges/.json',
             // url: 'https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=S&cgm=500&o_pin=421601&ss=Delivered&d_pin=421605',
             type: 'GET',
             // dataType: "json",
             data: {
               md: "S",
               cgm: "300",
               o_pin: "421003",
               ss: "Delivered",
               d_pin: "421005",
             },
             // headers: {
             //  "Authorization": "Token c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49",
             //  // "token":'token ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
             //  "Accept": "application/json",
             //  "Content-Type": "application/json",
             //  // "cl": 'GR0068088SURFACE-B2C',
             // },
             beforeSend: function(xhr){
               xhr.setRequestHeader('Authorization', 'Token c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49');
               xhr.setRequestHeader('Accept', 'application/json');
               xhr.setRequestHeader('Content-Type', 'application/json');
             },
             success: function (data)
             {
               console.log('data shipping charges');
               console.log(data);
               // alert(data);
               // wbn = data ;
               // $('#brand_id').html(data);
             }
          });

         //create order
         var headers = new Headers();

         // headers.append('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
         $.ajax({
           url: 'https://staging-express.delhivery.com/api/cmu/create.json',
             // url: 'https://staging-express.delhivery.com/waybill/api/fetch/json/?token=ec1ee821dc6ca3355a018d48828d3e2ccb892de7&filter_codes='+shipping_pincode,
             type: 'POST',
             dataType: "jsonp",
             contentType:"application/json",
             crossDomain: true,
             format: "json",
             cache: false,
             async: true,
             // traditional: true,
             headers: {
                "accept": "application/json",
                "Access-Control-Allow-Origin":"*",
             },
             data: {
               token:'ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
               // cl: 'GR0068088SURFACE-B2C',
               "pickup_location":
               {
                  "pin": "421004",
                  "add": "G. R. PARWANI TRADING CO.,403, HARNAM APARTMENT,4TH FLOOR, SECTION 30,NEAR GURUDWARA,ULHASNAGAR – 421004,DISTRICT: THANE,MAHARASHTRA, INDIA",
                  "phone": "7498042995",
                  "state": "MAHARASHTRA",
                  "city": "ULHASNAGAR",
                  "country": "INDIA",
                  "name": "GR 0068088"//name of pickup/warehouse location registered with delhivery
                },
                "shipments": [
                {
                  "return_name": "GR0068088SURFACE-B2C",
                  "return_pin": "421301",
                  "return_city": "Kalyan",
                  "return_phone": "9665459475",
                  "return_add": "Kalyan",
                  "return_state": "MAHARASHTRA",
                  "return_country": "INDIA",
                  "order": "123467800",
                  "phone": "1111111111",
                  "products_desc": "Clothing", // Description of product which is used in shipping label
                  "cod_amount": "100.0",
                  "name": "Mahaesh MOre",
                  "country": "India",
                  "waybill": wbn,//"wbn",//"waybillno.(trackingid)", (optional)
                  "seller_inv_date": "2018-05-18",
                  "order_date": "2018-05-18 06:22:43",
                  "total_amount": "100.0",
                  "seller_add": "",
                  "seller_cst": "",
                  "add": "jaipur, ",
                  "seller_name": "",
                  "seller_inv": "",
                  "seller_tin": "",
                  "pin": "421004",
                  "quantity": "1",
                  "payment_mode": "COD",
                  "state": "MAHARASHTRA",
                  "city": "Kalyan",
                  "client": "GR0068088SURFACE-B2C"
                }]
             },
             success: function (data)
             {
               console.log(data);
               // alert(data);
               // wbn = data ;
               // $('#brand_id').html(data);
             }
          });

          // var settings = {
          // 'cache': false,
          // 'dataType': "json",
          // "async": true,
          // "crossDomain": true,
          // "url": "https://staging-express.delhivery.com/api/cmu/create.json",
          // "method": "POST",
          // "headers": {
          //     "accept": "application/json",
          //     "Access-Control-Allow-Origin":"*"
          //   },
          //   "data": {
          //     token:'ec1ee821dc6ca3355a018d48828d3e2ccb892de7',
          //     // cl: 'GR0068088SURFACE-B2C',
          //     "pickup_location":
          //     {
          //        "pin": "421004",
          //        "add": "G. R. PARWANI TRADING CO.,403, HARNAM APARTMENT,4TH FLOOR, SECTION 30,NEAR GURUDWARA,ULHASNAGAR – 421004,DISTRICT: THANE,MAHARASHTRA, INDIA",
          //        "phone": "7498042995",
          //        "state": "MAHARASHTRA",
          //        "city": "ULHASNAGAR",
          //        "country": "INDIA",
          //        "name": "GR 0068088"//name of pickup/warehouse location registered with delhivery
          //      },
          //      "shipments": [
          //      {
          //        "return_name": "GR0068088SURFACE-B2C",
          //        "return_pin": "421301",
          //        "return_city": "Kalyan",
          //        "return_phone": "9665459475",
          //        "return_add": "Kalyan",
          //        "return_state": "MAHARASHTRA",
          //        "return_country": "INDIA",
          //        "order": "123467800",
          //        "phone": "1111111111",
          //        "products_desc": "Clothing", // Description of product which is used in shipping label
          //        "cod_amount": "100.0",
          //        "name": "Mahaesh MOre",
          //        "country": "India",
          //        "waybill": "wbn",//"waybillno.(trackingid)", (optional)
          //        "seller_inv_date": "2018-05-18",
          //        "order_date": "2018-05-18 06:22:43",
          //        "total_amount": "100.0",
          //        "seller_add": "",
          //        "seller_cst": "",
          //        "add": "jaipur, ",
          //        "seller_name": "",
          //        "seller_inv": "",
          //        "seller_tin": "",
          //        "pin": "421004",
          //        "quantity": "1",
          //        "payment_mode": "COD",
          //        "state": "MAHARASHTRA",
          //        "city": "Kalyan",
          //        "client": "GR0068088SURFACE-B2C"
          //      }]
          //   },
          // }
          //
          // $.ajax(settings).done(function (response) {
          //     console.log('mahesh'+response);
          //
          // });


          // function afficheorga(a){
          //   $.ajax(
          //     {
          //       url: "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json",
          //       type: 'GET',
          //       dataType: 'jsonp',
          //       data: {
          //         md: "S",
          //         cgm: "300",
          //         o_pin: "421003",
          //         ss: "Delivered",
          //         d_pin: "421005",
          //       },
          //       cors: true ,
          //       contentType:'application/json',
          //       secure: true,
          //       // headers: { 'Access-Control-Allow-Origin': '*', },
          //       beforeSend: function (xhr) {
          //         xhr.setRequestHeader('Authorization', 'Token c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49');
          //         xhr.setRequestHeader('Accept', 'application/json');
          //         xhr.setRequestHeader('Content-Type', 'application/json');
          //         xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
          //       },
          //       success: function (data){
          //         // console.log(data.organizations[0].name);
          //         // var organisation = data.organizations[0].name;
          //         // $("#company").text(organisation);
          //         console.log(data);
          //       }
          //     });
          //   }

            // afficheorga(1);
     }
     else
     {
       // alert('Please Enter Password');
     }

     $('#addaddressbtn').on('click',function()
     {
       $('#deliveryaddbox').toggle();
     });
  });
</script>
<!-- <script src="frontend-assets/js/intlTelInput.js"></script>
<script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
      // options here
    }));

    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+" "+ $('#phone').val());
       });
    });
  </script> -->

<script>
function hide() {
    document.getElementById('deliveryaddbox').style.display = 'none';
}
</script>
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
<script>
$(document).ready(function()
{
	$('#shipping_pincode_add').on('keyup',function()
	{
		var shipping_pincode_add = $(this).val();
		// alert(shipping_pincode_add.length);
		if (shipping_pincode_add.length == 6)
		{
			pindata(shipping_pincode_add);
		}
	});

	function pindata(shipping_pincode_add)
	{
		// alert(pincode);
		$.ajax({
				url: '{{url("/addresses/getpincodedata")}}',
				type: 'post',
				data:
				{
					shipping_pincode: shipping_pincode_add ,_token: "{{ csrf_token() }}",
				},
				success: function (data)
				{
					console.log(data);
					if (data != 'N')
					{
						$('#shipping_district_add').val(data['district']);
						$('#shipping_state_add').val(data['state']);
					}
				}
		 });
	}

  var grand_total_for_cod = '{{$grand_total}}';
  var shipping_state_cod = '{{ $shipping_address->shipping_state }}';
  $('.payment_mode_cod').on('change', function()
  {
    var payment_mode_cod = $(this).val();
    if (payment_mode_cod=='cod')
    {
      $.ajax({
  				url: '{{url("/cart/getcodcollectioncharges")}}',
          type: 'post',
  				data:
  				{
            grand_total: grand_total_for_cod ,
  					shipping_state: shipping_state_cod ,
            _token: "{{ csrf_token() }}",
  				},
  				success: function (data)
  				{
  					console.log(data);
  					if (data[0] == 'success')
  					{
              $('#cod_tr').show();
              $('#cod_amount').html('₹'+data[1]);
              $('.update_all_cod_amounts').html('₹'+data[2]);
  						$('#gateway_amount').val(data[2]);
			      }
            else
            {
              alert(data[1]);
            }
          }
  		 });
    }
    else
    {
      $('#cod_tr').hide();
      // $('#cod_amount').html('₹'+data[1]);
      $('.update_all_cod_amounts').html('₹'+grand_total_for_cod);
      $('#gateway_amount').val(grand_total_for_cod);
    }
  });
  // $('.payment_mode_cod').trigger('change');
});
</script>
@endsection
