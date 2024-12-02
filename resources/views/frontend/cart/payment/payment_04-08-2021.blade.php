@extends('frontend.layouts.app')
@section('title', 'Payment')
@section('content')
<?php
// Merchant key here as provided by Payu
  $MERCHANT_KEY = "AgchnRvO";//"gtKFFx";//fGt7UPa8//AgchnRvO

// Merchant Salt as provided by Payu
$SALT = "OXmajpslMQ";//"eCwWELxi";//OSCmGKDVTT//OXmajpslMQ

// End point - change to https://secure.payu.in for LIVE mode
// $PAYU_BASE_URL = "https://test.payu.in";
   $PAYU_BASE_URL = "https://sandboxsecure.payu.in";
// $PAYU_BASE_URL = "https://secure.payu.in";
$action = '';

$posted = array();
//var_dump($user_details);exit;
if(!empty($user_details)) {
    //print_r($_POST);
  foreach($user_details as $key => $value) {
    $posted[$key] = $value;

  }
}
//var_dump($posted);exit;
//$posted['amount'] = $cart_amount;
$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//var_dump($posted);exit;
// address|city|state|country|mobile|shipping_method_code|shipping_method_cost
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  //  var_dump($posted);exit;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));

	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;
    // dd($hash_string);
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';

}
//var_dump($_POST);exit;
?>
<div class="container top-padding custom-container center PT100">
<!-- <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <div style="text-align:center;margin-top:70px;" id="loader"></div> -->

<div class="container processing-section">
  <div class="row text-center">
    <div class="col-md-12">
      <div class="processing-div">
        <div class="text-center loader"></div>
        <h1 class="processing-text">Please wait while we are processing your request <span class="dot-one">.</span> <span class="dot-two">.</span> <span class="dot-three">.</span></h1>
      </div>
    </div>
  </div>
</div>

<div id="payudiv">
<form action="<?php echo $action; ?>" method="post" name="payuForm" class="hide" id="payumoney_form">
  <input type="hidden" name="_token" value="<?php echo $posted['_token']; ?>">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo $posted['amount']?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo $posted['email']; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo $posted['phone'];?>" /></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo $posted['furl']?>" size="64" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo $posted['productinfo']; ?></textarea></td>
        </tr>
        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
          <!-- payu_paisa -->
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address" value="<?php echo $posted['address1']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <!-- <td><input name="country" value="<?//php echo ''; ?>" /></td> -->
          <td><input name="country" value="<?php echo $posted['country']; ?>" /></td>

          <td>Zipcode: </td>
          <!-- <td><input name="zipcode" value="<?//php echo ''; ?>" /></td> -->
          <td><input name="zipcode" value="<?php echo $posted['zipcode']; ?>" /></td>

        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
          <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </div>
</div>
<script>
var hash = '<?php echo $hash ?>';
window.onload = function(){

      if(hash == '') {
        return;
      }

      var payuForm = document.forms.payuForm;
      payuForm.submit();
	  //alert('Please wait while we are processing your request...');

}

  </script>
  <script>

$(document).ready(function(){
  document.getElementById("payudiv").style.display = "none";
    var myVar;
  function myFunction() {
      myVar = setTimeout(showPage, 3000);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("payudiv").style.display = "block";
  }
});
  </script>
@endsection
