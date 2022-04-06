<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Vendor_Edit_Tab');

class Block_Vendor_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit/tabs/address.php');
	}

	public function getVendorAddress()
	{
		return Ccc::getRegistry('vendorAddress');
	}
}