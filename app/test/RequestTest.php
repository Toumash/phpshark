<?php

namespace test;

define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__)); // Web Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');

require_once APP_ROOT . DS . 'vendors' . DS . 'PHPShark' . DS . 'Request.class.php';


use PHPShark\Request;


class RequestTest extends \PHPUnit_Framework_TestCase
{

	public function testType()
	{
		$request = new Request('class#function', array('z' => 'x'), 'x', 'parent', false);

		$this->assertEquals(true, $request->isExternal());
		$this->assertEquals(false, $request->isInternal());
	}

	public function testParams()
	{
		$request = new Request('class#function', array('x' => 'z'), 'name', 'parent', false);

		$this->assertEquals('z', $request->params['x']);
	}
}
 