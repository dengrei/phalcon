<?php
namespace Illuminate\Database;

use Illuminate\Fundation\AppException;

class Database
{
	protected $db;
	/**
	 *
	|+----------------------------------------
	| 初始化数据库
	| @param 配置数据 $config
	| @throws AppException
	|+----------------------------------------
	 */
	public function __construct($config)
	{
		$setting = $config['database'];
		$type    = strtolower($setting['type']);

		unset($setting['type']);
		unset($setting['prefix']);
		
		$db      = null;
		switch($type){
			case 'mysql':
				$db = new \Phalcon\Db\Adapter\Pdo\Mysql($setting);
			break;
			case 'oracle':
				$db = new \Phalcon\Db\Adapter\Pdo\Oracle($setting);
			break;
			case 'postgresql':
				$db = new \Phalcon\Db\Adapter\Pdo\Postgresql($setting);
			break;
			case 'sqlite':
				$db = new \Phalcon\Db\Adapter\Pdo\Sqlite($setting);
			break;
		}
		
		if($db === null){
			throw new AppException('数据库类型不存在');
		}else{
			$this->db = $db;
		}
	}
	/**
	 *
	|+----------------------------------------
	| 获取当前数据库
	|+----------------------------------------
	 */
	public function getDatabase()
	{
		return $this->db;
	}
}
