@extends('frontend.layouts.app')
@section('title','Wishlist')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Your Wishlist</h1>
    </div>
  </div>
  <div class=" similar-product-images">
  <div class="row ">

    @if(isset($wishlists))
    @foreach($wishlists as $wishlist)
    <div class="column ">
      <div class="content">
        <div class="item">
          <div class=" card ">
             <div class="container1">
                <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
                <div class="pro-details">
                              <p class="pro-name mb-0"> Western Top</p>
                              <p class="pro-style mb-0 ">Roundg Neck Top Round Neck Top Round Neck Top go</p>
                              <p class="pro-price-details mb-0">
                                  <span class="price mr-2">₹ 475</span>
                                  <span class="mrp-cut mr-2">₹ 950</span>
                                  <span class="discount">(50% OFF)</span>
                              </p>
                            </div>

            </div>
            <div class="remove-wishlist">
              <button type="submit" name="button"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="img-text">
              <p><span>HAND</span>-PICKED</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif



  </div>
  </div>
  </div>

<!-- Similar product section end -->

<!-- Continue Shopping button section start -->
<div class="container-fluidcustom">
  <div class="row pt-5 pb-5">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
      <div class="wish-continuebtn">
        <a href="index.html" name="button">Continue Shopping</a>
      </div>
    </div>
  </div>
</div>
<!-- Continue Shopping button section start -->


@endsection
