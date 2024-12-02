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
<?
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

       if ($hash != $posted_hash)
       {
	       echo "Invalid Transaction. Please try again";
		   }
  	   else
       {
          echo "<h1>Thank You. Your order status is Processing.</h1>";
          echo "<h5>Your Transaction ID for this transaction is ".$txnid.".</h5>";
          echo "<p>We have received a payment of Rs. ".$amount."</p>";
		   }
?>
</div>
<p id="success-button"><a href="{{url('/')}}" class="btn waves-effect waves-light orange lighten-1 btn-update-cart">Go To Homepage</a></p>
</div>
@endsection
