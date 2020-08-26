<?php
namespace Neteller;

use Neteller\DateOfBirth;

class Meta implements \JsonSerializable{
	private $numberOfRecords;
	private $limit;
	private $page;

	use SetterTrait;
	use GetterTrait;
	use JsonSerializeTrait;
}