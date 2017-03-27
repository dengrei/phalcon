<?php
/**
 *
|+----------------------------------------
|配置视图显示
|@author Administrator
|
|tags
|+----------------------------------------
 */
namespace Illuminate\View;

use Phalcon\Mvc\View\Engine;
use Phalcon\Mvc\View\EngineInterface;

class ViewService extends Engine implements EngineInterface
{
	protected $Di;
	protected $tpPlugin;
	
	public function __construct($view,\Phalcon\DiInterface $di=null)
	{
		$this->Di = $di;
		$this->initTemplate();
		
		parent::__construct($view,$di);
	}
	public function render($path, $params, $mustClean=null)
	{
		$this->tpPlugin->setTemplateDir($this->view->getViewsDir());
		if (!isset($params['content'])) {
			$params['content'] = $this->_view->getContent();
		}
		
		foreach ($params as $key => $value) {
			if (strpos($key, 'c_') !== false && $params[$key] === true) {
				$this->tpPlugin->assign($key, $value, true);
			} else {
				$this->tpPlugin->assign($key, $value);
			}
		}
		
		$content = $this->tpPlugin->fetch($path);
		if ($mustClean) {
			$this->_view->setContent($content);
		} else {
			echo $content;
		}
	}
	/**
	 *
	|+----------------------------------------
	| 初始化模板引擎
	| @param \Phalcon\DiInterface $di
	|+----------------------------------------
	 */
	protected function initTemplate()
	{
		$config = $this->Di->get('template');
		
		$extract = [
				'config' => $config
		];
		
		$stdClass =  findFile($config['service'],true,'',$extract);
		
		$this->tpPlugin = $stdClass;
	}
	
}