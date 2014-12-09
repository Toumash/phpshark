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
	private static $route_files = array();

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
	 * @param $module string example:mod_facebook module routes file to be scanned <br>
	 * Routes must be in JSON structure<br>
	 * <code>
	 * [
	 * ["GET|POST|OTHER", "MATCHING_PATH", "ExampleController#method", "ROUTE_NAME"],
	 * ["GET", "/xd/?[i:idx]?", "ExampleController#method2", "ROUTE_NAME2"],
	 * ]
	 * </code>
	 * @throws \Exception
	 * @return void
	 */
	public static function addRoutesForModule($module)
	{
		$file = ROUTES_DIR . $module . DS . '*.json';
		if (file_exists($file)) {
			$json = json_decode(file_get_contents($file), true);

			$module_name = $json['module'];
			$routes = $json['routes'];
			foreach ($routes as $key) {
				self::$Router->map($key[0], $key[1], $key[2], $module_name . '#' . $key[3]);
			}
			self::$Router->addRoutes($json);
		} else {
			throw new \Exception('Demended route for module: ' . $module . 'has not been found');
		}
	}

	public static function addRoutesSource($filename)
	{
		self::$route_files[] = $filename;
	}

	/**
	 * Loads up all the route files specified by **addRoutesSource**
	 * @see \PHPShark\Application::addRoutesForModule
	 * @throws \Exception
	 */
	public static function loadRoutes()
	{
		foreach (self::$route_files as $filename) {
			$filename = ROUTES_DIR . DS . $filename;
			if (file_exists($filename)) {
				$routes = json_decode(file_get_contents($filename));
				self::$Router->addRoutes($routes);
			} else {
				throw new \Exception('No Route file' . $filename);
			}
		}
	}

	public static function getRequest()
	{
		return self::$REQUEST;
	}

	/**
	 * @return Request|bool
	 */
	public static function matchRequest()
	{
		$request = self::$Router->match();
		self::$REQUEST = new Request(Target::valueOf(['target']), $request['params'], $request['name']);
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