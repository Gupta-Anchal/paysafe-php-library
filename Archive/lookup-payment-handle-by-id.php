<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;

$paymentHandle = new PaymentHandle;
//change this to the ID of your payment handle
$paymentHandle->id = "5fada203-feda-42ac-9ec7-3eb3a324ddda";

try{
    $paymentHandle->lookupById($netellerApiKey, $netellerApiUrl);
    var_dump($paymentHandle); //do something with the data here
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>