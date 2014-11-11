<?php
define('WR', dirname(__FILE__));
define('R', WR . '/app');
define('DS', DIRECTORY_SEPARATOR);


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
//&&&&&&&&&&&&&&&&&&&
//&&  AUTOLOADING  &&
//&&&&&&&&&&&&&&&&&&&

require R . DS . 'autoload.php';

use codesharks\TText;

TText::init(); //dictionary

require_once R . '/vendors/AltoRouter/AltoRouter.php';


$router = new AltoRouter();
$router->setBasePath('/mvc');

//*********************************
//        ALL ROUTING STUFF
//**********************************
$routes = require R . DS . 'routes.php';
$router->addRoutes($routes);

$match = $router->match();


// call closure or throw 404 status
if ($match && is_callable($match['target'])) {
	call_user_func_array($match['target'], $match['params']);
} else {
	// no route was matched
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

	require WR . DS . 'error_page' . DS . '500.php';
}
?>
	<h1><?php echo TText::_('APP_NAME'); ?></h1>

	<h3>Current request: </h3>
	<pre>
	Target: <?php var_dump($match['target']); ?>
		Params: <?php var_dump($match['params']); ?>
		Name:    <?php var_dump($match['name']); ?>
</pre>

	<h3>Try these requests: </h3>
	<p><a href="<?php echo $router->generate('home'); ?>">GET <?php echo $router->generate('home'); ?></a></p>
	<p>
		<a href="<?php echo $router->generate('users_show', array('id' => 5)); ?>">GET <?php echo $router->generate('users_show', array('id' => 5)); ?></a>
	</p>
	<p>
	<form action="<?php echo $router->generate('users_do', array('id' => 10, 'action' => 'update')); ?>" method="post">
		<button
			type="submit"><?php echo $router->generate('users_do', array('id' => 10, 'action' => 'update')); ?></button>
	</form></p>
<?php




?>