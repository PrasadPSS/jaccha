@extends('frontend.layouts.app')
@section('title','Cart')
@section('content')

<!--order progrrss section start-->
<div class="container top-padding pb-4">
  <div class="row">
		<div class="col-md-12 col-sm-12 col-12">
			<!-- <div class="order-details">
			</div> -->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- <div class="order-address  pt-3">
          <h2>My Shopping Cart</h2>
			  </div> -->
		</div>
    <div class="wishlist-empty">
      <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="right-empty-img">
              <img src="{{ asset('frontend-assets/images/Secure-image.jpg') }}">
              </div>
              <div class="empty-img cart-empty-img">
              <img src="{{ asset('frontend-assets/images/cart-is-empty-image.jpg') }}">
              </div>
              <h3 class="cart-empty-heading">Hey! There is nothing in your cart</h1>
              <div>
              <a href="{{ url('/wishlists') }}" class="cart-pink-btn">Add products from your wishlist</a>
            </div>
            <div class="c-shopping-btn">
              <a href="{{ url('/') }}" name="button " class="">Continue Shopping</a>
            </div>
            <div class="cart-last-p">
              <p>Do not miss this great opportunity, you could try some other categories</p>
              <p style="color:#1f5360 !important">Always Stay Stylish & Trendy with Dadreeios!</p>
            </div>
            <section class="footer-visa-icons">
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/card_visa.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/card_master.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/Amex.png') }}"/></a>
                  <!--<a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/card_paypal.png') }}"/></a>-->
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/paytm.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/google-pay.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/bhim.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/Rupay.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/Cashon.png') }}"/></a>
                  <a  href="#"><img height="40" class="pay-img img-fluid" src="{{ asset('frontend-assets/images/payment/netbanking.png') }}"/></a>
            </section>
            </div>
          </div>
      </div>
    </div>


	</div>
</div>
<!--order progrrss section end-->

<script>
   $(document).ready(function(){

    $("#apply_coupon").click(function() {
      // alert('test');
      var coupon_code = $("#coupon_code").val();
      var total_mrp_price = $("#total_mrp_price").val();

      if (coupon_code)
      {
        $.ajax({

          url:"{{ url('cart/applycoupon') }}",
          type: "post",
          data:{
            total_mrp_price: total_mrp_price, coupon_code: coupon_code ,
            _token: "{{ csrf_token() }}",
          },
          success: function(data)
          {
            $("#result_div").show();
            $("#result").show();
            $("#result").text(data[1]);
            //location.reload();
            if (data[0] == 'success')
            {
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown)
          {
            if (errorThrown == 'Unauthorized')
            {
              alert('Please login before applying Coupon !');
            }
          }
        });
      }
      else
      {
        alert('Please Enter Coupon Code');
      }
    });

    $("#remove_coupon").click(function() {
      // var userid = "{{Session::get('customerid')}}";
      $.ajax({

        url:"{{ url('cart/removecoupon') }}",
        data:{
          _token: "{{ csrf_token() }}",
        },
        type: "post",
        success: function(data)
        {
          $("#result_div").show();
          $("#result").show();
          $("#result").text(data[1]);
          setTimeout(function()
          {
            window.location.reload();
          }, 2000);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
          if (errorThrown == 'Unauthorized')
          {
            alert('Please login before applying Coupon !');
          }
        }
      });
    });
    $('#addaddressbtn').on('click',function()
    {
      $('#deliveryaddbox').toggle();
    });


    });

</script>
@endsection
