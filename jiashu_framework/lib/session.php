<?php
/**
 * This file is session factory class.
 * session相关的工厂类文件.
 * 
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.2
 */

/**
 * Session factory class file.
 * session相关的工厂类文件
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @since 2.0.2
 */
class session
{
	/**
	 * @var object instance of session instance class.类对象 session实现类的实例.
	 * @access private
	 * @since 2.0.2
	 */
	private $session_instance = null;
	
	/**
	 * Construction function.构造函数
	 */
	public function __construct()
	{
		$config = JSFW()->getConfig();
		$sessionconfig = false;
		if($config['session'])
		{
			$sessionconfig = $config['session']['type'];
			if($sessionconfig)
			{
				$classname = 'session_'.$sessionconfig['type'];
				jiashu::loadLib($classname);
				$this->session_instance = new $classname;
				$this->session_instance->setConfig($sessionconfig);
			}
		}
		//if you not set session config,it will use php.ini config.如果你没有设置任何的session设置，就直接用你php.ini里的配置来处理
	}
	
	/**
	 * Start session.开启session.
	 * @access public
	 * @return self
	 */
	public function sessionStart()
	{
		if($this->session_instance != null)
			$this->session_instance->startSession();
		session_start();
		return $this;
	}
	
	/**
	 * Get session.得到session.
	 * @access public
	 * @return Object
	 */
	public function getSession($name)
	{
		if($this->session_instance == null)
			return $_SESSION[$name];
		else
			return $this->session_instance->getSession($name);
	}
	
	/**
	 * Set session value.设置session值.
	 * @access public
	 */
	public function setSession($name,$value)
	{
		if($this->session_instance == null)
			$_SESSION[$name] = $value;
		else
			$this->session_instance->setSession($name,$value);
	}
	
	/**
	 * Remove session value.删除session值.
	 * @access public
	 */
	public function deleteSession($name)
	{
		if($this->session_instance == null)
			unset($_SESSION[$name]);
		else
			$this->session_instance->deleteSession($name);
	}
	
	/**
	 * Remove all session value.删除所有session.
	 * @access public
	 */
	public function destroySession()
	{
		if($this->session_instance == null)
			session_destroy();
		else
			$this->session_instance->destroySession();
	}
}
?>