<?php
namespace PHPShark;
if (!defined('APP_ROOT')) die('This file cannot be run as single');
use Rain\Tpl\Exception;

/**
 * Translated Text
 * @package PHPShark
 */
class TText
{
	/**
	 * @var array String
	 */
	private static $lang_tbl;
	private static $native_lang_tbl;
	private static $lang_code;

	public static function setLanguage($new_lang)
	{
		$file = APP_ROOT . DS . 'language' . DS . self::$lang_code . '.ini';
		if (file_exists($file)) {
			self::$lang_code = $new_lang;
			self::$lang_tbl = parse_ini_file($file);
			return true;
		} else {
			return false;
		}
	}

	public static function init()
	{
		$result = parse_ini_file(APP_ROOT . DS . 'language' . DS . 'default.ini');
		if ($result == false) {
			throw new Exception('Could not read default language file');
		} else {
			self::$native_lang_tbl = $result;
		}
	}


	/**
	 * Gets the translated string from ini
	 * No translation => native language (empty? => return false;)
	 * @param $string String
	 * @return bool|String
	 */
	public static function _($string)
	{
		if (isset(self::$native_lang_tbl) && isset(self::$lang_tbl[$string])) {
			return self::$lang_tbl[$string];
		} elseif (isset(self::$native_lang_tbl[$string])) {
			return self::$native_lang_tbl[$string];
		} else {
			return false;
		}
	}

	public static function unloadTranslation()
	{
		self::$native_lang_tbl = null;
		self::$lang_code = 'default';
	}

	public static function unloadDefaultTranslation()
	{
		self::$lang_tbl = null;
	}
} 