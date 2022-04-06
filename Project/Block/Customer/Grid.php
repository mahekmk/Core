<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Customer_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit',null,['id'=>$customer->customerId]);
	}
	
	public function getDeleteUrl($customer)
	{
		return $this->getUrl('delete',null,['id'=>$customer->customerId]);
	}
	public function prepareActions()
	{
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getcustomers());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('customerId', [
			'title' => 'customer Id',
			'type' => 'int',
		]);

		$this->addColumn('firstName',[
			'title' => 'First Name',
			'type' => 'varchar',
		]);

		$this->addColumn('lastName',[
			'title' => 'Last Name',
			'type' => 'varchar',
		]);

		$this->addColumn('email',[
			'title' => 'Email',
			'type' => 'varchar',
		]);

		$this->addColumn('mobile',[
			'title' => 'mobile',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);
		$this->addColumn('address',[
			'title' => 'Address',
			'type' => 'varchar',
		]);

		$this->addColumn('postalCode',[
			'title' => 'Postal Code',
			'type' => 'int',
		]);

		$this->addColumn('city',[
			'title' => 'City',
			'type' => 'varchar',
		]);

		$this->addColumn('state',[
			'title' => 'State',
			'type' => 'varchar',
		]);

		$this->addColumn('country',[
			'title' => 'Country',
			'type' => 'varchar',
		]);

		$this->addColumn('billing',[
			'title' => 'Billing',
			'type' => 'int',
		]);

		$this->addColumn('shipping',[
			'title' => 'Shipping',
			'type' => 'int',
		]);

		$this->addColumn('same',[
			'title' => 'Same',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'UpdatedAt',
			'type' => 'datetime',
		]);

		return $this;
	}


	public function getCustomers()
	{
		$customer = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$customerModel = Ccc::getModel('Customer');
		$totalCount = $customerModel->getAdapter()->fetchOne("SELECT count('customerId') FROM `customer`");
		$this->getPager()->execute($totalCount,$customer);
		$customers = $customerModel->fetchAll("SELECT c.*, a.* from customer c left join address a on c.customerId = a.customerId WHERE a.billing = 1 LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $customers;
	}
}

