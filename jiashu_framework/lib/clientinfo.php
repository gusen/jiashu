<?php
/**
 * This file is get client info tool class.
 * 可以得到客户端各种信息的工具类文件.
 * 
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.2
 */

/**
 * get client info tool class.
 * 可以得到客户端各种信息的工具类
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @since 2.0.2
 */
class clientinfo
{
	/**
	 * Get client IP.得到IP地址.
	 * @access public
	 * @static
	 * @return IP string
	 */
	public static function getIP()
	{
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
		{
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
		{
			$ip = getenv('REMOTE_ADDR');
		}
		elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return preg_match( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
	}
	
	/**
	 * Get client UserAgent.得到客户端的UA信息.
	 * @access public
	 * @static
	 * @return UA string
	 */
	public static function getUserAgent()
	{
		 return $_SERVER['HTTP_USER_AGENT'];
	}
	
	/**
	 * Get client web browser.得到客户端是什么浏览器.
	 * @access public
	 * @static
	 * @return browser string
	 */
	public static function getBrowser()
	{
		if(empty($_SERVER['HTTP_USER_AGENT']))
			return '';
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/MSIE/i',$agent))
			return 'Internet Explorer';
		if(preg_match('/Trident/i',$agent))
			return 'Internet Explorer';
		if(preg_match('/Edge/i',$agent))
			return 'Edge';
		if(preg_match('/Firefox/i',$agent))
			return 'FireFox';
		if(preg_match('/Chrome/i',$agent))
			return 'Chrome';
		if (preg_match('/Safari/i',$agent))
			return 'Safari';
		if(preg_match('/Opera/i',$agent))
			return 'Opera';
		return 'unknown';
	}
	
	/**
	 * Get client language.得到客户端是什么语言.
	 * @access public
	 * @static
	 * @return language string
	 */
	public static function getLang()
	{
		if(empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
			return '';
		$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$lang = substr($lang,0,5);
		return $lang;
	}
	
	/**
	 * Get client OS.得到客户端是什么操作系统.
	 * @access public
	 * @static
	 * @return OS string
	 */
	public static function getOS()
	{
		if(empty($_SERVER['HTTP_USER_AGENT']))
			return '';
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/win/i',$agent))
			return 'Windows';
		if(preg_match('/mac/i',$agent))
			return 'Mac';
		if(preg_match('/linux/i',$agent))
			return 'Linux';
		if(preg_match('/unix/i',$agent))
			return 'Unix';
		if (preg_match('/bsd/i',$agent))
			return 'BSD';
		return 'unknown';
	}
	
	/**
	 * Get referer.得到从哪链接过来的.
	 * @access public
	 * @static
	 * @return referer string
	 */
	public static function getReferer()
	{
		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	}
	
	/**
	 * Is Mobile device?判断是否是移动设备.
	 * @access public
	 * @static
	 * @return bool
	 */
	public static function isMobile()
	{
		if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
			return true;
		if(isset($_SERVER['HTTP_VIA']))
			if(stristr($_SERVER['HTTP_VIA'],'wap'))
				return true;
		if(isset($_SERVER['HTTP_USER_AGENT']))
		{
			$clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','ipad','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','playstation','nintendo','acer');
			if(preg_match("/(".implode('|',$clientkeywords).")/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
				return true;
		}
		if((strpos($_SERVER['HTTP_ACCEPT'],'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'],'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'],'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'],'text/html'))))
			return true;
		return false;
	}
	
	/**
	 * is Android?判断是否是安卓设备.
	 * @access public
	 * @static
	 * @return bool
	 */
	public static function isAndroid()
	{
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($userAgent,'Android'))
			return true;
		if(strpos($userAgent,'iPhone') || strpos($userAgent,'iPad') || strpos($userAgent,'iPod') || strpos($userAgent,'iOS'))
			return false;
		return false;
	}
	
	/**
	 * is IOS?判断是否是苹果设备.
	 * @access public
	 * @static
	 * @return bool
	 */
	public static function isIOS()
	{
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($userAgent,'iPhone') || strpos($userAgent,'iPad') || strpos($userAgent,'iPod') || strpos($userAgent,'iOS'))
			return true;
		if(strpos($userAgent,'Android'))
			return false;
		return false;
	}
}
?>