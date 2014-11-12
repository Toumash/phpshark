<?php
namespace test;
define('R', dirname(dirname(__FILE__)));

class InitializationTest extends \PHPUnit_Framework_TestCase
{
	/*	public function testPushAndPop()
		{
			$stack = array();
			$this->assertEquals(0, count($stack));

			array_push($stack, 'foo');
			$this->assertEquals('foo', $stack[count($stack)-1]);
			$this->assertEquals(1, count($stack));

			$this->assertEquals('foo', array_pop($stack));
			$this->assertEquals(0, count($stack));
			$this->assertNotEquals(true,false,'critical error');
		}*/

	public function testRoutes()
	{
		$routes2 = json_decode(file_get_contents(R . DIRECTORY_SEPARATOR . 'routes.json'));
		$this->assertEquals($routes2[0][3], 'home', 'failed reading routes in specyfic order');
		$this->assertEquals($routes2[1][3], 'troll', 'failed reading routes in specyfic order');
	}
}
 