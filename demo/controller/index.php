<?php
class index
{

	public function __construct()
	{
	}

	public function index()
	{
		echo 'hello world';
	}

	public function tpl()
	{
		$n = $GLOBALS['JSFW']->getConfig()['appName'];
		$v = $GLOBALS['JSFW']->getVersion();
		$GLOBALS['JSFW']->setTplData('n',$n)->setTplData('v',$v);
		$GLOBALS['JSFW']->render('index');
	}

	public function db()
	{
		jiashu::loadLib('model');
		$user = new model('user','testdb');
		//$r = $user->executeSql('select * from test_user');
		$r = $user->field('username,email')->limit('1')->query();
		//print_r($r);
		$GLOBALS['JSFW']->setTplData('r',$r);
		$GLOBALS['JSFW']->render('index');
	}
}
?>
