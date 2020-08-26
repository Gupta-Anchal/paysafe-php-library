<?php
namespace Neteller;

use Neteller\DateOfBirth;

class GatewayResponse implements \JsonSerializable{
    private $id;
    private $amount;
	private $orderId;
    private $totalAmount;
    private $currency;
    private $lang;
    private $customerId;
    private $verificationLevel;
    private $transactionId;
    private $transactionType;
    private $description;
    private $status;
    private $processor;

	use SetterTrait;
	use GetterTrait;
    use JsonSerializeTrait;
    
    public function __construct($data = null){
		if($data !== null){
			foreach($data as $key => $value){
				$this->$key = $value;
			}
		}
	}
}