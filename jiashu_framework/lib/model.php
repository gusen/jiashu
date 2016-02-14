<?php
/**
 * This file is model base class.
 * 此文件是模型基类.
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.1
 */

/**
 * model base class.this class use factory pattern
 * 模型基类,这类使用了工厂模式
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @since 1.0.0
 */
class model
{
	/**
	 * @var object instance of database implement class.类对象 数据库实现类的实例.
	 * @access private
	 * @since 1.0.0
	 */
	private $db_instance = null;

	/**
	 * Construction function.构造函数
	 * @param string table name.字符串类型 表明
	 * @param string $dbid config id if you have multiple configs of database.字符串类型 当配置文件里有多个数据库的配置,指定使用哪个配置,如果不给这个参数则默认用第一个配置
	 */
	public function __construct($tablename = '',$dbid = '')
	{
		if($tablename != '')
			$this->tablename = $tablename;
		$config = JSFW()->getConfig();//$GLOBALS['JSFW']->getConfig();
		$dbconfig = false;
		if($config['database'])
		{
			if($dbid != '')
				if($config['database'][$dbid])
					$dbconfig = $config['database'][$dbid];
			else
				if($config['database'][0])
					$dbconfig = $config['database'][0];
			//print_r($config['database']);
			if(!$dbconfig)
				die('can\'t not load config of database');
			if($tablename != '')
				$dbconfig['tableName'] = $tablename;
			jiashu::loadLib($dbconfig['type']);
			$this->db_instance = new $dbconfig['type'];
			$this->db_instance->setConfig($dbconfig);
		}
		else
			die('can\'t not load config of database');
	}

	/**
	 * Destruct function.析构函数
	 * When destruct this class, close the database connection.
	 * 当要销毁类的对象时,关闭数据库连接.
	 * @access public
	 */
	public function __destruct()
	{
		$this->close();
	}

	/**
	 * set table name.设置表名
	 * @param string $tn tabel name.字符串类型 表明
	 * @access public
	 */
	public function tableName($tn)
	{
		$this->db_instance->tablename = $tn;
	}

	/**
	 * execute sql statement.执行一条sql语句
	 * @param string $tn tabel name.字符串类型 表名
	 * @access public
	 * @return data array
	 */
	public function executeSql($sql)
	{
		return $this->db_instance->executeSql($sql);
	}

	/**
	 * SQL query.SQL 查询
	 * @access public
	 * @return query result array
	 */
	public function query()
	{
		return $this->db_instance->query();
	}

	/**
	 * insert data.插入数据
	 * @param array $insertdata insert data array.数组类型 要插入的数据数组
	 * @param bool $isreplace is replace insert? default is false.布尔类型 是否要替换插入,默认是假
	 * @access public
	 * @return query result
	 */
	public function insert($insertdata,$isreplace = false)
	{
		return $this->db_instance->insert($insertdata,$isreplace);
	}

	/**
	 * get last insert id.得到最后插入数据的id
	 * @access public
	 * @return last insert id
	 */
	public function last_insert_id()
	{
		return $this->db_instance->last_insert_id();
	}

	/**
	 * update data.修改数据
	 * @param array $updatedata update data array.数组类型 要修改的数据数组
	 * @param string $where condition.字符串类型 条件
	 * @access public
	 * @return query result
	 */
	public function update($updatedata,$where)
	{
		return $this->db_instance->update($updatedata,$where);
	}

	/**
	 * delete data.删除数据
	 * @param string $where condition.字符串类型 条件
	 * @access public
	 * @return query result
	 */
	public function delete($where)
	{
		return $this->db_instance->delete($this->tablename,$where);
	}

	/**
	 * close connection.断开连接
	 * @access public
	 */
	public function close()
	{
		$this->db_instance->close();
	}

	/**
	 * set field.设置查询的投影部分
	 * @param string $f field.字符串类型 投影部分
	 * @access public
	 * @return self
	 */
	public function field($f = '')
	{
		return $this->db_instance->field($f);
	}

	/**
	 * set order by.设置查询的排序部分
	 * @param string $o order.字符串类型 排序部分
	 * @access public
	 * @return self
	 */
	public function order($o)
	{
		return $this->db_instance->order($o);
	}

	/**
	 * set limit.设置查询的limit部分
	 * @param string $l limit.字符串类型 limit部分
	 * @access public
	 * @return self
	 */
	public function limit($l)
	{
		return $this->db_instance->limit($l);
	}

	/**
	 * set where.设置查询的条件部分
	 * @param string $w where.字符串类型 条件部分
	 * @access public
	 * @return self
	 */
	public function where($w)
	{
		return $this->db_instance->where($w);
	}

	/**
	 * set group by.设置查询的分组部分
	 * @param string $g group.字符串类型 分组部分
	 * @access public
	 * @return self
	 */
	public function group($g)
	{
		return $this->db_instance->group($g);
	}

	/**
	 * set having.设置查询的分组条件部分
	 * @param string $h having.字符串类型 分组条件部分
	 * @access public
	 * @return self
	 */
	public function having($h)
	{
		return $this->db_instance->having($h);
	}

	/**
	 * change host.更改host地址
	 * @param string $host host.字符串类型 新的host地址
	 * @access public
	 * @return self
	 */
	public function setHost($host)
	{
		return $this->db_instance->setHost($host);
	}

	/**
	 * change port.更改端口号
	 * @param string $port port.字符串类型 新的端口号
	 * @access public
	 * @return self
	 */
	public function setPort($port)
	{
		return $this->db_instance->setPort($port);
	}

	/**
	 * change database name.更改数据库名
	 * @param string $db database name.字符串类型 新的数据库名
	 * @access public
	 * @return self
	 */
	public function setDatabase($db)
	{
		return $this->db_instance->setDatabase($db);
	}

	/**
	 * change user name.更改用户名
	 * @param string $un user name.字符串类型 新的用户名
	 * @access public
	 * @return self
	 */
	public function setUsername($un)
	{
		return $this->db_instance->setUsername($un);
	}

	/**
	 * change password.更改密码
	 * @param string $pw password.字符串类型 新的密码
	 * @access public
	 * @return self
	 */
	public function setPassword($pw)
	{
		return $this->db_instance->setPassword($pw);
	}

	/**
	 * change charset.更改字符编码
	 * @param string $cs charset.字符串类型 新的字符编码
	 * @access public
	 * @return self
	 */
	public function setCharset($cs)
	{
		return $this->db_instance->setCharset($cs);
	}

	/**
	 * change table prefix.更改表前缀
	 * @param string $tp table prefix.字符串类型 新的表前缀
	 * @access public
	 * @return self
	 */
	public function setTablePrefix($tp)
	{
		return $this->db_instance->setTablePrefix($tp);
	}

	/**
	 * change debug mode.更改调试选项
	 * @param string $sd debug mode.字符串类型 新的调试选项
	 * @access public
	 * @return self
	 */
	public function setSqldebug($sd)
	{
		return $this->db_instance->setSqldebug($sd);
	}
}
?>
