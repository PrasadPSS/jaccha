@extends('frontend.layouts.app')
@section('title','Similar')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Similar Products</h1>
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
                <div class="pro-details pt-4 ">
                   <p class="pro-name"> Kapachi</p>
                   <p class="pro-style mb-1">Western Top</p>
                </div>
             <p class="pro-details pro-details-price">
               <span class="price mr-2">₹ 475</span>
               <!-- <span class="mrp">MRP</span> -->
               <span class="mrp-cut mr-2">₹ 950</span>
               <span class="discount">(50% OFF)</span>
            </p>
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
