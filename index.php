<?php
define('WR', dirname(__FILE__)); // Web Root
define('R', WR . '/app'); // Application Root
define('DS', DIRECTORY_SEPARATOR);

/*    DEBUG VARIABLES
**************************/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

/*      AUTOLOADING
 *************************/
require R . DS . 'autoload.php';
use Codesharks\TText;

TText::init(); //dictionary

session_start();
require_once R . DS . 'vendors' . DS . 'AltoRouter' . DS . 'AltoRouter.php';
$router = new AltoRouter();
$router->setBasePath('/mvc');

/*        ROUTING
 **************************/
$routes2 = json_decode(file_get_contents(R . DS . 'routes.json'));
$router->addRoutes($routes2);
$match = $router->match();

if ($match == false) {
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	require WR . DS . 'error_page' . DS . '404.php';
} else {
	list($controller, $action) = explode('#', $match['target']);
	$obj = new $controller();

	if (is_callable(array($obj, $action))) {
		call_user_func_array(array($obj, $action), array($match['params']));
	} else {
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal server Error');
		require WR . DS . 'error_page' . DS . '500.php';
	}
}