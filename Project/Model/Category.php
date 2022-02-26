<?php

Ccc::loadClass('Model_Core_Table_Row');
class Model_Category extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Category_Resource');
	}
}


