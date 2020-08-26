<?php
namespace Neteller;

class Link implements \JsonSerializable{
	private $rel;
	private $href;
	private $method;

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

	protected function setRel(string $rel){
		$this->rel = $rel;
	}

	protected function setHref(string $href){
		$this->href = $href;
	}
}