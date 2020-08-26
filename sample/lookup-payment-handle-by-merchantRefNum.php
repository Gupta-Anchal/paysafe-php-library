<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;

$db = mysqli_connect('localhost', 'root', 'anchal', 'neteller');

$paymentHandle = new PaymentHandle;
//change this to the merchantRefNum of your payment handle
$paymentHandle->merchantRefNum = $_REQUEST['merchantRefNum'];

try{
    $paymentHandle->lookupByMerchantRefNum($netellerApiKey, $netellerApiUrl);
    //echo"<pre>";print_r($paymentHandle); //do something with the data here
    echo "<b>Thankyou !</b>";
    $merchantRefNum = $_REQUEST['merchantRefNum'];
    //echo $merchantRefNum;
    $status = $paymentHandle->status;
    //echo $status;
    $paymentHandleToken = $paymentHandle->paymentHandleToken;
    //echo $paymentHandleToken;
    $paymentType = $paymentHandle->paymentType;
    //echo $paymentType;
    $txnTime = $paymentHandle->txnTime;
    //echo $txnTime;
    $orderId = $paymentHandle->gatewayResponse->orderId;
    //echo $orderId;
    $customerId = $paymentHandle->gatewayResponse->customerId;
    //echo $customerId;
    $GatewaytransactionId = $paymentHandle->gatewayResponse->transactionId;
    //echo $GatewaytransactionId;
    $Gatewaystatus = $paymentHandle->gatewayResponse->status;
    //echo $Gatewaystatus;
    $transactionType = $paymentHandle->transactionType;
    //echo $transactionType;
    $currencyCode = $paymentHandle->currencyCode;
    //echo $currencyCode;
    if ($transactionType == "STANDALONE_CREDIT")  {
    	//echo "hello";
    	$query = "UPDATE payment_info SET status='$status', merchantRefNum='$merchantRefNum', paymentType='$paymentType', paymentHandleToken='$paymentHandleToken', txnTime='$txnTime', transactionType='$transactionType', currencyCode='$currencyCode' WHERE user_id=1 AND transaction_id='$merchantRefNum'
 " ; }
    else{
    $query = "UPDATE payment_info SET status='$status', merchantRefNum='$merchantRefNum', paymentType='$paymentType', paymentHandleToken='$paymentHandleToken', txnTime='$txnTime', orderId='$orderId', customerId='$customerId', GatewaytransactionId='$GatewaytransactionId', Gatewaystatus='$Gatewaystatus', transactionType='$transactionType', currencyCode='$currencyCode' WHERE user_id=1 AND transaction_id='$merchantRefNum'
 " ; }
    mysqli_query($db, $query);
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>