<?php

require_once('config.php');
require_once('../source/paysafe-neteller-api.php');

use Neteller\StandaloneCredit;

$standaloneCredit = new StandaloneCredit;
//change this to the ID of your Standalone Credit
$standaloneCredit->id = "1ac17f31-dac2-4819-be6f-3ac71c43b2ee";


try{
    $standaloneCredit->lookupById($netellerApiKey, $netellerApiUrl);
    var_dump($standaloneCredit); //do something with the data here
}catch(NetellerException $e){
    echo $e->getMessage(); //handle the exception
}

?>