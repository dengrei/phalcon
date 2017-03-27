<?php
namespace Illuminate\Fundation;

use Phalcon\Mvc\Controller as ControllerCore;
use Phalcon\Mvc\Dispatcher;
class Controller extends ControllerCore
{
	/*
	 *当前请求的模块控制器数据
	 */
	protected $requestData = [];
	
	/**
	 *
	|+----------------------------------------
	| 发送json数据
	|+----------------------------------------
	 */
	public function sendJson()
	{
		echo 'json';
	}
	/**
	 *
	|+----------------------------------------
	| 模板赋值
	| @param unknown $name
	| @param unknown $value
	| @param string $nocache
	|+----------------------------------------
	 */
	public function assign($name,$value,$nocache=false)
	{
		$this->view->assign($name,$value,$nocache);
	}
	/**
	 *
	|+----------------------------------------
	| 输出视图
	| @param string $name 默认为当前方法名
	|+----------------------------------------
	 */
	public function display($name='')
	{
		if($name == ''){
			$view = $this->requestData['controller'].'/'.$this->requestData['action'];
		}else{
			$view = $this->requestData['controller'].'/'.$name;
		}
		$this->view->pick($view);
	}
	/**
	 *
	 |+----------------------------------------
	 | 运行前处理
	 | @param Dispatcher $dispatch
	 |+----------------------------------------
	 */
	public function beforeExecuteRoute(Dispatcher $dispatch)
	{
		$this->requestData = [
				'module'     => $dispatch->getModuleName(),
				'controller' => $dispatch->getControllerName(),
				'action'     => $dispatch->getActionName()
		];
	}
	/**
	 *
	 |+----------------------------------------
	 | 运行后处理
	 | @param Dispatcher $dispatch
	 |+----------------------------------------
	 */
	public function afterExecuteRoute(Dispatcher $dispatch)
	{
		//echo 'after';
	}
}
