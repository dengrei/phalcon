<?php
/**
 *
|+----------------------------------------
|请求错误处理
|@author Administrator
|
|tags
|+----------------------------------------
 */
namespace App\HttpRequest;

trait HttpRequest
{
	/**
	 *
	|+----------------------------------------
	| 请求错误状态处理
	|+----------------------------------------
	 */
	public function showRequestStatusAction($code)
	{
		 $template = new Template();
		 
		 $method   = 'show'.$code;
		 if(method_exists($template,$method)){
		 	call_user_func(array($template,$method));
		 }
	}
	
	
}