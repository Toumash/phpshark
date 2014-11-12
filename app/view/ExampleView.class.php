<?php

class ExampleView extends View
{
	public function __construct()
	{
		parent::__construct();
		$this->changeTitle('ExampleView');
	}

	/**
	 * @param $data string
	 * @param $string string
	 */
	public function renderSimplePage($data, $string)
	{
		$this->setTemplateFolder('example');
		$this->assign('data', $data);
		$this->assign('translated_text', $string);
		$this->draw('example', false);
	}
} 