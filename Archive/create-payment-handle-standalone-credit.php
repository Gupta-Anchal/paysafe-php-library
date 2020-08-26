<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;
use Neteller\Neteller;

$paymentHandle = new PaymentHandle;

$paymentHandle->paymentType = "NETELLER";
//this should contain your unique transaction ID
$paymentHandle->merchantRefNum =  uniqid();
//change this to your transaction currency
$paymentHandle->currencyCode = "USD";
//change this to the desired payout (withdrawal) amount
$paymentHandle->amount = 1000;

$paymentHandle->transactionType = "STANDALONE_CREDIT";

$neteller = new Neteller;
//change this to the email of the recipient
$neteller->consumerId = "netellertest_USD@neteller.com";

$paymentHandle->neteller = $neteller;

try{
    $paymentHandle->create($netellerApiKey, $netellerApiUrl);
    
    echo "<pre>";print_r ($paymentHandle);
    print "Payment Handle ID: " . $paymentHandle->id . "<br />";
    print "PaymentHandleToken: " . $paymentHandle->paymentHandleToken;
    /* Do something with the data here */

}catch(NetellerException $e){
    print $e->getMessage(); //handle the exception
}

?>