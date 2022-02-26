<?php

Ccc::loadClass('Model_Core_Row');
class Model_Config extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Config_Resource');
		parent::__construct();
	}
}


/*Ccc::loadClass('Model_Core_Row_Resource');
class Model_Config extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('config')->setPrimaryKey('configId');
		$this->setRowClassName('Config_Resource');
	}
}
*/




/*class Model_Config_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Config');
	}
}*/
?>