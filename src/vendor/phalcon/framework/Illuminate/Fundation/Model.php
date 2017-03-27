<?php
namespace Illuminate\Fundation;

use Phalcon\DI;

class Model
{
	protected $db;
	/*
	 *表前缀
	 */
	protected $prefix = '';
	protected $tableName;
	
	public function __construct()
	{
		$Di = DI::getDefault();
		$setting  = $Di->get('database');
		$this->db = $Di->get('db');

		$this->prefix    = $setting['database']['prefix'];
	}
	protected function query($where,$fields='*',$order=false,$desc='DESC',$limit=50000)
	{
		$result = $this->db->fetchAll('select * from sx_ad');
		
		return $result;
	}
}