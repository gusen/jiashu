<?php
class index
{

	public function __construct()
	{
	}

	public function index()
	{
		jiashu::loadCustomLib('GenUniqID');//load custom function file.读取一个自定义的函数文件
		JSFW()->setTplData('n',GenUniqID());
		
		//echo 'hello world';
		JSFW()->render('index');
	}

	public function tpl()
	{
		$n = JSFW()->getConfig()['appName'];
		$v = JSFW()->getVersion();
		JSFW()->setTplData('n',$n)->setTplData('v',$v);
		JSFW()->render('index');
	}

	public function db()
	{
		jiashu::loadLib('model');
		$user = new model('user','testdb');
		//$r = $user->executeSql('select * from test_user');//you can use executeSql() to query a SQL statment directly.用executeSql()函数可以直接执行SQL语句
		$r = $user->field('username,email')->limit('1')->query();
		JSFW()->setTplData('r',$r);
		JSFW()->render('index');
	}
	
	public function testsession()//set a session value.设置一个session值
	{
		jiashu::loadLib('session');
		$sess = new session;
		$sess->sessionStart()->setSession('testsession','session is work!');
		JSFW()->render('index');
	}
	
	public function testsession2()//get session value.读取session值看能不能得到之前设置的内容
	{
		$v = JSFW()->getVersion();
		jiashu::loadLib('session');
		$sess = new session;
		JSFW()->setTplData('n',$sess->sessionStart()->getSession('testsession'))->setTplData('v',$v);
		JSFW()->render('index');
	}
	
	public function clientinfo()
	{
		jiashu::loadLib('clientinfo');
		echo 'IP:'.clientinfo::getIP().'<br />';
		echo 'UA:'.clientinfo::getUserAgent().'<br />';
		echo 'Browser:'.clientinfo::getBrowser().'<br />';
		echo 'Language:'.clientinfo::getLang().'<br />';
		echo 'OS:'.clientinfo::getOS().'<br />';
		echo 'Referer:'.clientinfo::getReferer().'<br />';
		echo 'Mobile:'.(clientinfo::isMobile() ? 'isMobile' : 'notMobile').'<br />';
		echo 'Android:'.(clientinfo::isAndroid() ? 'isAndroid' : 'notAndroid').'<br />';
		echo 'IOS:'.(clientinfo::isIOS() ? 'isIOS' : 'notIOS').'<br />';
	}
}
?>
