<?php
namespace Neteller;

use Neteller\DateOfBirth;

class FieldError implements \JsonSerializable{
    private $field;
    private $error;

	use SetterTrait;
	use GetterTrait;
	use JsonSerializeTrait;
}