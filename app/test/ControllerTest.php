<?php

namespace test;
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(dirname(dirname(__FILE__)))); // Web Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');


use PHPShark\Base\Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
	public function testLoadingModules()
	{
		$this->expectOutputRegex('$$');
		$x = new TestingController();
		$x->index();
		var_dump($x);
		//TODO: create more logic test
	}
}


class TestingController extends Controller
{

	public function index()
	{
		$this->loadModule('schemeModule');
		$this->mod['controller']['Cool']->index();
	}
}
 