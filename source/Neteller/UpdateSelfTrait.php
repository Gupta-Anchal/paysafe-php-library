<?php
namespace Neteller;

trait UpdateSelfTrait
{
	protected function updateSelfData($data){
		$jsonData = json_decode($data, true);

		foreach($jsonData as $key => $value){
			if(is_array($value)){
				
				if($key == "links" | $key == "returnLinks"){
					$this->$key = array();
					foreach($value as $val){
						$this->$key[] = new Link($val);
					}
				}else{
					$classname =  __NAMESPACE__ . "\\" . ucfirst($key);
					$this->$key = new $classname($value);
				}
			}
			else{
				$this->__set($key, $value);
			}
		}
	}
}