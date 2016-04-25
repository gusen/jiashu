<?php
/**
 * This file is session operate class(file storage).
 * 此文件是session操作类.(用文件来存储)
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.2
 */
class session_file
{
	private $prefix;
	private static $instance;

	public function __construct()
	{
	}

	/**
	 * set config.设置配置项
	 * @param array $config config data.数组类型 配置项
	 * @access public
	 */
	public function setConfig($config)
	{
		if($config)
		{
			$this->prefix = $config['prefix'];
			$exptime = intval($config['exptime']);
			if(isset($exptime))
				ini_set('session.gc_maxlifetime',$exptime);
			$path = $config['path'];
			if(isset($path))
				ini_set('session.save_path', $path);
			ini_set('session.save_handler', 'files');
		}
	}
	
	/**
	 * Start session.开启session.
	 * @access public
	 */
	public function sessionStart()
	{
		session_start();
	}

	/**
	 * Get session.得到session.
	 * @access public
	 * @return Object
	 */
	public function getSession($name)
	{
		return $_SESSION[$this->prefix.$name];
	}
	
	/**
	 * Set session value.设置session值.
	 * @access public
	 */
	public function setSession($name,$value)
	{
		$_SESSION[$this->prefix.$name] = $value;
	}
	
	/**
	 * Remove session value.删除session值.
	 * @access public
	 */
	public function deleteSession($name)
	{
		unset($_SESSION[$this->prefix.$name]);
	}
	
	/**
	 * Remove all session value.删除所有session.
	 * @access public
	 */
	public function destroySession()
	{
		session_destroy();
	}
}
?>
