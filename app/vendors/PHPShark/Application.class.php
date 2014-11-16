<?php
namespace PHPShark;

if (!defined('APP_ROOT')) {
	die('This scriot cant be run as single file');
}

class Application
{
	/**
	 * @var Request
	 */
	private static $REQUEST;

	public static function getRequest()
	{
		return self::$REQUEST;
	}

	/**
	 * @param $request Request
	 * @return bool
	 */
	public static function init($request)
	{
		if (is_a($request, 'PHPShark\Request')) {
			self::$REQUEST = $request;
			return true;
		} else {
			return false;
		}
	}
} 