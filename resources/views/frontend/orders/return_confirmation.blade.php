@extends('frontend.layouts.app')
@section('title', 'Order Return Confirmation')
@section('content')
<?php

// $this->title = "Payment Success";
// dd($_POST);
?>
<div class="container custom-container mt50 mb50 text-center">
  <div class="col s2">
  </div>
  <div class="col s10" id="success">

</div>
<section class="container-fluidcustom  top-padding mt-5">
  <div class="container-fluidcustom">
    <div class="row ">
      <div class="col-md-12 animate">

       
        <div class="payment-status-section">
          <h1 class="status-line">Return Request Submitted!</h1>
          <h5 class="status-line mb-4">Return Reference Number: {{$order_id}}.</h5>
          <div class="empty-img">
          <img src="{{ asset('frontend-assets/images/transaction-image.jpg') }}">
          </div>
          <h1 class="status-line mt-4">Our courier agent will come and pickup the product from the pickup address.</h1>
          <p class="payment-sucess-text1">Refund will be initiated once we receive the product and it passes the quality check.</p>
          <div class="payment-explore-btn">
            <a href="{{ url('/') }}" name="button " class="">Explore More</a>
          </div>
          <!--<div class="col-sm-12 empty-big-img">-->
          <!--<img src="{{ asset('frontend-assets/images/online-shopping.jpg') }}">-->
          <!--</div>-->

        </div>
         
      </div>
    </div>
    
  </div>
</section>


</div>

@endsection
