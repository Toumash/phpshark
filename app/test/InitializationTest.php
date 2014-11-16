<?php
namespace test;
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__)); // Web Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');

class InitializationTest extends \PHPUnit_Framework_TestCase
{
	public function testReadingRoutesInJSONOrder()
	{
		$routes2 = json_decode(file_get_contents(APP_ROOT . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'routes_test.json'));
		$this->assertEquals($routes2[0][3], 'home', 'failed reading routes in specyfic order');
		$this->assertEquals($routes2[1][3], 'troll', 'failed reading routes in specyfic order');
	}
}
 