<?php
namespace Neteller;

class BillingDetails implements \JsonSerializable{
    private $id;
    private $street;
    private $street2;
    private $city;
    private $state;
    private $zip;
    private $country;

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

    protected function setStreet(string $street){
		$this->street = $street;
    }
    
    protected function setStreet2(string $street2){
        $this->street2 = $street2;
    }
    
    protected function setCity(string $city){
        $this->city = $city;
    }
    
    protected function setState(string $state){
        $this->state = $state;
    }
    
    protected function setZip(string $zip){
        $this->zip = $zip;
    }
    
    protected function setCountry(string $country){
        $this->country = $country;
    }
}