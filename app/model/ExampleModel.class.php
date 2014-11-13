<?php

use Codesharks\Model;

class ExampleModel extends Model
{
	public function returnSimpleString()
	{
		return $this->log->getName();
	}
} 