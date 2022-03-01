<?php
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Salesman_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('salesman')->setPrimaryKey('salesmanId');
		//$this->setRowClassName('Salesman_Resource');
		parent::__construct();
	}
}





