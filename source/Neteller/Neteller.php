<?php
namespace Neteller;

class Neteller implements \JsonSerializable{
  private $consumerId;
  private $consumerIdLocked = true;
  private $detail1Description;
  private $detail1Text;

  use SetterTrait;
  use GetterTrait;
  use JsonSerializeTrait;

  public function __construct($data = null){
    if($data != null){
      foreach($data as $key => $value){
        $this->$key = $value;
      }
    }
  }

  protected function setConsumerId(string $consumerId){
    $this->consumerId = $consumerId;
  }

  protected function setConsumerIdLocked(bool $consumerIdLocked){
    $this->consumerIdLocked = $consumerIdLocked;
  }
    
  protected function setDetail1Description(string $detail1Description){
    $this->detail1Description = $detail1Description;
  }
    
  protected function setDetail1Text(string $detail1Text){
    $this->detail1Text = $detail1Text;
  }
}