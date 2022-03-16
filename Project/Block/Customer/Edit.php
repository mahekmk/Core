<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Customer_Edit extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit.php');
	}
	public function getCustomer()
	{
		$customer = $this->getData('customer');
		$billing = $this->getData('billing');
		$shipping = $this->getData('shipping');
		return ['customer' => $customer , 'billing' => $billing , 'shipping' => $shipping]; 
	}
}

