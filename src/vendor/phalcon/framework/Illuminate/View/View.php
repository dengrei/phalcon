<?php
namespace Illuminate\View;

use Phalcon\Mvc\View as ViewCore;

class View extends ViewCore
{
	/**
	 *
	|+----------------------------------------
	| 模板赋值
	| @param unknown $key
	| @param unknown $value
	| @param string $nocache 是否缓存
	|+----------------------------------------
	 */
	public function assign($key, $value, $nocache = false)
	{
		$this->_viewParams[$key] = $value;
		$this->_viewParams["_" . $key] = $nocache;
	}
}