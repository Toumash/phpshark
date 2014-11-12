<?php

use Codesharks\TText;

class ExampleController extends Controller
{
	public function doTest(array $input)
	{
		$model = new ExampleModel();
		$data = $model->returnSimpleString();
		$view = new ExampleView();
		$str = TText::_('APP_NAME');
		$view->renderSimplePage($data, $str);
	}

}