<?php
/**
 *配置库
 */
return [
		'router' => WEB_PATH . '/app/Router/Router.php',   /*自定义路由配置文件*/
		'config' => WEB_PATH . '/config/',            /*配置文件目录*/
		'resources' => WEB_PATH . '/resources/views/',      /*主题以及模板库目录*/
		'runtime'   => WEB_PATH . '/runtime/',        /*运行文件目录*/
		'functions' => WEB_PATH . '/app/functions/',  /*函数库目录*/
		'listeners' => WEB_PATH . '/app/listeners/',  /*监听库目录*/
		'models'    => WEB_PATH . '/app/models/',     /*模型库目录*/
		'modules'   => WEB_PATH . '/app/modules/',    /*模块组目录*/
];
