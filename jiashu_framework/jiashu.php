<?php
/**
 * jiashu framework core file.
 * jiashu框架核心文件.
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.1
 */

/**
 * This constant defines root path of framework.
 * 这个常量定义了框架的根路径.
 */
define('JIASHU_FRAMEWORK_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

/**
 * jiashu is a MVC web framework in PHP language.This is singleton class.
 * jiashu是一个用PHP语言写的MVC的网站框架.
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @since 1.0.0
 */
class jiashu
{
	/**
	 * @var string name of controller.字符串类型 控制器名.
	 * @access private
	 * @since 1.0.0
	 */
	private $controller = '';

	/**
	 * @var string name of action.字符串类型 动作名.
	 * @access private
	 * @since 1.0.0
	 */
	private $action = '';

	/**
	 * @var array config array.数组类型 网站配置变量数组.
	 * @access private
	 * @since 1.0.0
	 */
	private $config;

	/**
	 * @var string request method.字符串类型 请求的类型.
	 * @access private
	 * @since 1.0.0
	 */
	private $method;

	/**
	 * @var array template data.数组类型 存放传给模版的数据.
	 * @access private
	 * @since 2.0.0
	 */
	private $_tpldata;

	/**
	 * @var object instance of this class.类对象 本类的实例变量.
	 * @access private
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Construction function.构造函数
	 * @param string $configfile path of config.字符串类型 配置文件的路径
	 * If $configfile is empty,it use default config of framework.
	 * 如果不给这个参数,就使用框架默认的配置.
	 * @access private
	 */
	private function __construct($configfile = '')
	{
		if($configfile != '')
		{
			$config = include $configfile;
		}
		else
		{
			$config = include JIASHU_FRAMEWORK_PATH.'config'.DIRECTORY_SEPARATOR.'default.php';
		}
		if(!$config)
			die('can\'t not load config file');
		$this->config = $config;
		$GLOBALS['JSFW'] = $this;
	}

	/**
	 * Create a unique instance of class.创建类的唯一实例
	 * @param string $configfile path of config.字符串类型 配置文件的路径
	 * If $configfile is empty,it use default config of framework.
	 * 如果不给这个参数,就使用框架默认的配置.
	 * @access public
	 * @static
	 * @return instance of class
	 */
	public static function getInstance($configfile = '')
	{
		if(!(self::$instance instanceof self))
		{
        self::$instance = new self($configfile);
    }
    return self::$instance;
	}

	/**
	 * Load library class.读取类库
	 * @param string $classname class name.字符串类型 类名
	 * @access public
	 * @static
	 * @return include file
	 */
	public static function loadLib($classname)
	{
		if($classname)
		{
			return include JIASHU_FRAMEWORK_PATH.'lib'.DIRECTORY_SEPARATOR.$classname.'.php';
		}
		return null;
	}

	/**
	 * Render web page.显示页面
	 * @param string $viewname name of view , default is current action name.字符串类型 视图名,默认是当前方法名
	 * @param string $controllername name of $controller , default is cuuent controller name.字符串类型 控制器名，默认是当前控制器名
	 * @access public
	 * @return include view file
	 */
	public function render($viewname = '',$controllername = '')
	{
		$webroot = url::getWebRoot();
		$filepath = $webroot.'views'.DIRECTORY_SEPARATOR;
		if($controllername == '')
			$filepath .= $this->controller.DIRECTORY_SEPARATOR;
		else
			$filepath .= $controllername.DIRECTORY_SEPARATOR;
		if($viewname == '')
			$filepath .= $this->action.'.php';
		else
			$filepath .= $viewname.'.php';
		if(file_exists($filepath))
		{
			foreach($this->_tpldata as $_k => $_v)
			{
				if(isset($$_k))
					continue;
				else
					$$_k = $_v;
			}
			include $filepath;
		}
		else
			exit('View Not Found.');
	}

	/**
	 * set template data.存传给模版的数据.
	 * @param string $_n key of data.字符串类型 存放的键名
	 * @param mixed $_v value of data.任意类型 存放键的值
	 * @access public
	 * @return self
	 */
	public function setTplData($_n,$_v)
	{
		$this->_tpldata[$_n] = $_v;
		return $this;
	}

	/**
	 * load your custom class or function file.读取自定义的类或者函数.
	 * @param string $libfilename lib file name.字符串类型 自定义库的文件名
	 * @static
	 * @access public
	 * @return include file
	 */
	public static function loadCustomLib($libfilename)
	{
		$webroot = url::getWebRoot();
		$filepath = $webroot.'lib'.DIRECTORY_SEPARATOR.$libfilename.'.php';
		if(file_exists($filepath))
		{
			return include $filepath;
		}
		return null;
	}

	/**
	 * Start this web application.开始执行
	 * @access public
	 */
	public function run()
	{
		self::loadLib('url');
		if($this->config)
		{
			if(isset($_REQUEST['c']))
			{
				$this->controller = $_REQUEST['c'];
				if(isset($_REQUEST['a']))
					$this->action = $_REQUEST['a'];
				else
					$this->action = $this->config[defaultAction];
			}
			else
			{
				$uri = url::getUri();
				$path = parse_url($uri,PHP_URL_PATH);
				if($path == '/')
				{
					$this->controller = $this->config[defaultController];
					$this->action = $this->config[defaultAction];
				}
				else
				{
					$uriarr = explode('/',$uri);
					if(is_array($uriarr) && count($uriarr) > 1)
					{
						if($mcaarr[1])
							$this->controller = $mcaarr[1];
						else
							$this->controller = $this->config[defaultController];
						if($mcaarr[2])
							$this->action = $mcaarr[2];
						else
							$this->action = $this->config[defaultAction];
					}
				}
			}
			if($this->controller && $this->action)
			{
				$webroot = url::getWebRoot();
				$filepath = $webroot.'controller'.DIRECTORY_SEPARATOR.$this->controller.'.php';
			}
			if(file_exists($filepath))
			{
				require($filepath);
				if(class_exists($this->controller))
				{
					$controller_instance = new $this->controller;
					if(method_exists($controller_instance,$this->action))
					{
						call_user_func(array($controller_instance,$this->action));
					}
				}
				else
					exit('Controller Class Not Found.');
			}
			else
				exit('Controller Not Found.');
		}
	}

	/**
	 * Get controller name.得到当前控制器名
	 * @access public
	 * @return controller name
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * Get action name.得到当前动作名
	 * @access public
	 * @return action name
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * Get config array.得到当前配置信息数组
	 * @access public
	 * @return config array
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Get method name.得到当前请求方法名
	 * @access public
	 * @return method name
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Get version information.得到当前框架的版本
	 * @access public
	 * @return version string
	 */
	public function getVersion()
	{
		return '2.0.2';
	}
}

/**
 * Get framework instance(global function).得到框架实例(全局函数)
 * @return instance
 */
function JSFW()
{
	return $GLOBALS['JSFW'];
}
?>
