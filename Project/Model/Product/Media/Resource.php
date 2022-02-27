<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_Product_Media_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('product_media')->setPrimaryKey('imageId');
		$this->setRowClassName('Product_Media_Resource');
		parent::__construct();
	}
}


/*class Model_Product_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Product');
	}
}*/