<?php

class TestController extends Controller
{
	public function doTest(array $input)
	{
		print 'Dumping input for TestController#doTest';
		var_dump($input);
	}

}