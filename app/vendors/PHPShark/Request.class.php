<?php
namespace PHPShark {
	if (!defined('APP_ROOT')) die('This file cannot be run as single');

	/**
	 * Passes all request data from the user
	 * @package PHPShark
	 */
	class Request
	{
		/**
		 * Target Class#method to execute
		 * @var string
		 */
		public $target;
		/**
		 * @var array
		 */
		public $headers;
		/**
		 * Contains parameters, different for each request type
		 * @var array
		 */
		public $params;
		/**
		 * @var string
		 */
		private $parent;
		/**
		 * @var string
		 */
		private $name;
		/**
		 * @var boolean
		 */
		private $internal = false;

		/**
		 * Used only in the boostrap, first lines of framework
		 * @param $target
		 * @param $params array
		 * @param $name
		 * @param string $parent
		 * @param bool $internal
		 */
		public function __construct($target, array $params, $name, $parent = 'root', $internal = false)
		{
			$this->target = $target;
			$this->params = $params;
			$this->name = $name;
			$this->internal = $internal;
			$this->parent = $parent;
			$this->name = $name;
			$this->headers = $this->getHeaders();
		}

		private function getHeaders()
		{
			$headers = array();
			if (!function_exists('getallheaders')) {
				foreach ($_SERVER as $name => $value) {
					/* RFC2616 (HTTP/1.1) defines header fields as case-insensitive entities. */
					if (strtolower(substr($name, 0, 5)) == 'http_') {
						$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
					}
				}
			} else {
				$headers = getallheaders();
			}
			return $headers;
		}

		/**
		 * @return string
		 */
		public function getParent()
		{
			return $this->parent;
		}

		public function isInternal()
		{
			return $this->internal;
		}

		public function isExternal()
		{
			return !$this->internal;
		}
	}
}