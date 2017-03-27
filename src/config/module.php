<?php
/**
 *模块配置
 * @var array $data
 */
$data = array(
	/*
	 * 模块列表
	 */
	'modules' =>
	[
			'www'   => array(
					'className' => 'App\Www\Module',
					'path'      => __DIR__.'/../app/modules/www/Module.php'
			),
			'admin' => array(
					'className' => 'App\Admin\Module',
					'path'      => __DIR__.'/../app/modules/admin/Module.php'
			)
	],
	/*
	 * 默认模块
	 */
	'default_module' => 'www'
);

return $data;