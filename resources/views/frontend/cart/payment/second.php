<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="PT100">
  <?php


// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
      'ATEG6NIDK4cCfObc3SmqwjX8Oelw15Ich1sgh88p1gvJPD9j1JULQRKP-IB59ldIYPkYAvf_tkLjlIyS',     // ClientID
      'EKuyzXDzL5-GAT-ZiNDjZbV0LvW7wqUmmZNix3ybnRvn2IMpHfaSGU2CYpQsZUPcIKWZfppbJKRgPh6_'      // ClientSecret
    )
);

// Step 2.1 : Between Step 2 and Step 3
$apiContext->setConfig(
  array(
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'DEBUG'
  )
);

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://localhost/furniturebazaar/cart/payment/success")
    ->setCancelUrl("https://localhost/furniturebazaar/cart/payment/failure");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// 4. Make a Create Call and print the values
try {
    $payment->create($apiContext);
    echo $payment;

    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}
?>
</div>
