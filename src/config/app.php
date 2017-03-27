<?php

return [
		
		'debug_leavel' => 3,//错误级别，0禁止报错,1显示异常,2显示错误,3显示所有异常和错误
		
		/*自定义类库
		 *格式: 'App\\HttpRequest' => WEB_PATH.'/app/Request/'
		 */
		'classes' => [
				'App\\Models'       => WEB_PATH.'/app/models/',
				'App\\HttpRequest' => WEB_PATH.'/app/Request/'
		]
];