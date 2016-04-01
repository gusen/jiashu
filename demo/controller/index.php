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
		JSFW()->render('index');//$GLOBALS['JSFW']->render('index');
	}

	public function db()
	{
		jiashu::loadLib('model');
		$user = new model('user','testdb');
		//$r = $user->executeSql('select * from test_user');
		$r = $user->field('username,email')->limit('1')->query();
		//print_r($r);
		JSFW()->setTplData('r',$r);
		JSFW()->render('index');
	}
}
?>
