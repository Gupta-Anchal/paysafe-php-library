<?php
namespace Neteller;

trait GetterTrait
{
	public function __get($name){
		return $this->$name;
	}
}