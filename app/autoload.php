<?php
function codeshark_autoloader($class_name)
{
	$dirs = array('model',
		'view',
		'controller');
	foreach ($dirs as $dir) {
		$file = R . DS . $dir . DS . $class_name . '.php';
		if (file_exists(strtolower($file))) {
			require $file;
			break;
		}
	}
	$filename = R . DS . 'vendors' . DS . strtolower(str_replace('\\', DS, $class_name)) . '.class.php';
	if (file_exists($filename)) {
		require $filename;
	}
}

spl_autoload_register('codeshark_autoloader');