<?php
namespace PHPShark\Base {
	use Exception;
	use Logger;
	use Rain;
	use Rain\Tpl;
	use Rain\Tpl\NotFoundException;

	if (!defined(APP_ROOT)) die('This file cannot be run as single');

	/**
	 * Class View
	 * @package PHPShark\Base
	 */
	abstract class View
	{
		/**
		 * @var Rain\Tpl
		 */
		public $tpl;

		/**
		 * Configures Rain templates engine to work
		 * enables cache
		 * auto_escape->false
		 * php_enabled->true
		 * You need to manually set the tpl_dir
		 * Default is /default
		 */
		public function __construct()
		{
			require_once APP_ROOT . DS . 'vendors' . DS . 'Rain' . DS . 'autoload.php';


			$config = array(
				"tpl_dir" => APP_ROOT . DS . 'template' . DS . 'default' . DS,
				"cache_dir" => APP_ROOT . DS . 'cache' . DS,
				"debug" => false, // set to false to improve the speed
			);

			Rain\Tpl::configure($config);

			//Rain\Tpl::registerPlugin(new Rain\Tpl\Plugin\PathReplace());

			$this->tpl = new Rain\Tpl();

			Rain\Tpl::configure("auto_escape", false);
			Rain\Tpl::configure("php_enabled", true);
		}

		/**
		 * @param $newTitle string
		 * @return bool if title wa successfully set
		 */
		public function changeTitle($newTitle)
		{
			if (is_string($newTitle)) {
				$this->tpl->assign('TITLE', $newTitle);
				return true;
			} else {
				return false;
			}
		}

		public function configDefaultPath()
		{
			Rain\Tpl::configure("tpl_dir", APP_ROOT . DS . 'template' . DS);
		}

		public function setTemplateFolder($folder)
		{
			Rain\Tpl::configure('tpl_dir', APP_ROOT . DS . 'template' . DS . $folder . DS);
		}

		/**
		 * It loads the object with the model.
		 *
		 * @param string $name name class with the class
		 * @param string $path pathway to the file with the class
		 *
		 * @deprecated
		 * @return object
		 */
		public function loadModel($name, $path = null)
		{
			if ($path == null) {
				$path = APP_ROOT . DS . 'model' . DS;
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
		 * Assign variable
		 * eg.     $t->assign('name','mickey');
		 *
		 * @param mixed $variable Name of templates variable or associative array name/value
		 * @param mixed $value value assigned to this variable. Not set if variable_name is an associative array
		 *
		 * @return \Rain\Tpl $this->tpl
		 */
		public function assign($variable, $value)
		{
			return $this->tpl->assign($variable, $value);
		}

		/**
		 * Draw the templates
		 *
		 * @param bool $toString : if the method should return a string
		 *                                 or echo the output
		 ** * @param string $templateFilePath : name of the templates file
		 * @param bool $toString
		 * @throws \Exception
		 * @throws NotFoundException
		 * @return void|string: depending of the $toString
		 */
		public function draw($templateFilePath, $toString = false)
		{
			try {
				return $this->tpl->draw($templateFilePath, $toString);
			} catch (NotFoundException $e) {
//			header('location: error_page/404.php');
				$log = Logger::getLogger(__CLASS__);
				$log->error('could not load Rain Template File from:' . $templateFilePath, $e);
				throw $e;
			}
		}

		/**
		 * Clean the expired template files from cache
		 * @paramparam int $expireTime Set the expiration time
		 */
		public function clean($expiretime = 2592000)
		{
			$this->tpl->clean($expiretime);
		}

		/**
		 * It includes templates file.
		 *
		 * @param string $name name templates file
		 * @param string $path pathway
		 *
		 * @return void
		 */
		public function drawPhpFileTemplate($name, $path = null)
		{
			if ($path == null) {
				$path = APP_ROOT . DS . 'templates' . DS;
			}
			$path = $path . $name . '.tpl';
			try {
				if (is_file($path)) {
					/** @noinspection PhpIncludeInspection */
					require_once $path;
				} else {
					throw new Exception('Can not open templates ' . $name . ' in: ' . $path);
				}
			} catch (Exception $e) {
				echo $e->getMessage() . '<br />
                File: ' . $e->getFile() . '<br />
                Code line: ' . $e->getLine() . '<br />
                Trace: ' . $e->getTraceAsString();
				exit;
			}
		}

		/**
		 * Used in printing in standard way
		 * @see  View->printCasualPhpTemplate
		 * @param $name
		 * @param $value
		 */
		public function set($name, $value)
		{
			$this->$name = $value;
		}

		/**
		 * Used in printing in standard way
		 * @see  View->printCasualPhpTemplate
		 * @param $name
		 * @return mixed
		 */
		public function get($name)
		{
			return $this->$name;
		}
	}
}