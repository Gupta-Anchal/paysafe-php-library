<?php

namespace Neteller;

class Payment implements \JsonSerializable{
    private $route = "/paymenthub/v1/payments/";
    private $id;
    private $paymentType;
    private $paymentHandleToken;
    private $merchantRefNum;
    private $currencyCode;
    private $settleWithAuth;
    private $txnTime;
    private $status;
    private $gatewayReconciliationId;
    private $amount;
    private $liveMode;
    private $updatedTime;
    private $statusTime;
    private $gatewayResponse;
    private $availableToSettle;
    private $neteller;
    private $dupCheck = true;
    private $availableToRefund;
    private $customerIp;
    private $description;
    private $links; 

    use SetterTrait;
	use GetterTrait;
    use JsonSerializeTrait;
    
    protected function setId(string $id){
		$this->id = $id;
	}
	
	protected function setPaymentType(string $paymentType){
		$this->paymentType = $paymentType;
    }
    
    protected function setPaymentHandleToken(string $paymentHandleToken){
		$this->paymentHandleToken = $paymentHandleToken;
    }
    
    protected function setMerchantRefNum(string $merchantRefNum){
		$this->merchantRefNum = $merchantRefNum;
    }
    
    protected function setCurrencyCode(string $currencyCode){
		$this->currencyCode = $currencyCode;
    }
    
    protected function setAmount(int $amount){
		$this->amount = $amount;
    }
    
    protected function setDescription(string $description){
		$this->description = $description;
    }
  
    use UpdateSelfTrait;
    use CreateTrait;
    use LookupByIdTrait;
    
    public function lookupByMerchantRefNum($apiKey, $apiUrl){
		$request = new Request($apiKey);
		$response = $request->makeRequest("GET", $apiUrl . $this->route . "?merchantRefNum=" . $this->merchantRefNum, null);
		$response_obj = json_decode($response['body']);
		$this->updateSelfData(json_encode($response_obj->payments[0]));
	}
}

?>