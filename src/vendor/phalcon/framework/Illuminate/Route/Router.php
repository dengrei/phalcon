<?php
namespace Illuminate\Route;

use Phalcon\Mvc\Router as RouterBase;

class Router extends RouterBase
{
	/**
	 *
	|+----------------------------------------
	| GET请求
	| @param unknown $pattern
	| @param unknown $paths
	|+----------------------------------------
	 */
	public function get($pattern, $paths=null)
	{
		$this->addGet($pattern,$paths);
	}
	/**
	 *
	|+----------------------------------------
	| POST请求
	| @param unknown $pattern
	| @param unknown $paths
	|+----------------------------------------
	 */
	public function post($pattern, $paths=null)
	{
		$this->addPost($pattern,$paths);
	}
	/**
	 *
	|+----------------------------------------
	| GET OR POST请求
	| @param unknown $pattern
	| @param unknown $paths
	| @param unknown $httpMethods
	|+----------------------------------------
	 */
	public function match($pattern, $paths=null, $httpMethods=null)
	{
		$this->add($pattern, $paths, $httpMethods);
	}
}