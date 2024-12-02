@extends('frontend.layouts.app')
@section('title','Cart')
@section('content')

<!--order progrrss section start-->
<div class="container top-padding pb-4 container-myaccounts">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-12">
      <div class="order-details">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
      <div class="delivery-details-border">
        <div class="order-address pl-4 pt-3">
          <h2>My Shopping Cart ({{ $cart->sum('qty') }} Item{{ ($cart->sum('qty')>1)?'s':'' }})</h2>
        </div>

        <hr class="w-100">
        <form method="POST" action="{{url('cart/updatecart')}}">
          {{ csrf_field() }}
          @php
          $total_price = 0;
          $total_mrp = 0;
          $total_discount = 0;
          $coupon_value = 0;
          $coupon_discount = 0;
          $product_qty_flag = false;
          @endphp


          @if(isset($cart))
          @foreach($cart as $item)
          @php
          $item_price = 0;
          $item_mrp = 0;
          $item_discount = 0;
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
          <div class="delivery-details-box cart-box mb-2">
            <div class="row">
              <div class="col-md-3 col-sm-3 col-4 ">
                <div class="delivery-period">
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
                    <span class="delivery-pro-original">₹ {{ $item->{$join_table}->product_price }}</span>
                    @php
                    $item_price = $item->{$join_table}->product_discounted_price*$item->qty;
                    $item_mrp = $item->{$join_table}->product_price*$item->qty;
                    $item_discount = $item_mrp-$item_price;
                    @endphp
                    @elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
                    <span class="delivery-pro-price">₹ {{$item->{$join_table}->product_discounted_price}}</span>
                    @php
                    $item_price = $item->{$join_table}->product_discounted_price*$item->qty;
                    $item_mrp = $item->{$join_table}->product_discounted_price*$item->qty;
                    $item_discount = $item_mrp-$item_price;
                    @endphp
                    @else
                    <span class="delivery-pro-original">₹ {{$item->{$join_table}->product_price}}</span>
                    @php
                    $item_price = $item->{$join_table}->product_price*$item->qty;
                    $item_mrp = $item->{$join_table}->product_price*$item->qty;
                    $item_discount = $item_mrp-$item_price;
                    @endphp
                    @endif
                    @if($item->{$join_table}->product_discount_type!=null && $item->{$join_table}->product_discount_type=='percent' && $item->{$join_table}->product_discount!=0)
                    <span class="delivery-pro-discount">({{ $item->{$join_table}->product_discount }}% OFF)</span>
                    @elseif($item->{$join_table}->product_discount_type!=null && $item->{$join_table}->product_discount_type=='flat' && $item->{$join_table}->product_discount!=0)
                    <span class="delivery-pro-discount">(₹ {{ $item->{$join_table}->product_discount }} OFF)</span>
                    @endif
                  </p>
                  @if(isset($item->{$join_table}->product_discount) && $item->{$join_table}->product_discount!=0)
                  <p><span class="delivery-pro-description">You are saving ₹ {{ $item->{$join_table}->product_price-$item->{$join_table}->product_discounted_price }} on this Order</span></p>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-12 ">
                <div class="delivery-period">
                  <p>Selected size: </p>
                  <div class="delivery-product-size">
                    <p>{{ isset($item->{$join_table}->size)?$item->{$join_table}->size->size_name:'FREE' }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-7 col-sm-7 col-12 ">
                <div class="delivery-period">
                  <p>Quantity: </p>
                  <div class="qtySelector text-center">
                    <i class="fa fa-minus decreaseQty"></i>
                    <input type="text" class="qtyValue" name="cart_data[{{ $item->id }}][qty]" value="{{ $item->qty }}">
                    <i class="fa fa-plus increaseQty"></i>
                  </div>
                </div>
              </div>
              @if($item->product_type == 'configurable')
              <input type="hidden" name="cart_data[{{ $item->id }}][product_variant_id]" id="product_variant_id" value="{{$item->product_variant_id}}">
              @endif
              <input type="hidden" name="cart_data[{{ $item->id }}][product_type]" id="product_type" value="{{$item->product_type}}">
              @if(isset($item->{$join_table}) && $item->{$join_table}->product_qty < $item->qty)
                @php
                $product_qty_flag = true;
                @endphp
                <div class="col-md-5 col-sm-5 col-12 ">
                </div>
                <div class="col-md-7 col-sm-7 col-12">
                  Please Change Quantity Only {{$item->{$join_table}->product_qty}} left!
                </div>
                @endif
            </div>
            <div class="row delivery-details-row shopping-btns ">
              <div class="col-md-6 col-sm-6 col-6 text-center">
                <p> <a href="{{ url('/cart/deleteitem') }}/{{ $item->id }}">REMOVE SHOPPING</a></p>
              </div>
              <div class="col-md-6 col-sm-6 col-6 text-center">
                <p> <a href="{{ url('/cart/movetowishlist')}}/{{ $item->id }}">MOVE TO WISHLIST</a></p>
              </div>
            </div>
          </div>
          @php
          $total_price = $item_price+$total_price;
          $total_mrp = $item_mrp+$total_mrp;
          $total_discount = $item_discount+$total_discount;
          @endphp
          @endforeach

          @endif
          <div class="row text-right">
            <div class="col-md-8">

            </div>
            <div class="form-group col-md-3">
              <div class="input-wrapper update-cart-spc">
                <button class="w-100 apply-coupon" type="submit" name="button">Update Cart</button>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>

    <div class="col-lg-5 col-md-12 col-sm-12 col-12 order-details-box2">
      <div class="order-details-box mb-0">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            @if(isset($coupon_data) && count($coupon_data)>0)
            <div class="coupon-section">
              @foreach($coupon_data->take(2) as $coupon)
              <table>
                <tr>
                  <td class="tag-icon pr-3"><i class="fa fa-tag" aria-hidden="true"></i></td>
                  <td>
                    <p class="p-0">{{ $coupon->coupon_title}}</p>
                  </td>
                </tr>
              </table>
              @endforeach
              @if(count($coupon_data)>2)
              <button class="more_btn apply-coupon" href="#" data-toggle="modal" data-target="#reviewRating">More</button>
              @endif
            </div>

            <div class="modal" id="reviewRating">
              <div class="modal-dialogRatings">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Coupons List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row content-ratinng">
                        <div class="col-sm-12">
                          @foreach($coupon_data as $coupon)
                          <table>
                            <tr>
                              <td class="tag-icon pr-3"><i class="fa fa-tag" aria-hidden="true"></i></td>
                              <td>
                                <p class="p-0">{{ $coupon->coupon_title}}</p>
                              </td>
                            </tr>
                          </table>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

            <div class="order-progress">
              <p>Do you have a Coupon Code?</p>
              <!-- <form class="order-progress-form" action="index.html" method="post"> -->
              <div class="row">
                <div class="form-group col-md-7">
                  <div class="input-wrapper enter-code-input">
                    <input type="hidden" name="total_mrp_price" value="{{ $total_mrp }}" id="total_mrp_price">
                    <input class="form-control form-control-h" name="coupon_code" id="coupon_code" type="text" placeholder="ENTER COUPON CODE" required>
                  </div>
                </div>
                @if(isset($cart_coupon))
                <div class="form-group col-md-5">
                  <div class="input-wrapper">
                    <button class="w-100 apply-coupon" id="remove_coupon" type="submit">REMOVE COUPON</button>
                  </div>
                </div>
                <div class="col-md-12" id="result_div">
                  @php

                  if(isset($cart_coupon->coupon))
                  {
                  $paymentDate = date('Y-m-d');
                  $paymentDate = date('Y-m-d', strtotime($paymentDate));
                  $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
                  $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

                  if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) { if($cart_coupon->coupon->coupon_type == 'flat')
                    {
                    $coupon_value = $cart_coupon->coupon->value;
                    $coupon_discount = $coupon_value;
                    }
                    else
                    {
                    $coupon_value = $cart_coupon->coupon->value;
                    $coupon_discount = ($total_mrp*$coupon_value)/100;
                    }
                    @endphp
                    <p class="coupon-tag atg1">{{ $cart_coupon->coupon_code }} Coupon Applied <button class="coupon-cancel" type="button" name="button"><i class="fa fa-times" aria-hidden="true"></i></button></p>
                    @php
                    }
                    else
                    {
                    @endphp
                    <p class="coupon-tag">{{ $cart_coupon->coupon_code }} Coupon Expired <button class="coupon-cancel" type="button" name="button"><i class="fa fa-times" aria-hidden="true"></i></button></p>
                    @php
                    }
                    }
                    @endphp

                    <p id="result" class="dis-none coupon-tag"></p>
                </div>
                @else
                <div class="form-group col-md-5">
                  <div class="input-wrapper">
                    <button class="w-100 apply-coupon" id="apply_coupon" type="submit">APPLY COUPON</button>
                  </div>
                </div>
                <div class="col-md-12" id="result_div" style="display:none;">
                  <!-- <div class="input-wrapper"> -->
                  <p id="result" class="coupon-tag"></p>
                  <!-- </div> -->
                </div>
                @endif

              </div>
              <!-- </form> -->
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12 ">
            <div class="price-details">
              <h2>ORDER DETAILS</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12 ">
            <table class="price-details-table">
              <tbody>
                <tr class="price-total">
                  <td>TOTAL M.R.P. (Inclusive of all taxes)</td>
                  <td class="text-right">₹ {{ $total_mrp }}</td>
                </tr>
                <tr>
                  <td>DISCOUNT ON M.R.P. </td>
                  <td class="text-right price-color">- ₹ {{ $total_discount }}</td>
                </tr>
                <tr>
                  <td>COUPON DISCOUNT</td>
                  <td class="text-right price-color">- ₹ {{ $coupon_discount }}</td>
                </tr>
                <tr>
                  <td>SHIPPING CHARGES</td>
                  <td class="text-right price-color">@if($shipping_amount>0)₹ {{$shipping_amount}} @else FREE @endif</td>
                </tr>
                <!-- <tr>
                  <td>COD COLLECTION CHARGE</td><td class="text-right price-color">₹0</td>
                </tr> -->

                <!-- <tr>
						      <td>ADDITIONAL DISCOUNT</td><td class="text-right price-color">- ₹0</td>
						    </tr> -->
                <tr class=" total-amount">
                  <td class="pt-4">SUB TOTAL</td>
                  <td class="pt-4 text-right">₹ {{ $total_mrp-$total_discount-$coupon_discount+$shipping_amount }}</td>
                </tr>
                <tr class=" total-amount">
                  <td>TOTAL PAYABLE AMOUNT</td>
                  <td class="text-right">₹ {{ $total_mrp-$total_discount-$coupon_discount+$shipping_amount }}</td>
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
                  <td>GRAND TOTAL AMOUNT </td>
                  <td class="text-right">₹ {{ $total_mrp-$total_discount-$coupon_discount+$shipping_amount }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-12 col-sm-12 col-12 ">
          <div class="ord-continue-btn text-center">
            @if(isset($shipping_address) && $shipping_address->count()>0)
            @if($product_qty_flag)
            <button class="ord-addnew-address" type="button" name="continue" onclick="return alert('1 or more items in your Cart are unavialable')">CONTINUE</button>
            @else
            <a class="d-block" href="{{ route('cart.checkout') }}">CONTINUE</a>
            @endif
            @else
            <button class="ord-addnew-address" id="addaddressbtn" onclick="hide()" type="submit" name="button">ADD ADDRESS</button>
            @endif
          </div>
        </div>
      </div>
      <div class="order-details-box mb-3 mt-4" id='deliveryaddbox' style="display:none;">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12 ">
            <div class="order-address">
              <h2>ADD ADDRESS</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="ord-address">
              <div class="odr-form">
                @include('frontend.includes.errors')
                <form class="odr-progress-form" action="{{ url('/addresses/storeaddress') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout_flag" value="1">
                  <div class="form-row">
                    <p>DETAILS</p>
                    <div class="form-group col-md-12">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="text" name="shipping_full_name" value="{{isset(auth()->user()->name)?auth()->user()->name:''}}" required>
                        <label class="" for="user">Full Name <span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_mobile_no" value="{{isset(auth()->user()->mobile_no)?auth()->user()->mobile_no:''}}" required minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*">
                        <label for="user">Mobile Phone Number <span class="star">*</span></label>
                        <span class="number-msg" id="messages"></span>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="text" id="mobnumber" name="shipping_alt_mobile_no" minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*">
                        <label for="user">Alternate Mobile Phone Number </label>
                        <span class="number-msg" id="messages"></span>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="email" id="email" value="{{isset(auth()->user()->email)?auth()->user()->email:''}}" name="shipping_email">
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
                        <input class="form-control form-control-h" type="text" name="shipping_pincode" required id="shipping_pincode" maxlength="6" minlength="6" inputmode="numeric">
                        <label class="" for="user">Pincode <span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="text" name="shipping_district" required id="shipping_district">
                        <label class="" for="user">District <span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="input-wrapper">
                        <input class="form-control form-control-h" type="text" name="shipping_state" required id="shipping_state">
                        <label class="" for="user">State <span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="form-group col-md-12 address-type">
                      <span class="mr-3">This is my <span class="star">*</span></span>
                      <input type="radio" id="home" name="shipping_address_type" value="home" checked>
                      <label for="home" class="common_checkbox">Home</label>
                      <input type="radio" id="office" name="shipping_address_type" value="office">
                      <label for="office" class="common_checkbox">Office</label>
                      <input type="radio" id="other" name="shipping_address_type" value="other">
                      <label for="other" class="common_checkbox">Other</label>
                    </div>
                    <div class="form-group col-md-12 address-type">
                      <span class="mr-3">Set as Default Address </span>
                      <input type="checkbox" id="default_address_flag" class="set_addr_check" name="default_address_flag" value="1">
                      <!-- <label for="default_address_flag">Set as Default Address</label> -->
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

<script>
  $(document).ready(function() {
    $("#addaddressbtn").click(function() {
      $('html,body').animate({
          scrollTop: $("#addaddressbtn").offset().top
        },
        'slow');
    });
    $("#apply_coupon").click(function() {
      // alert('test');
      var coupon_code = $("#coupon_code").val();
      var total_mrp_price = $("#total_mrp_price").val();

      if (coupon_code) {
        $.ajax({

          url: "{{ url('cart/applycoupon') }}",
          type: "post",
          data: {
            total_mrp_price: total_mrp_price,
            coupon_code: coupon_code,
            _token: "{{ csrf_token() }}",
          },
          success: function(data) {
            $("#result_div").show();
            $("#result").show();
            $("#result").text(data[1]);
            //location.reload();
            if (data[0] == 'success') {
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (errorThrown == 'Unauthorized') {
              alert('Please login before applying Coupon !');
            }
          }
        });
      } else {
        alert('Please Enter Coupon Code');
      }
    });

    $("#remove_coupon").click(function() {
      // var userid = "{{Session::get('customerid')}}";
      $.ajax({

        url: "{{ url('cart/removecoupon') }}",
        data: {
          _token: "{{ csrf_token() }}",
        },
        type: "post",
        success: function(data) {
          $("#result_div").show();
          $("#result").show();
          $("#result").text(data[1]);
          setTimeout(function() {
            window.location.reload();
          }, 2000);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          if (errorThrown == 'Unauthorized') {
            alert('Please login before applying Coupon !');
          }
        }
      });
    });
    $('#addaddressbtn').on('click', function() {
      $('#deliveryaddbox').toggle();
    });


  });
</script>
<script>
  function hide() {
    document.getElementById('deliveryaddbox').style.display = 'none';
  }
</script>
<script>
  $(document).ready(function() {
    $('#shipping_pincode').on('keyup', function() {
      var shipping_pincode = $(this).val();
      // alert(shipping_pincode.length);
      if (shipping_pincode.length == 6) {
        pindata(shipping_pincode);
      }
    });

    function pindata(shipping_pincode) {
      // alert(pincode);
      $.ajax({
        url: '{{url("/addresses/getpincodedata")}}',
        type: 'post',
        data: {
          shipping_pincode: shipping_pincode,
          _token: "{{ csrf_token() }}",
        },
        success: function(data) {
          console.log(data);
          if (data != 'N') {
            $('#shipping_district').val(data['district']);
            $('#shipping_state').val(data['state']);
          }
        }
      });
    }
  });
</script>
@endsection