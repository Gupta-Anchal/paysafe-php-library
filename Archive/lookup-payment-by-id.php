<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

$payment = new Payment;
//change this to the ID of your payment
$payment->id = "4089e1a0-caee-4bb1-b38e-02cc654e18ca";


try{
    $payment->lookupById($netellerApiKey, $netellerApiUrl);
    var_dump($payment); //do something with the data here
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>