<?php
/**
 * This file is mysql operate class.(ORM)
 * 此文件是mysql数据库的操作类.(ORM)
 *
 * @author Gu Sen <gusen1982@gmail.com>
 * @link https://github.com/gusen/jiashu
 * @copyright 2014 Gu Sen
 * @license MIT License
 * @version 2.0.2
 */
class mysql
{
	private $tableName;
	private $tablePrefix;
	private $database;
	private $charset;
	private $password;
	private $username;
	private $port;
	private $host;
	private $sqldebug;
	private $conn = null;
	private $isChangeDB = false;
	private static $instance;

	private $field = '';
	private $order = '';
	private $limit = '';
	private $where = '';
	private $group = '';
	private $having = '';

	public function __construct()
	{
	}

	/**
	 * set config.设置配置项
	 * @param array $config config data.数组类型 表明
	 * @access public
	 */
	public function setConfig($config)
	{
		if($config)
		{
			$this->tableName = $config['tableName'];
			$this->tablePrefix = $config['tablePrefix'];
			$this->database = $config['database'];
			$this->charset = $config['charset'];
			$this->password = $config['password'];
			$this->username = $config['username'];
			$this->port = $config['port'];
			$this->host = $config['host'];
			$this->sqldebug = $config['sqldebug'];
		}
	}

	/**
	 * connect database.连接数据库
	 * @access private
	 */
	private function connect()
	{
		$this->conn = mysql_connect($this->host.':'.$this->port,$this->username,$this->password);
		if(!$this->conn)
		{
			$this->error('Can\'t connect MySql Server');
		}
    if(!mysql_select_db($this->database,$this->conn))
		{
      $this->error('Can\'t use database'.$this->database);
    }
    mysql_query('set names '.$this->charset,$this->conn);
	}

	/**
	 * set table name.设置表名
	 * @param string $tn tabel name.字符串类型 表明
	 * @access public
	 * @return self
	 */
	public function tableName($tn)
	{
		$this->tableName = $tn;
	}

	/**
	 * execute SQL statment.执行一条SQL语句
	 * @param string $sql SQL statment.字符串类型 SQL语句
	 * @access public
	 * @return array
	 */
	public function executeSql($sql)
	{
		if(!$this->conn)
		{
			$this->connect();
		}
		if($this->isChangeDB)
		{
			$this->connect();
			$isChangeDB = false;
		}
		$result = mysql_query($sql, $this->conn);
		if(!$result)
			$this->error('', $sql);
		$data = array();
		while(($r = $this->fetch($result)) != false)
		{
			$data[] = $r;
		}
		return $data;
	}

	/**
	 * set field.设置查询的投影部分
	 * @param string $f field.字符串类型 投影部分
	 * @access public
	 * @return self
	 */
	public function field($f)
	{
		$this->field = $f;
		return $this;
	}

	/**
	 * set order by.设置查询的排序部分
	 * @param string $o order.字符串类型 排序部分
	 * @access public
	 * @return self
	 */
	public function order($o)
	{
		$this->order = $o;
		return $this;
	}

	/**
	 * set limit.设置查询的limit部分
	 * @param string $l limit.字符串类型 limit部分
	 * @access public
	 * @return self
	 */
	public function limit($l)
	{
		$this->limit = $l;
		return $this;
	}

	/**
	 * set where.设置查询的条件部分
	 * @param string $w where.字符串类型 条件部分
	 * @access public
	 * @return self
	 */
	public function where($w)
	{
		$this->where = $w;
		return $this;
	}

	/**
	 * set group by.设置查询的分组部分
	 * @param string $g group.字符串类型 分组部分
	 * @access public
	 * @return self
	 */
	public function group($g)
	{
		$this->group = $g;
		return $this;
	}

	/**
	 * set having.设置查询的分组条件部分
	 * @param string $h having.字符串类型 分组条件部分
	 * @access public
	 * @return self
	 */
	public function having($h)
	{
		$this->having = $h;
		return $this;
	}

	/**
	 * change host.更改host地址
	 * @param string $host host.字符串类型 新的host地址
	 * @access public
	 * @return self
	 */
	public function setHost($host)
	{
		$this->host = $host;
		$isChangeDB = false;
		return $this;
	}

	/**
	 * change port.更改端口号
	 * @param string $port port.字符串类型 新的端口号
	 * @access public
	 * @return self
	 */
	public function setPort($port)
	{
		$this->port = $port;
		$isChangeDB = false;
		return $this;
	}

	/**
	 * change database name.更改数据库名
	 * @param string $db database name.字符串类型 新的数据库名
	 * @access public
	 * @return self
	 */
	public function setDatabase($db)
	{
		$this->database = $db;
		$isChangeDB = false;
		return $this;
	}

	/**
	 * change user name.更改用户名
	 * @param string $un user name.字符串类型 新的用户名
	 * @access public
	 * @return self
	 */
	public function setUsername($un)
	{
		$this->username = $un;
		$isChangeDB = false;
		return $this;
	}

	/**
	 * change password.更改密码
	 * @param string $pw password.字符串类型 新的密码
	 * @access public
	 * @return self
	 */
	public function setPassword($pw)
	{
		$this->password = $pw;
		$isChangeDB = false;
		return $this;
	}

