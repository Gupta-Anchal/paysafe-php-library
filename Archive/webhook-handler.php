<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $webhookData = file_get_contents("php://input");
    $webhook_object = json_decode($webhookData);

    header('X-PHP-Response-Code: 200', true, 200);
}

//here you can do something with the data received. 
//for example, if the webhook event is for a PAYMENT_HANDLE_PAYABLE, we look up the payment handle and we make a payment request.

if($webhook_object->eventType == "PAYMENT_HANDLE_PAYABLE"){
    $paymentHandle = new PaymentHandle();
    $paymentHandle->id = $webhook_object->payload->id;
    
    try{
        $paymentHandle->lookupById();
    }
    catch(NetellerException $e){
        echo $e->getMessage(); //handle the exception
    }

    if($paymentHandle->status == "PAYABLE"){
        $payment = new Payment();
        //this should contain your unuique transaction ID, here we use the same ID as the payment handle just for simplicity.
        $payment->merchantRefNum = $paymentHandle->merchantRefNum;
        $payment->paymentHandleToken = $paymentHandle->paymentHandleToken;
        $payment->amount = $paymentHandle->amount;
        $payment->currency = $paymentHandle->currency;

        try{
            $payment->create($netellerApiKey, $netellerApiUrl);
            
            print "Payment ID : " . $payment->id. "<br />";
            print "Payment Status: " . $payment->status . "<br />";
            /* Do something with the data here */
            
        }catch(NetellerException $e){
            print $e->getMessage(); //handle the exception
        }
    }
}