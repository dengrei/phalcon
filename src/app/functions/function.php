<?php

/**
 *
|+----------------------------------------
| 查找文件，并引入
| @param string $name  文件名，必须存在与 允许引入文件列表中
| @param bool $back    是否返回数据,false否,true是
| @param string $ext   文件后缀，为空默认为.php
| @param array $extract 注入数据，列子:array('router'=>123),将会被拆分成$router = 123;
| @throws AppException
| @return unknown
|+----------------------------------------
 */
function findFile($name,$back=false,$ext='',$extract=null)
{
	$ext = $ext == '' ? '.php':$ext;

	$access_auto_loadfiles = require WEB_PATH.'/vendor/composer/access_autoload_fileds.php';

	if(in_array($name, array_keys($access_auto_loadfiles))){
		$filename = $access_auto_loadfiles[$name];
		if(file_exists($filename)){
			
			//将数组拆分成变量
			if(is_array($extract) && $extract){
				extract($extract,EXTR_OVERWRITE);
			}
			
			if($back){
				return require $filename;
			}else{
				require $filename;
			}
		}
	}else{
		throw new \Illuminate\Fundation\AppException('非法查找文件');
	}
}