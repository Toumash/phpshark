<?php
namespace PHPShark;
if (!defined('APP_ROOT')) {
	die('This scriot cant be run as single file');
}

/**
 * Class Application
 * @package PHPShark
 */
class Application
{
	/**
	 * @var Request
	 */
	private static $REQUEST;
	/**
	 * @var \AltoRouter
	 */
	private static $Router;

	public static function start()
	{
		session_start();
		self::$Router = new \AltoRouter();
	}

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public static function setBasePath($basePath)
	{
		self::$Router->setBasePath($basePath);
	}

	/**
	 * @param $dir string Path to routes directory <br>
	 * Routes must be in JSON structure<br>
	 * <code>
	 * [
	 * ["GET|POST|OTHER", "MATCHING_PATH", "ExampleController#method", "ROUTE_NAME"],
	 * ["GET", "/xd/?[i:idx]?", "ExampleController#method2", "ROUTE_NAME2"],
	 * ]
	 * </code>
	 * @return void
	 */
	public static function loadRoutesFromFolder($dir)
	{
		foreach (glob($dir . DS . '*.json') as $filename) {
			$routes = json_decode(file_get_contents($filename));
			self::$Router->addRoutes($routes);
		}
	}

	public static function getRequest()
	{
		return self::$REQUEST;
	}

	/**
	 * @return array|bool
	 */
	public static function matchRequest()
	{
		$request = self::$Router->match();
		self::$REQUEST = new Request($request['target'], $request['params'], $request['name']);
		return $request;
	}

	public static function show404()
	{
		header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		require WEB_ROOT . DS . 'error_page' . DS . '404.php';
	}

	public static function show500()
	{
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal server Error');
		require WEB_ROOT . DS . 'error_page' . DS . '500.php';
	}
} 