<?php
namespace PHPShark {
	if (!defined('APP_ROOT')) die('This file cannot be run as single');

	/**
	 * Passes all request data from the user
	 */
	class Request
	{
		/**
		 * Target Class#method to execute
		 * @var string
		 */
		public $target;
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
		 * @var boolean
		 */
		private $internal = false;

		/**
		 * Used only in the boostrap, first lines of framework
		 * @param $target
		 * @param $params array
		 * @param $parent
		 * @param bool $internal
		 */
		public function __construct($target, array $params, $parent, $internal = false)
		{
			$this->target = $target;
			$this->params = $params;
			$this->internal = $internal;
			$this->parent = $parent;
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