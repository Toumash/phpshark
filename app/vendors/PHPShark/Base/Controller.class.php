<?php
namespace PHPShark\Base {
	use Exception;

	if (!defined('APP_ROOT')) die('This script cannot be run directly!');

	abstract class Controller
	{
		/**
		 * @var array
		 */
		public $mod;

		public function __construct()
		{

		}

		/**
		 * @param $modName
		 * @return null
		 */
		public function loadModule($modName)
		{
			//$this->$modName
			if (is_dir(MODULES_DIR . DS . $modName)) {
				$dirs = glob(MODULES_DIR . DS . $modName . DS . "*", GLOB_ONLYDIR);
				foreach ($dirs as $dir) {
					$d = basename($dir);
					$file = glob($dir . DS . "*.class.php");
					foreach ($file as $f) {
						$class = basename($f, ".class.php");
						require $f;
						$this->mod["$d"]["$class"] = new $class();
						//TODO: do this object style, not array
					}
				}
			} else return null;
		}


		/**
		 * It redirects URL.
		 *
		 * @param string $url URL to redirect
		 *
		 * @return void
		 */
		public function redirect($url)
		{
			header("location: " . $url);
		}

		/**
		 * It loads the object with the model.
		 *
		 * @param string $name name class with the class
		 * @param string $path pathway to the file with the class
		 *
		 * @return object
		 */
		public function loadModel($name, $path = null)
		{
			if ($path == null) {
				$path = APP_ROOT . '/model/';
			}
			$path = $path . $name . '.php';
			$name = $name . 'Model';
			try {
				if (is_file($path)) {
					/** @noinspection PhpIncludeInspection */
					require_once $path;
					$ob = new $name();
				} else {
					throw new Exception('Can not open model ' . $name . ' in: ' . $path);
				}
			} catch (Exception $e) {
				echo $e->getMessage() . '<br />
                File: ' . $e->getFile() . '<br />
                Code line: ' . $e->getLine() . '<br />
                Trace: ' . $e->getTraceAsString();
				exit;
			}

			return $ob;
		}

		/**
		 * It loads the object with the view.
		 *
		 * @param string $name name class with the class
		 * @param string $path pathway to the file with the class
		 *
		 * @return object
		 */
		public function loadView($name, $path = null)
		{
			if ($path == null) {
				$path = APP_ROOT . '/view/';
			}
			$path = $path . $name . '.php';
			$name = $name . 'View';
			try {
				if (is_file($path)) {
					/** @noinspection PhpIncludeInspection */
					require_once $path;
					$ob = new $name();
				} else {
					throw new Exception('Can not open view ' . $name . ' in: ' . $path);
				}
			} catch (Exception $e) {
				echo $e->getMessage() . '<br />
                File: ' . $e->getFile() . '<br />
                Code line: ' . $e->getLine() . '<br />
                Trace: ' . $e->getTraceAsString();
				exit;
			}

			return $ob;
		}
	}
}