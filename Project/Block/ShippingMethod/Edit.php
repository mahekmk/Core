<?php 

Ccc::loadClass('Block_ShippingMethod_Edit_Tab');
Ccc::loadClass('Block_Core_Edit');

class Block_ShippingMethod_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getSaveUrl()
	{
		return $this->getUrl('save');
	}
}

