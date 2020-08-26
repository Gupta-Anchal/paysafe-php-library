<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;

$payment = new Payment;
//change this to the merchantRefNum of your payment
$payment->merchantRefNum = $_REQUEST['merchantRefNum'];

try{
    $payment->lookupByMerchantRefNum($netellerApiKey, $netellerApiUrl);
    var_dump($payment); //do something with the data here
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>