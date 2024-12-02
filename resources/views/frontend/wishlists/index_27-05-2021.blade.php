@extends('frontend.layouts.app')
@section('title','Wishlist')
@section('content')

<!-- Your wishlist section sart -->
<div class="container-fluidcustom top-padding pb-4">
  <div class="row your-wishlist pt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Your Wishlist</h1>
    </div>
  </div>
  <div class="row pt-3 your-wishlist-imgs">
    <div class="col-lg col-md-4 col-sm-4 col-6 ">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6 ">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
  <div class="row pt-4 your-wishlist-imgs">
    <div class="col-lg col-md-4 col-sm-4 col-6 your-wishlist-imgs">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-3.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-5.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
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
    <div class="col-lg col-md-4 col-sm-4 col-6">
      <div class="item">
        <div class=" card your-wishlist-info">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
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
<!-- Your wishlist section end -->

<!-- Continue Shopping button section start -->
<div class="container-fluidcustom">
  <div class="row pt-5 pb-5">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
      <div class="wish-continuebtn">
        <a href="{{ url('/') }}" name="button">Continue Shopping</a>
      </div>
    </div>
  </div>
</div>
<!-- Continue Shopping button section start -->






@endsection
