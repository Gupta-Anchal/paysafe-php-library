<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;
use Neteller\Link;
use Neteller\Neteller;
use Neteller\BillingDetails;

$paymentHandle = new PaymentHandle;

$paymentHandle->paymentType = "NETELLER";
//this should contain your unuique transaction ID
$paymentHandle->merchantRefNum =  uniqid();
//change this to your transaction currency
$paymentHandle->currencyCode = "USD";
//change this to the desired deposit amount
$paymentHandle->amount = 1000;

$defaultLink = new Link;
$defaultLink->rel = "default";
$defaultLink->href = "http://www.example.com/default";

$paymentHandle->returnLinks = $defaultLink;

$paymentHandle->transactionType = "PAYMENT";

$neteller = new Neteller;
//change this to the email of the customer
$neteller->consumerId = "atuljindalje@gmail.com";

$paymentHandle->neteller = $neteller;
//and the below to the country of the customer
$billingDetails = new BillingDetails;
$billingDetails->country = "GB";
$paymentHandle->billingDetails = $billingDetails;

try{
    $paymentHandle->create($netellerApiKey, $netellerApiUrl);
    
    print "Redirect URL: " . $paymentHandle->links[0]->href. "<br />";
    print "Payment Handle ID: " . $paymentHandle->id . "<br />";
    print "PaymentHandleToken: " . $paymentHandle->paymentHandleToken;
    /* Do something with the data here */

}catch(NetellerException $e){
    print $e->getMessage(); //handle the exception
}

?>