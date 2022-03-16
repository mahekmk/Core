<?php
Ccc::loadClass('Model_Core_Row');
class Model_Vendor_Address extends Model_Core_Row
{
	protected $vendor;

	public function __construct()
	{
		$this->setResourceClassName('Vendor_Address_Resource');
	}

	public function getVendor($reload = false)
	{
		$vendorModel = Ccc::getModel('Vendor');
		if(!$this->addressId)
		{ 
			return $vendorModel;
		}
		if($this->vendor && !$reload)
		{ 
			return $this->vendor;
		}

		$vendor = $vendorModel->fetchRow("SELECT * from vendor WHERE vendorId = {$this->vendorId}");
		if(!$vendor)
		{

			return $vendorModel;
		}
		$this->setVendor($vendor);
		return $vendor;
	}

	public function setVendor(Model_Vendor $vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}


}

