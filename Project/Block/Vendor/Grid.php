<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendorAddresses()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendors = $vendorModel->fetchAll("SELECT v.*, va.* from vendor v left join vendor_address va on v.vendorId = va.vendorId");
		return $vendors;
	}
}

