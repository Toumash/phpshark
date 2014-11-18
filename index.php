<?php
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__));
define('APP_ROOT', WEB_ROOT . DS . 'app');
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');


/*    DEBUG VARIABLES
**************************/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

/*      AUTOLOADING
 *************************/
require APP_ROOT . DS . 'Loader.class.php';
Loader::getInstance();

use PHPShark\TText;

TText::init(); //dictionary

session_start();
require_once VENDORS_DIR . DS . 'AltoRouter' . DS . 'AltoRouter.php';
$router = new AltoRouter();
$router->setBasePath('/mvc');

/*        ROUTING
 **************************/
// Adds all routes within routes directory
foreach (glob(ROUTES_DIR . DS . '*.json') as $filename) {
	$routes2 = json_decode(file_get_contents($filename));
	$router->addRoutes($routes2);
}
$match = $router->match();

PHPShark\Application::init(new \PHPShark\Request($match['target'], $match['params']));

if ($match == false) {
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	require WEB_ROOT . DS . 'error_page' . DS . '404.php';
} else {
	list($controller, $action) = explode('#', $match['target']);
	$obj = new $controller();

	if (is_callable(array($obj, $action))) {
		call_user_func_array(array($obj, $action), array($match['params']));
	} else {
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal server Error');
		require WEB_ROOT . DS . 'error_page' . DS . '500.php';
	}
}