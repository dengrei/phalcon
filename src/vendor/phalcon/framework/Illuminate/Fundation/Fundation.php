<?php
/**
 *
|+----------------------------------------
|核心处理
|@author Administrator
|
|tags
|+----------------------------------------
 */
namespace Illuminate\Fundation;

use Illuminate;
use Illuminate\View\ViewService;

class Fundation extends Instance
{
	protected $Di;
	protected $app;
	
	public function register($app,\Phalcon\DI\FactoryDefault $Di)
	{
		$this->Di = $Di;
		$this->app= $app;
		
		$this->registerDebug();
		$this->registerSession();
		$this->registerDb();
		$this->registerViews();
	}
	/**
	 *
	|+----------------------------------------
	| 注册视图
	|+----------------------------------------
	 */
	protected function registerViews()
	{
		$Di = $this->Di;
		$this->Di->set('view', function() use ($Di){
			$view   = new \Illuminate\View\View();
			//普通模板
			$phtml  = new \Phalcon\Mvc\View\Engine\Php($view);
			//模板引擎
			$service = new \Illuminate\View\ViewService($view,$Di);
			
			$viewEngines = [
					".htm"   => $service,
					".phtml" => $phtml,
			];
			
			$view->registerEngines($viewEngines);
			
			return $view;
		},true);
	}
	/**
	 *
	|+----------------------------------------
	| 注册数据库
	|+----------------------------------------
	 */
	protected function registerDb()
	{
		$config = $this->Di->get('database');
		
		$this->Di->set('db', function() use ($config){
			$database = new \Illuminate\Database\Database($config);
			
			return $database->getDatabase();
		});
	}
	/**
	 *
	|+----------------------------------------
	| 注册事件
	|+----------------------------------------
	 */
	protected function registerEvents()
	{
		
	}
	/**
	 *
	|+----------------------------------------
	| 注册缓存
	|+----------------------------------------
	 */
	protected function registerCache()
	{
		
	}
	/**
	 *
	|+----------------------------------------
	| 注册日志
	|+----------------------------------------
	 */
	protected function registerLog()
	{
	
	}
	protected function registerSession()
	{
		$this->Di->set('session', function(){
			$session = new \Phalcon\Session\Adapter\Files();
			$session->start();
			
			return $session;
		});
	}
	/**
	 *
	|+----------------------------------------
	| 注册debug
	|+----------------------------------------
	 */
	protected function registerDebug()
	{
		$config = $this->Di->get('app');
		
		$debug_leavel  = $config['debug_leavel'];

		if($debug_leavel == 1){
			//级别1，只显示异常
			set_exception_handler('\\Illuminate\\Fundation\\AppException::handleException');
		}elseif($debug_leavel == 2){
			//级别2，只显示错误
			set_error_handler('\\Illuminate\\Fundation\\AppException::handleError');
		}elseif($debug_leavel == 3){
			//级别3，显示所有异常和错误
			set_error_handler('\\Illuminate\\Fundation\\AppException::handleError');
			set_exception_handler('\\Illuminate\\Fundation\\AppException::handleException');
		}
		
	}
}