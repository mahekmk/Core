<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Customer_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('customer')->setPrimaryKey('customerId');
		$this->setRowClassName('Customer_Resource');
	}
}


/*class Model_Customer_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer');
	}
}*/