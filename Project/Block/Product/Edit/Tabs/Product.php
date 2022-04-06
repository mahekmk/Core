<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Product_Edit_Tab');

class Block_Product_Edit_Tabs_product extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/product.php');
	}

	public function getProducts()
	{
		return Ccc::getRegistry('product');	
	}


}