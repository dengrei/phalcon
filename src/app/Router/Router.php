<?php

$router->add('/admin', array(
		'module' => 'admin',
		'controller' => 'index',
		'action' => 'index',
));
$router->add('/admin/?([a-zA-Z0-9_-]*)/?([a-zA-Z0-9_]*)(/.*)*',array(
		'module' => 'admin',
		'controller' => 1,
		'action' => 2,
		'params' => 3
));
$router->add('/', array(
    'module' => 'www',
    'controller' => 'index',
    'action' => 'index',
));
$router->add('([a-zA-Z0-9_-]*)/?([a-zA-Z0-9_]*)(/.*)*',array(
    'module' => 'www',
    'controller' => 1,
    'action' => 2,
    'params' => 3
));
