<?php
/**
 *
|+----------------------------------------
|错误处理
|@author Administrator
|
|tags
|+----------------------------------------
 */
namespace Illuminate\Fundation;

use Phalcon\Exception;

class AppException extends Exception
{
	public static function handleException($exception)
	{
		$errstr  = $exception->getMessage();
		$errfile = $exception->getFile();
		$errline = $exception->getLine();
		
		$template = <<<str
			<div style="background:#ccc;width:560px;margin:0 auto;padding:15px;font-family:sans-serif;color:#353535;">
				<div style="color:blue;"><span style="width:80px;display:inline-block;">异常信息：</span> $errstr </div>
				<div><span style="width:80px;display:inline-block;">文件位置：</span> $errfile </div>
				<div><span style="width:80px;display:inline-block;">行号：</span> $errline </div>
			</div>
str;
		echo $template;
		exit;
	}
	public static function handleError($errno, $errstr, $errfile, $errline)
	{
		$template = <<<str
			<div style="background:#ccc;width:560px;margin:0 auto;padding:15px;font-family:sans-serif;color:#353535;">
				<div style="color:red;"><span style="width:80px;display:inline-block;">错误信息：</span> $errstr </div>
				<div><span style="width:80px;display:inline-block;">文件位置：</span> $errfile </div>
				<div><span style="width:80px;display:inline-block;">行号：</span> $errline </div>
			</div>
str;
		echo $template;
		exit;
	}
}