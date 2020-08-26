<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\PaymentHandle;
use Neteller\Link;
use Neteller\Neteller;
use Neteller\BillingDetails;
use Neteller\Profile;
use Neteller\DateOfBirth;


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

$onCompletedLink = new Link;
$onCompletedLink->rel = "on_completed";
$onCompletedLink->href = "http://www.example.com/completed";

$onFailedLink = new Link;
$onFailedLink->rel = "on_failed";
$onFailedLink->href = "http://www.example.com/failed";

$paymentHandle->returnLinks = $defaultLink;
$paymentHandle->returnLinks = $onCompletedLink;
$paymentHandle->returnLinks = $onFailedLink;

$paymentHandle->transactionType = "PAYMENT";

$neteller = new Neteller;
//change this to the email of the customer
$neteller->consumerId = "atuljindalje@gmail.com";
$neteller->consumerIdLocked = false;
$neteller->detail1Description = "Description";
$neteller->detail1Text = "Text";

$paymentHandle->neteller = $neteller;
//and the below to the details of the customer
$billingDetails = new BillingDetails;
$billingDetails->street = "Street";
$billingDetails->street2 = "Street2";
$billingDetails->city = "City";
$billingDetails->zip = "1234";
$billingDetails->country = "DE";

$paymentHandle->billingDetails = $billingDetails;

$profile = new Profile;
$profile->locale = "de";
$profile->firstName = "John";
$profile->lastName = "Payer";
$profile->email = "email@example.com";
$profile->phone = "1234567890";

$dob = new DateOfBirth;
$dob->day = 1;
$dob->month = 1;
$dob->year = 1981;

$profile->dateOfBirth = $dob;

$paymentHandle->profile = $profile;

$paymentHandle->customerIp = '1.2.3.4';

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