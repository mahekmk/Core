<?php



Ccc::loadClass('Model_Core_Row_Resource');
class Model_Page_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('page')->setPrimaryKey('pageId');
		$this->setRowClassName('Page_Resource');
		parent::__construct();
	}
}



