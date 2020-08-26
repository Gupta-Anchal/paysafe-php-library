<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\StandaloneCredit;

$db = mysqli_connect('localhost', 'root', 'anchal', 'neteller');
$merchantRefNum = $_REQUEST['merchantRefNum'];
$query = "SELECT amount FROM payment_info WHERE transaction_id ='$merchantRefNum'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$amount = $row["amount"];

$standaloneCredit = new StandaloneCredit;
//this should contain your unuique transaction ID
$standaloneCredit->merchantRefNum = uniqid();
//this should contain the paymentHandleToken from the payment handle
$standaloneCredit->paymentHandleToken = $_REQUEST['PaymentHandleToken'];
//this should contain the amount from the payment handle
$standaloneCredit->amount = ($amount * 100);
//this should contain the currency from the payment handle
$standaloneCredit->currency = "USD";


try{
    $standaloneCredit->create($netellerApiKey, $netellerApiUrl);
    
    print "Standalone Credit ID: " . $standaloneCredit->id . "<br />";
    print "Status: " . $standaloneCredit->status;
    header("Location: http://localhost/netlr/paysafe-php-library/sample/lookup-payment-handle-by-merchantRefNum.php?merchantRefNum=".$_REQUEST['merchantRefNum']);
    
    /* Do something with the data here */

}catch(NetellerException $e){
    //print $e->getMessage(); //handle the exception
}

?>