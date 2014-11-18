<?php
namespace test;

use PHPShark\Application;
use PHPShark\Request;


define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(dirname(dirname(__FILE__)))); // Web Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');

require_once APP_ROOT . DS . 'Loader.class.php';
\Loader::getInstance();

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
	public function testInitialization()
	{
		$actual = Application::start(new Request('target', array('x' => 'z'), , true));
		$this->assertEquals(true, $actual);
	}
}
 