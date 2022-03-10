<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomerAddresses()
	{
		$customerModel = Ccc::getModel('Customer');
		$customers = $customerModel->fetchAll("SELECT c.*, a.* from customer c left join address a on c.customerId = a.customerId");
			return $customers;
	}
}

