<?php 

Ccc::loadClass('Block_Admin_Edit_Tab');
Ccc::loadClass('Block_Core_Edit');
class Block_Admin_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		//$this->setTemplate('view/admin/edit.php');
	}
	
	public function getSaveUrl()
	{
		return $this->getUrl('save');
	}
}

