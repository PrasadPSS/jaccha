@extends('frontend.layouts.app')
@section('title', 'Payment Success')
@section('content')
<?php

// $this->title = "Payment Success";
?>
<div class="container custom-container mt50 mb50 text-center">
  <div class="col s2">
  </div>
  <div class="col s10" id="success">
<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt= "OXmajpslMQ";//"RKWaQPGtyg";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

                  }
	else {

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);

       // if ($hash != $posted_hash)
       // {
	     //   echo "Invalid Transaction. Please try again";
		   // }
  	   // else
       // {
       //    echo "<h1>Thank You. Your order status is Processing.</h1>
       //    <h5>Your Transaction ID for this transaction is ".$txnid.".</h5>
       //    <p>We have received a payment of Rs. ".$amount."</p>";
		   // }
?>
</div>
<section class="container-fluidcustom payment-sucess-con  top-padding mt-5">
  <div class="container-fluidcustom">
    <div class="row ">
      <div class="col-md-12 modalbox success animate">
        <div class="icon">
  				<span class="glyphicon glyphicon-ok"></span>
  			</div>
        @if ($hash != $posted_hash)
          Invalid Transaction. Please try again.
        @else
        <div class="payment-status-section">
          <h1 class="thank">Thank You</h1>
          <h1 class="status-line">Your order status is Processing.</h1>
          <h5 class="status-line">Your Transaction ID for this transaction is {{$txnid}}.</h5>
          <p class="payment-sucess-text">We have received a payment of Rs. {{$amount}}</p>

        </div>
         @endif
      </div>
    </div>
    <div class="row pt-5">
      <div class="col-md-12">
        <div class="payment-btn-group">
          <p class="pb-4" id="success-button"><a class="payment-view-order-button mr-2" href="{{route('myaccount.orders')}}" class="btn waves-effect waves-light orange lighten-1 btn-update-cart">View Order</a></p>
          <p class="pb-4 " id="success-button"><a class="payment-success-button" href="{{url('/')}}" class="btn waves-effect waves-light orange lighten-1 btn-update-cart">Go To Homepage</a></p>
        </div>
      </div>
    </div>
  </div>
</section>


</div>

@endsection
