<?php
   namespace PayPal\Types\AP;
use yii\helpers\Html;
use yii\helpers\Url;
use PayPal\Api\Amount;
use PayPal\Api\Details;
 use PayPal\Api\Item;
 use PayPal\Api\ItemList;
  use PayPal\Api\Payer;
   use PayPal\Api\Payment;
   use PayPal\Api\RedirectUrls;
   use PayPal\Api\Transaction;
   use PayPal\Types\AP\PayRequest;
use PayPal\Service\AdaptivePaymentsService;
   use PayPal\Core\PPMessage;
   //Set useful variables for paypal form
$paypal_link = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_username = 'rahulrai12@gmail.com'; //Business Email

?>

<div class="PT100">
  <?php
  $posted = array();
  //var_dump($user_details);exit;
  if(!empty($user_details)) {
      //print_r($_POST);
    foreach($user_details as $key => $value) {
      $posted[$key] = $value;

    }
  }
  //v
  // var_dump($posted);exit;
  //var_dump($_POST);exit;


  if(empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
  } else {
    $txnid = $posted['txnid'];
  }

//var_dump($posted);exit;

?>


<form action="<?php echo $paypal_link; ?>" method="post" name="paypalform">

      <!-- Identify your business so that you can collect the payments. -->
      <input type="hidden" name="business" value="<?php echo $paypal_username; ?>">

      <!-- Specify a Buy Now button. -->
      <input type="hidden" name="cmd" value="_xclick">

      <!-- Specify details about the item that buyers will purchase. -->

      <input type="hidden" name="amount" value="<?php echo $posted['amount']; ?>">
      <input type="hidden" name="currency_code" value="USD">
<textarea style="display:none;" name="productinfo"><?php echo $posted['productinfo']; ?></textarea>
      <!-- Specify URLs -->
      <input type='hidden' name='cancel_return' value="<?php echo $posted['furl']?>">
  <input type='hidden' name='return' value="<?php echo $posted['surl'] ?>">
  <input type="hidden" name="firstname" id="firstname" value="<?php echo $posted['firstname']; ?>" />
<input type="hidden" name="email" id="email" value="<?php echo $posted['email']; ?>" />
<input type="hidden" name="phone" value="<?php echo $posted['mobile'];?>" />
<input type="hidden" name="address" value="<?php echo $posted['address']; ?>" />

<input type="hidden" name="notify_url" value="<?php echo $posted['ipn']?>">

<input type="hidden" name="city" value="<?php echo $posted['city']; ?>" />

<input type="hidden" name="state" value="<?php echo $posted['state']; ?>" />



<input type="hidden" name="country" value="<?php echo $posted['country_name']; ?>" />


<input type="hidden" name="zipcode" value="<?php echo $posted['pincode']; ?>" />

<input type="hidden" name="shipping_method_code" value="<?php echo $posted['shipping_method_code']; ?>" />

<input type="hidden" name="shipping_method_cost" value="<?php echo $posted['shipping_method_cost']; ?>" />

<div style="display:none;">
      <!-- Display the payment button. -->
      <input type="submit" name="submit" id="paypal_submit_btn" border="0"
      src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
      <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</div>
  </form>





  <script>
  $(document).ready(function() {
     $("#paypal_submit_btn").click();
  });
  </script>
