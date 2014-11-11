<?php
namespace codesharks;

/**
 * Class TText used to translate strings by the language files located in /language dir
 * @package codesharks
 */
class TText
{
	/**
	 * @var array String
	 */
	private static $lang_tbl;

	public static function init()
	{
		self::$lang_tbl = parse_ini_file(R . '/language/pl.ini', true);
	}


	/**
	 * Gets the translated string from ini
	 * @param $string String
	 * @return bool|String
	 */
	public static function _($string)
	{
		if (isset(self::$lang_tbl[$string])) {
			return self::$lang_tbl[$string];
		} else {
			return false;
		}
	}
} 