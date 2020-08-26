<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\StandaloneCredit;

$standaloneCredit = new StandaloneCredit;
//change this to the merchantRefNum of your standalone credit
$standaloneCredit->merchantRefNum = "5f22b98e4d6d4";

try{
    $standaloneCredit->lookupByMerchantRefNum($netellerApiKey, $netellerApiUrl);
    echo"<pre>";print_r($standaloneCredit); //do something with the data here
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>