<?php

class ExampleModel extends Model
{
	public function returnSimpleString()
	{
		return $this->log->getName();
	}
} 