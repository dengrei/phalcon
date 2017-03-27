<?php
/**
 *
|+----------------------------------------
|加载应用
|@author Administrator
|
|tags
|+----------------------------------------
 */
use Phalcon\Mvc\Application as ApplicationBase;
use Phalcon\Loader;
use Phalcon\Mvc\Url;
use Illuminate\Fundation\AppException;
class Application extends ApplicationBase
{
	protected $servers;
	protected $Di;
	protected $app;
	
	public function __construct()
	{
		
		$this->registerDi();
		$this->registerMicro();
		
		$this->registerStructure();
		$this->registerConfig();
		$this->registerDirs();
		
		$this->siginDi('app',$this);
		//核心
		$fundation = \Illuminate\Fundation\Fundation::getInstance();
		$fundation->register($this,$this->Di);
	}
	/**
	 *
	|+----------------------------------------
	| 注册模块
	|+----------------------------------------
	 */
	public function main()
	{
		//获取配置
		$moduleConfig     = $this->Di->get('module');
		//添加路由
		$this->registerRouter();
		
		$this->setDI($this->Di);
		//注册模块
		$this->registerModules($moduleConfig['modules']);
		//设置默认模块
		$this->setDefaultModule($moduleConfig['default_module']);
		//输出内容
		$this->send();
	}
	/**
	 *
	|+----------------------------------------
	| 缓存服务
	|+----------------------------------------
	 */
	public function sigin($name,$definition=null)
	{
		if($this->servers && $this->servers[$name]){
			return $this->servers[$name];
		}
		
		$object = new $definition;
		
		$this->servers[$name] = $object;
		
		return $object;
	}
	/**
	 *
	|+----------------------------------------
	| 运行
	|+----------------------------------------
	 */
	protected function send()
	{
		$this->handle()->send();
	}
	/**
	 *
	 |+----------------------------------------
	 |
	 |+----------------------------------------
	 */
	protected  function registerMicro()
	{
		$app = $this->sigin('App','Phalcon\Mvc\Micro');
		$this->app = $app;
	}
	/**
	 *
	 |+----------------------------------------
	 |
	 |+----------------------------------------
	 */
	protected function registerDi()
	{
		$Di = $this->sigin('Di','Phalcon\DI\FactoryDefault');
		$this->Di= $Di;
	}
	/**
	 *
	|+----------------------------------------
	| 注册路由
	|+----------------------------------------
	 */
	protected function registerRouter()
	{
		//获取配置
		$moduleConfig     = $this->Di->get('module');
		
		$this->Di->set('url', function(){
			$url = new Url();
			$url->setBaseUri('/');
		});

		$this->Di->set('router', function () use ($moduleConfig) {

			$router = new \Illuminate\Route\Router();
			$router->setDefaultModule($moduleConfig['default_module']);
			
			//加载路由列表
			findFile('router',false,'',array('router'=>$router));
			
			return $router;
		});
	}
	/**
	 *
	 |+----------------------------------------
	 | 注册组织结构
	 |+----------------------------------------
	 */
	protected function registerStructure()
	{
		$data = findFile('structure',true);
		$this->siginDi('structure',function() use ($data){
			return new \Phalcon\Config($data);
		});
	}
	/**
	 *
	 |+----------------------------------------
	 | 注册配置信息
	 |+----------------------------------------
	 */
	protected function registerConfig()
	{
		$configPath = $this->siginDi('structure')->config;
	
		if(is_dir($configPath)){
			$files = array_slice(scandir($configPath), 2);
			if($files){
				foreach($files as $file){
					$filename = $configPath.$file;
					$pathinfo = pathinfo($filename);
					$basename = str_replace('.'.$pathinfo['extension'], '', $pathinfo['basename']);
					if(file_exists($filename)){
						$data = require $filename;
	
						if($data){
							$this->Di->set($basename, function() use ($data){
								return $data;
							});
						}
					}
				}
			}else{
				throw new AppException('丢失配置文件');
			}
		}else{
			throw new AppException('请创建配置文件目录');
		}
	}
	/**
	 *
	 |+----------------------------------------
	 | 注册自动加载核心类库
	 |+----------------------------------------
	 */
	protected function registerDirs()
	{
		//获取自定义类库
		$configData     = $this->Di->get('app');
		$classes        = $configData['classes'];

		$loader   = new Loader();
		$namespaces = [
				'Illuminate\\Auth'         => __DIR__.'/framework/Illuminate/Auth/',
				'Illuminate\\Caches'       => __DIR__.'/framework/Illuminate/Caches/',
				'Illuminate\\Fundation'    => __DIR__.'/framework/Illuminate/Fundation/',
				'Illuminate\\Payments'     => __DIR__.'/framework/Illuminate/Payments/',
				'Illuminate\\Support'      => __DIR__.'/framework/Illuminate/Support/',
				'Illuminate\\Validation'   => __DIR__.'/framework/Illuminate/Validation/',
				'Illuminate\\Route'        => __DIR__.'/framework/Illuminate/Route/',
				'Illuminate\\View'         => __DIR__.'/framework/Illuminate/View/',
				'Illuminate\\Database'     => __DIR__.'/framework/Illuminate/Database/',
		];
		if(!empty($classes) && is_array($classes)){
			$namespaces = array_merge($namespaces,$classes);
		};
		$loader->registerNamespaces($namespaces);
		$loader->register();
	}
	/**
	 *
	|+----------------------------------------
	| 注入到DI中
	| @param string $name
	| @param funtion $definition
	| @return mixed
	|+----------------------------------------
	 */
	public function siginDi($name,$definition=null)
	{
		$has = $this->Di->has($name);
		if(!$has){
			$this->Di->set($name, $definition);
		}
		
		return $this->Di->get($name);
	}
}