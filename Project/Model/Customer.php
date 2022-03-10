<?php

Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';
	

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
	}

	public function getStatus($key = null)
	{		
		
		$statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
					self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

		if(!$key)
		{
			return $statues;
		}

		if(array_key_exists($key , $statues))
		{
			return $statues[$key];
		}

		return self::STATUS_DEFAULT;
	}

	public function saveSalesmanInfo($customerIds)
	{
		$salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
		
		foreach ($customerIds as $customerId) 
		{		
			$customer = Ccc::getModel('customer');
			$customer->customerId = $customerId;
			$customer->salesmanId = $salesmanId;
			$result = $customer->save();

		}
		return $result;
	}

}


