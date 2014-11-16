<?php

class Loader
{
	public $module_files;
	public static $loader;
	public $modules;

	private function __construct()
	{
		spl_autoload_register(array($this, 'base'));
		spl_autoload_register(array($this, 'module'));
	}

	public static function getInstance()
	{
		if (self::$loader == NULL)
			self::$loader = new self();

		return self::$loader;
	}

	public function module($className)
	{
		foreach ($this->$module_files as $folder) {
			$file = $folder . DS . str_replace('\\', DS, $className) . '.class.php';
			if (file_exists($file)) {
				require $file;
			}
		}
	}

	public function base($class_name)
	{
		$dirs = array('model',
			'view',
			'controller');

		foreach ($dirs as $dir) {
			$file = APP_ROOT . DS . $dir . DS . $class_name . '.class.php';
			if (file_exists($file)) {
				require $file;
				break;
			}
		}

		$filename = APP_ROOT . DS . 'vendors' . DS . str_replace('\\', DS, $class_name) . '.class.php';
		if (file_exists($filename)) {
			require $filename;
		}
	}
}