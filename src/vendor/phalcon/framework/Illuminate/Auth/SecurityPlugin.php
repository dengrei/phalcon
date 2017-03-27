<?php
namespace Illuminate\Auth;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Plugin
{
	/**
	 *
	|+----------------------------------------
	| 标识
	| @var unknown
	|+----------------------------------------
	 */
	private $gurad;
	private $rediectUri;

	public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher)
	{
		$auth   = $this->session->get('auth');

		$module     = $dispatcher->getModuleName();
		$controller = $dispatcher->getControllerName();
		$action     = $dispatcher->getActionName();
		
		if($action == 'login'){
				return true;
		}
		
		if(!$auth){
				
		}
	}
}