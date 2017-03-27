<?php
namespace App\Www;

use Phalcon\Mvc\ModuleDefinitionInterface;
class Module implements ModuleDefinitionInterface
{
	/**
	 * 注册控制器和模型命名空间
	|+----------------------------------------
	| @see \Phalcon\Mvc\ModuleDefinitionInterface::registerAutoloaders()
	|+----------------------------------------
	 */
	public function registerAutoloaders(\Phalcon\DiInterface $di=null)
	{
		$loader    = new \Phalcon\Loader();
		$structure = $di->get('structure');
		$loader->registerNamespaces([
				'App\Www\Controllers' => $structure['modules'].'www/Controllers/',
		]);
		
		$loader->register();
	}
	/**
	 * 注册服务
	|+----------------------------------------
	| @see \Phalcon\Mvc\ModuleDefinitionInterface::registerServices()
	|+----------------------------------------
	 */
	public function registerServices(\Phalcon\DiInterface $di)
	{
		$di->set('dispatcher', function(){
			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setDefaultNamespace('App\Www\Controllers');
			
			return $dispatcher;
		});
		
		$structure = $di->get('structure');
		$view      = $di->get('view');
		
		$view->setViewsDir($structure['resources'].'www/');
	}
}

