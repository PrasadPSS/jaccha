@extends('frontend.layouts.app')
@section('title', 'Payment Failed')
@section('content')
<?php
// $this->title = "Payment Failed";
?>
<div class="container custom-container text-center">
<?
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="OXmajpslMQ";//"RKWaQPGtyg";//eCwWELxi

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

                  }
	else {

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);

       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {

         echo "<center><h1>Your order status is ". $status ."....</h1></center>";
         echo "<p class='flow-text'>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</p>";

		 }
?>
<!--Please enter your website homepagge URL -->

<p id="fail-button" style=""><a href="{{url('cart/reviewcart')}}" class="btn waves-effect waves-light orange lighten-1">Try Again</a></p>
</div>
@endsection
