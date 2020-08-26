<?php
namespace Neteller;

use Neteller\DateOfBirth;

class Error implements \JsonSerializable{
    private $code;
    private $message;
    private $details = Array();
    private $fieldErrors = Array();

	use SetterTrait;
	use GetterTrait;
	use JsonSerializeTrait;
}