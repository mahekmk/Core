<?php 
 
Ccc::loadClass('Block_Vendor_Edit_Tab');
Ccc::loadClass('Block_Core_Edit');
class Block_Vendor_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getEditUrl()
	{
		return $this->getUrl('save');
	}
}

