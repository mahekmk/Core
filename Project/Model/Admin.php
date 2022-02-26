<?php
Ccc::loadClass('Model_Core_Row');
class Model_Admin extends Model_Core_Row
{
	public function __construct()
	{
		$this->setTableClassName('Admin_Resource');
		parent::__construct();
	}
}



/*class Model_Admin_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Admin');
	}
}*/
?>