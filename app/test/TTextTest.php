<?php
namespace test;

use PHPShark\TText;

define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__)); // Web Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');

require_once APP_ROOT . DS . 'vendors' . DS . 'PHPShark' . DS . 'TText.class.php';


class TTextTest extends \PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		TText::init();
	}

	public function tearDown()
	{
		TText::unloadDefaultLanguage();
		TText::unloadTranslation();
	}

	public function testReadingNativeLanguage()
	{
		$actual = TText::_('TEST');
		$this->assertEquals('TeSt', $actual);
	}

	public function testReadingOtherLanguage()
	{
		TText::setLanguage('pl');
		$actual = TText::_('TEST');
		$this->assertEquals('TeSt', $actual);
	}

	public function testReadingNoTranslation()
	{
		$actual = TText::_('random_stuff');
		$this->assertEquals(false, $actual);
	}

	public function testUnloadingLanguages()
	{
		TText::setLanguage('pl');
		$usage = memory_get_usage();
		TText::unloadTranslation();
		$usage2 = memory_get_usage();

		$this->assertGreaterThan($usage2, $usage, 'unloading .ini file not complete (RAM not freed)');
	}
}
 