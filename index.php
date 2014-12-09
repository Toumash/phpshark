<?php
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__));
define('APP_ROOT', WEB_ROOT . DS . 'app');
define('LOG_DIR', APP_ROOT . DS . 'log');
define('MODULES_DIR', APP_ROOT . DS . 'module');
define('VENDORS_DIR', APP_ROOT . DS . 'vendors');
define('ROUTES_DIR', APP_ROOT . DS . 'routes');

define('DEBUG_SESSION', true);

if (DEBUG_SESSION) {
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(E_ALL | E_STRICT);
}

require APP_ROOT . DS . 'Loader.class.php';
Loader::getInstance();

use PHPShark\Application;
use PHPShark\TText;

require_once VENDORS_DIR . DS . 'AltoRouter' . DS . 'AltoRouter.php';

TText::init();

Application::start();
Application::setBasePath('/mvc');

Application::addRoutesSource('MAIN');
Application::loadRoutes();

$match = Application::matchRequest();

if ($match == false) {
	if (DEBUG_SESSION) {
		Application::show404();
	} else {
		throw new Exception('Not found matching route');
	}
} else {
	list($controller, $action) = explode('#', $match['target']);
	$obj = new $controller();

	if (is_callable(array($obj, $action))) {
		try {
			call_user_func_array(array($obj, $action), array($match['params']));
		} catch (Exception $e) {
			if (DEBUG_SESSION) throw $e;
			else {
				Application::show500();

				$log = Logger::getLogger('APP');
				$log->error('Uncaught Exception', $e);
			}
		}
	} else {
		if (DEBUG_SESSION) {
			Application::show500();
		} else {
			throw new Exception('Route definad controller or/and method NOT FOUND');
		}
	}
}