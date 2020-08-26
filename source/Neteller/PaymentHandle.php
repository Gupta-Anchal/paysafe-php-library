<?php

namespace Neteller;

class PaymentHandle implements \JsonSerializable{
	private $route = "/paymenthub/v1/paymenthandles/";
	private $id;
    private $paymentType = "NETELLER";
    private $paymentHandleToken;
    private $merchantRefNum;
    private $currencyCode;
    private $txnTime;
    private $status;
    private $links;
    private $liveMode;
    private $usage;
    private $action;
    private $executionMode;
    private $amount;
    private $timeToLiveSeconds;
    private $gatewayResponse;
    private $returnLinks;
    private $transactionType;
    private $updatedTime;
    private $statusTime;
    private $neteller;
    private $accountId;
    private $billingDetails;
    private $profile;
    private $customerIp;
	
	use SetterTrait;
	use GetterTrait;
	use JsonSerializeTrait;
	
	protected function setId(string $id){
		$this->id = $id;
	}
	
	protected function setPaymentType(string $paymentType){
		$this->paymentType = $paymentType;
	}

	protected function setMerchantRefNum(string $merchantRefNum){
		$this->merchantRefNum = $merchantRefNum;
	}

	protected function setCurrencyCode(string $currencyCode){
		$this->currencyCode = $currencyCode;
	}	
	
	protected function setAmount(string $amount){
		$this->amount = $amount;
	}
	
	protected function setReturnLinks(Link $returnLinks){
		$this->returnLinks[] = $returnLinks;
	}

	protected function setTransactionType(string $transactionType){
		$this->transactionType = $transactionType;
	}

	protected function setNeteller(Neteller $neteller){
		$this->neteller = $neteller;
	}

	protected function setBillingDetails(BillingDetails $billingDetails){
		$this->billingDetails = $billingDetails;
	}

	protected function setProfile(Profile $profile){
		$this->profile = $profile;
	}

	protected function setCustomerIp(string $customerIp){
		$this->customerIp = $customerIp;
	}

	use UpdateSelfTrait;
    use CreateTrait;
    use LookupByIdTrait;
    
    public function lookupByMerchantRefNum($apiKey, $apiUrl){
		$request = new Request($apiKey);
		$response = $request->makeRequest("GET", $apiUrl . $this->route . "?merchantRefNum=" . $this->merchantRefNum, null);
		$response_obj = json_decode($response['body']);
		$this->updateSelfData(json_encode($response_obj->paymentHandles[0]));
	}
}