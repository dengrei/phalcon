<?php
namespace App\Admin;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager as EventMager;
use Phalcon\Events\Event;
use Phalcon\Exception;
use Phalcon\Mvc\Dispatcher;
class Module implements ModuleDefinitionInterface
{
	public function registerAutoloaders(\Phalcon\DiInterface $di=null)
	{
		$loader    = new \Phalcon\Loader();
		$structure = $di->get('structure');
		$loader->registerNamespaces([
				'App\Admin\Controllers' => $structure['modules'].'admin/Controllers/',
		]);

		$loader->register();
	}
	public function registerServices(\Phalcon\DiInterface $di)
	{
		$di->set('dispatcher', function(){
			$dispatcher   = new Dispatcher();
			$dispatcher->setDefaultNamespace('App\Admin\Controllers');
			//注册监听
			$eventManager = new EventMager();
			$eventManager->attach('dispatch:beforeExecuteRoute',new \Illuminate\Auth\SecurityPlugin('admin'));
			//监听错误
			$eventManager->attach('dispatch:beforeException', function(Event $event, $dispatcher,Exception $exception){
				
				switch ($exception->getCode())
				{
					case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
					case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
						$dispatcher->forward(
								[
									'namespace'  => 'App\Admin\Controllers',
									'controller' => 'httpError',
									'action'     => 'showRequestStatus',
									'params'     => ['code'=>'404']
								]
						);
						return false;
				}
			});
			$dispatcher->setEventsManager($eventManager);
			
			return $dispatcher;
		});

		$structure = $di->get('structure');
		
		$di->set('view', function() use ($structure){
			$view = new \Phalcon\Mvc\View();
			$view->setViewsDir($structure['resources'].'admin/');
				
			return $view;
		});
	}
}

