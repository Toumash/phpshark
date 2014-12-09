<?php
namespace PHPShark {
	if (!defined('APP_ROOT')) die('This file cannot be run as single');


	class Target
	{
		private $isInternal;
		private $module;
		private $class;
		private $method;

		/**
		 * @param $module string
		 * @param $class string
		 * @param $method string
		 */
		public function __construct($module, $class, $method)
		{
			$this->module = $module;
			$this->class = $class;
			$this->method = $method;
		}

		public static function valueOf($string)
		{
			$arr = explode('#', $string);
			if (count($arr) == 3) {
				return new Target($arr[0], $arr[1], $arr[2]);
			} else {
				throw new \Exception('Target incorrect format: ' . $string);
			}


		}

		/**
		 * @return string
		 */
		public function getClass()
		{
			return $this->class;
		}

		/**
		 * @return string
		 */
		public function getModule()
		{
			return $this->module;
		}

		/**
		 * @return string
		 */
		public function getMethod()
		{
			return $this->method;
		}

		public function isInternal()
		{
			return $this->isInternal;
		}

		public function isExternal()
		{
			return !$this->isInternal;
		}
	}
}