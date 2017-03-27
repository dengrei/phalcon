<?php
/**
 *第三方模板引擎初始化文件
 */
require 'Smarty.class.php';

$smarty = new Smarty();

$smarty->left_delimiter   = $config['setting']['left_delimiter'];
$smarty->right_delimiter  = $config['setting']['right_delimiter'];
$smarty->compile_dir      = $config['setting']['compile_dir'];
$smarty->cache_dir        = $config['setting']['cache_dir'];

return $smarty;