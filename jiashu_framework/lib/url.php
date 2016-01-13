<?php
/**
 * This file is URL tool class.
 * URL相关的工具类文件.
 * 
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 1.0.0
 */

/**
 * URL tool class file.
 * URL相关的工具类文件
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @since 1.0.0
 */
class url
{
	/**
	 * Get URI.得到地址中的URI.
	 * @access public
	 * @static
	 * @return URI string
	 */
	public static function getUri()
	{
		if(isset($_SERVER['REQUEST_URI']))
		{
			$uri = $_SERVER['REQUEST_URI'];
		}
		else
		{
			if(isset($_SERVER['argv']))
			{
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
			}
			else
			{
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
			}
		}
		return $uri;
	}
	
	/**
	 * Get your web site root directory.得到web程序的根目录.
	 * @access public
	 * @static
	 * @return web root string
	 */
	public static function getWebRoot()
	{
		 return dirname($_SERVER['SCRIPT_FILENAME']).DIRECTORY_SEPARATOR;
	}
}
?>