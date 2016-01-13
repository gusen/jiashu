<?php
jiashu::loadLib(model);
class user extends model
{
	public function __construct()
	{
		$this->setConfig(jiashu::getInstance()->getConfig());
		$this->setTableName('user');
	}
}
?>