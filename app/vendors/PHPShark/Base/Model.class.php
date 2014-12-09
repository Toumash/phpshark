<?php

namespace PHPShark\Base {
	use Exception;
	use Logger;
	use PDO;
	use PDOException;

	if (!defined('APP_ROOT')) die('This script cannot be run directly!');

	require_once(APP_ROOT . DS . 'vendors' . DS . 'log4php' . DS . 'Logger.php');

	\Logger::configure(APP_ROOT . DS . 'config' . DS . 'log4php_config.xml');

	/**
	 * Class Model
	 * @package PHPShark\Base
	 */
	abstract class Model
	{
		/**
		 * @var Logger
		 */
		public $log;
		/**
		 * @var PDO
		 */
		protected $pdo;

		/**
		 *  Sets connect with the database.
		 */
		public function  __construct()
		{
			$this->log = Logger::getLogger(__CLASS__);
			/*			$host        = explode('.', $_SERVER['HTTP_HOST']);
						$subdomain   = array_shift($host);*/

			$config_file = APP_ROOT . DS . 'config' . DS . 'config.ini.php';
			$config = parse_ini_file($config_file, true);
			$db_server = $config['db']['server'];
			$db_login = $config['db']['login'];
			$db_pass = $config['db']['password'];
			$db_name = $config['db']['database'];
			$db_type = $config['db']['type'];
			try {
				$this->pdo = new PDO(strtolower($db_type) . ':host=' . $db_server . ';dbname=' . $db_name, $db_login, $db_pass);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo->query("SET NAMES 'utf8'");
				//$this->pdo->query("SET CHARACTER SET 'utf8_general_ci'");
			} catch (PDOException $e) {
				$this->log->error('dbError while constructing class:', $e);
				die('Błąd połączenie bazy danych. Prosimy spróbować ponownie za kilka chwil.');
			}
		}

		public function getPDO()
		{
			return $this->pdo;
		}

		public function __destruct()
		{
			$this->disconnect();
		}

		/**
		 *  Just disconnects the php server from the MySQL server setting the pdo to null
		 */
		private function disconnect()
		{
			$this->pdo = null;
		}

		/**
		 * @param string $name name class with the class
		 * @param string $path pathway to the file with the class
		 *
		 * @return object model
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
	}
}