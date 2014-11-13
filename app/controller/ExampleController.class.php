<?php

use Codesharks\Controller;
use Codesharks\TText;

class ExampleController extends Controller
{
	public function doTest(array $input)
	{
		$model = new ExampleModel();
		$className = $model->returnSimpleString();
		$view = new ExampleView();
		$appName = TText::_('APP_NAME');
		$view->renderSimplePage($className, $appName);
	}
}