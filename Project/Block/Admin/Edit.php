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

	/*public function getAdmin()
	{
		return $this->getData('admin');
	}
	*/
	public function getEditUrl()
	{
		return $this->getUrl('save');
	}
}

