<?php

use PHPShark\Model;

class ExampleModel extends Model
{
	public function returnSimpleString()
	{
		return $this->log->getName();
	}
} 