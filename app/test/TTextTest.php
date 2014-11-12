<?php
/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 11.11.14
 * Time: 21:36
 */

namespace test;

use Codesharks\TText;

define('R', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once R . DS . 'vendors' . DS . 'Codesharks' . DS . 'TText.class.php';


class TTextTest extends \PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		TText::init();
	}

	public function tearDown()
	{
		TText::unloadDefaultTranslation();
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
}
 