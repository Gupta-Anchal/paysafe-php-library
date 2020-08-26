<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\Payment;

$payment = new Payment;
//this should contain your unuique transaction ID
$payment->merchantRefNum = uniqid();
//this should contain the paymentHandleToken from the payment handle
$payment->paymentHandleToken = "PHJufSGF2fXBsvs3";
//this should contain the amount from the payment handle
$payment->amount = 150;
//this should contain the currency from the payment handle
$payment->currency = "USD";

try{
    $payment->create($netellerApiKey, $netellerApiUrl);
    
    print "Payment ID : " . $payment->id. "<br />";
    print "Payment Status: " . $payment->status . "<br />";
    /* Do something with the data here */
    
}catch(NetellerException $e){
    print $e->getMessage(); //handle the exception
}

?>