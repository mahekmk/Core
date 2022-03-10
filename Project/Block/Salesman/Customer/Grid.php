<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/customer/grid.php');
	}

	public function getSalesmanCustomers()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT `customerId`, `firstName`, `lastName`, `email` FROM `customer` WHERE `salesmanId` = {$id} ");
		return $salesmanCustomers;
	}

	public function getCustomersWithNoSalesman()
	{	
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT `customerId`, `firstName`, `lastName`, `email` FROM `customer` WHERE `salesmanId` is null ");
		return $salesmanCustomers;
	}
}