	/**
	 * change charset.更改字符编码
	 * @param string $cs charset.字符串类型 新的字符编码
	 * @access public
	 * @return self
	 */
	public function setCharset($cs)
	{
		$this->charset = $cs;
		mysql_query('set names '.$this->charset,$this->conn);
		return $this;
	}

	/**
	 * change table prefix.更改表前缀
	 * @param string $tp table prefix.字符串类型 新的表前缀
	 * @access public
	 * @return self
	 */
	public function setTablePrefix($tp)
	{
		$this->tablePrefix = $tp;
		return $this;
	}

	/**
	 * change debug mode.更改调试选项
	 * @param string $sd debug mode.字符串类型 新的调试选项
	 * @access public
	 * @return self
	 */
	public function setSqldebug($sd)
	{
		$this->sqldebug = $sd;
		return $this;
	}

	/**
	 * SQL query.SQL 查询
	 * @access public
	 * @return query result array
	 */
	public function query()
	{
		$sql = 'select ';
		if($this->field != '')
			$sql .= $this->field.' from '.$this->tablePrefix.$this->tableName.' ';
		else
			$sql .= '* from '.$this->tablePrefix.$this->tableName.' ';
		if($this->where != '')
			$sql .= ' where '.$this->where.' ';
		if($this->group != '')
			$sql .= ' group by '.$this->group.' ';
		if($this->having != '')
			$sql .= ' having '.$this->having.' ';
		if($this->order != '')
			$sql .= ' order by '.$this->order.' ';
		if($this->limit != '')
			$sql .= ' limit '.$this->limit.' ';
		$this->field = '';
		$this->order = '';
		$this->limit = '';
		$this->where = '';
		$this->group = '';
		$this->having = '';
		return $this->executeSql($sql);
	}

	/**
	 * fetch array.把查询结果转换成数组
	 * @param Object $result query result.对象 查询结果对象
	 * @param int $type mode.整型类型 模式
	 * @access public
	 * @return query result array
	 */
	public function fetch($result,$type = MYSQL_ASSOC)
	{
		return mysql_fetch_array($result,$type);
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
		if(!$insertdata)
			return false;
		if(!is_array($insertdata))
			return false;
		$f = array_keys($insertdata);
		$v = array_values($insertdata);
		for($i=0;$i<count($f);$i++)
		{
			$f[$i] = '`'.$f[$i].'`';
		}
		for($i=0;$i<count($v);$i++)
		{
			$v[$i] = '\''.$v[$i].'\'';
		}
		$field = implode (',', $f);
		$value = implode (',', $v);
		$ops = $isreplace ? 'replace into ' : 'insert into ';
		return $this->executeSql($ops.$this->tablePrefix.$this->tableName.' ('.$field.') values ('.$value.')');
	}

	/**
	 * get last insert id.得到最后插入数据的id
	 * @access public
	 * @return last insert id
	 */
	public function last_insert_id()
	{
		return mysql_insert_id($this->conn);
	}

	/**
	 * update data.修改数据
	 * @param array $updatedata update data array.数组类型 要修改的数据数组
	 * @param string $where condition.字符串类型 条件
	 * @access public
	 * @return query result
	 */
	public function update($updatedata,$where = '')
	{
		if(!$updatedata)
			return false;
		if(!is_array($updatedata))
			return false;
		$f = array_keys($updatedata);
		$v = array_values($updatedata);
		for($i=0;$i<count($f);$i++)
		{
			$f[$i] = '`'.$f[$i].'`';
		}
		for($i=0;$i<count($v);$i++)
		{
			$v[$i] = '\''.$v[$i].'\'';
		}
		$sql = 'update '.$this->tablePrefix.$this->tableName.' set ';
		for($i=0;$i<count($f);$i++)
		{
			$sql .= $f[$i] . ' = ' . $v[$i] . ' ,';
		}
		$sql = substr($sql,0,strlen()-1);
		if($where == '')
			if($this->where)
			{
				$sql .= ' where '.$this->where;
				$this->where = '';
			}
		else
			$sql .= ' where '.$where;
		return $this->executeSql($sql);
	}

	/**
	 * delete data.删除数据
	 * @param string $where condition.字符串类型 条件
	 * @access public
	 * @return query result
	 */
	public function delete($where = '')
	{
		$sql = 'delete from '.$this->tablePrefix.$this->tableName;
		if($where == '')
			if($this->where)
			{
				$sql .= ' where '.$this->where;
				$this->where = '';
			}
			else
				return false;//$sql = 'delete from '.$this->tablePrefix.$this->tableName;//Do not allow delete data without condition.不允许没有任何条件的删除
		else
			$sql .= ' where '.$where;
		return $this->executeSql($sql);
	}

	/**
	 * close connection.断开连接
	 * @access public
	 */
	public function close()
	{
		if($this->conn)
			@mysql_close($this->conn);
	}

	/**
	 * error log.错误输出
	 * @param string $msg error text.字符串类型 错误信息
	 * @param string $sql error SQL.字符串类型 SQL语句
	 * @access public
	 */
	public function error($msg = '', $sql = '')
	{
		if($this->sqldebug)
		{
			if($msg)
				$msg = 'Database Error: '.$msg;
			else
				$msg = 'Database Error: ('.@mysql_errno($this->conn).') '.@mysql_error($this->conn);
			if($sql)
				$sql = '<br />in SQL:'.$sql;
			$errormsg = $msg.$sql;
			
		}
		else
			$errormsg = '';
		die($errormsg);
	}
}
?>
