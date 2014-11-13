<?php
namespace test;
define('R', dirname(dirname(__FILE__)));

class InitializationTest extends \PHPUnit_Framework_TestCase
{
	public function testReadingRoutesInJSONOrder()
	{
		$routes2 = json_decode(file_get_contents(R . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'routes.json'));
		$this->assertEquals($routes2[0][3], 'home', 'failed reading routes in specyfic order');
		$this->assertEquals($routes2[1][3], 'troll', 'failed reading routes in specyfic order');
	}
}
 