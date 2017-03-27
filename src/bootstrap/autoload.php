<?php
define('WEB_PATH', dirname(__DIR__));

error_reporting(E_ERROR);
//ini_set("display_errors", "off");

require WEB_PATH.'/app/functions/function.php';

require WEB_PATH.'/vendor/phalcon/Application.php';

$app = new Application();

$app->main();