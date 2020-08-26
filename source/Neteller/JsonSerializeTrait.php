<?php
namespace Neteller;

trait JsonSerializeTrait
{
	public function jsonSerialize()
    {
        $vars = array_filter(get_object_vars($this), function($val){ return $val !== null; });
        return $vars;
    }
}