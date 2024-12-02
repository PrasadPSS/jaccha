@extends('frontend.layouts.app')
@section('title', 'Payment Failed')
@section('content')
<?php
// $this->title = "Payment Failed";
?>
<section class="container top-padding mt-5 failure-page" >
<div class="container-fliudcustom " >
  <div class="row">
    <div class="col-md-12 modalbox-fail success-fail animate-fail">
      <div class="icon-fail">
        <span class="glyphicon glyphicon-notok"></span>
      </div>
<div class="payment-status-section">


<?php
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
         echo"<h1 class='thank'>Sorry</h1>";
         echo "<h1>Your order status is ". $status ."....</h1>";
         echo "<h5 class='status-line'>Your transaction id for this transaction is ".$txnid.".</h5>";
         echo "<p class='flow-text payment-error-text'> You may try making the payment by clicking the link below.</p>";

		 }
?>
</div>
</div>

    </div>
    <div class="row pt-5">
      <div class="col-md-12">
        <p class="text-center" id="fail-button" style=""><a class="payment-view-order-button" href="{{url('cart/')}}" class="btn waves-effect waves-light orange lighten-1">Try Again</a></p>

      </div>
    </div>
<!--Please enter your website homepagge URL -->

</div>
</section>
@endsection
