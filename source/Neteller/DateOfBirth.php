<?php
namespace Neteller;

use Neteller\DateOfBirth;

class DateOfBirth implements \JsonSerializable{
  private $day;
  private $month;
  private $year;

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

	protected function setDay(string $day){
		$this->day = $day;
  }

  protected function setMonth(string $month){
		$this->month = $month;
  }
    
  protected function setYear(string $year){
		$this->year = $year;
  }
}