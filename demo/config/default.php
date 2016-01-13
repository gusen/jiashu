<?php
return array(
	'appName' => 'JiashuPHP_test_project',//your web app name.你的程序名称
	'debug' => true,//debug flag.是否输出调试信息
	'defaultWebRoot' => '/',//default web root.默认网站根目录
	'defaultController' => 'index',//default controller class,if you do not give a clear controller name.如果没有给出明确的控制器名,默认访问的控制器类
	'defaultAction' => 'index',//default action function,if you do not give a clear action name.如果没有给出明确的动作名,默认访问的动作函数

	'database' => array(//database config,you can set multiple records,So you can connect a number of different databases in your application.  e.g. the first is a MySql database, and the second is an Oracle database.设置数据库连接信息,可以输入多个,这样你可以在你的应用中连接多个不同的数据库,如第一个是MySql数据库,第二个是Oracle数据库
		'testdb' => array(//database config name,you can set any string, but it is unique.数据库连接名称,随便起名,只要不和其他的数据库配置名重复即可
			'type' => 'mysql',//database type,only support mysql database now.数据库类型,现在只支持MySql数据库
			'host' => 'localhost',//database host address.数据库连接地址
			'port' => '3306',//database port.数据库端口号
			'username' => 'root',//login name.用户名
			'password' => '123456',//password.密码
			'charset' => 'utf8',//default charset.默认连接的字符集
			'database' => 'testjiashu',//database name.数据库名
			'tablePrefix' => 'test_',//table prefix string.表前缀
			'sqldebug' => true,
		),
	),
);
