<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php
class Model_Cart_Address_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('cart_address')->setPrimaryKey('cartAddressId');
		parent::__construct();
	}
}

