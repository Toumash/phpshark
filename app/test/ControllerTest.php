<?php

namespace test;
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(dirname(dirname(__FILE__))));
define('APP_ROOT', dirname(dirname(__FILE__)));
define('TESTS_ROOT', APP_ROOT . DS . 'test');
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');


use PHPShark\Base\Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
	public function testLoadingModules()
	{
		ob_start();
		$x = new TestingController();
		$x->index();
		var_dump($x);
		$actual = ob_get_clean();
		$this->assertEquals(true, strpos($actual, 'TROLOLO') !== false);
	}
}

class TestingController extends Controller
{

	public function index()
	{
		$this->loadModule('schemeModule', TESTS_ROOT . DS . 'modules');
		$this->mod['controller']['Cool']->index();
	}
}
 