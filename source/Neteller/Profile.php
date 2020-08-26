<?php
namespace Neteller;

use Neteller\DateOfBirth;

class Profile implements \JsonSerializable{
  private $locale;
  private $firstName;
  private $lastName;
  private $email;
  private $phone;
  private $dateOfBirth;

	use SetterTrait;
	use GetterTrait;
	use JsonSerializeTrait;

  public function __construct($data = null){
    if($data !== null){
      foreach($data as $key => $value){
        if($key == "dateOfBirth"){
          $dob = new DateOfBirth($value);
          $this->dateOfBirth = $dob;
        }else{
          $this->$key = $value;
        }
      }
    }
  }

  protected function setLocale(string $locale){
    $this->locale = $locale;
  }

  protected function setFirstName(string $firstName){
		$this->firstName = $firstName;
  }
    
  protected function setLastName(string $lastName){
		$this->lastName = $lastName;
  }

  protected function setEmail(string $email){
    $this->email = $email;
  }

  protected function setPhone(string $phone){
    $this->phone = $phone;
  }

  protected function setDateOfBirth(DateOfBirth $dateOfBirth){
    $this->dateOfBirth = $dateOfBirth;
  }
}