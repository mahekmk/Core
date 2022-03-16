<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Admin_Grid extends Block_Core_Template
{
	protected $pager;
	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
	}

	public function getAdmins()
	{
		$admin = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$adminModel = Ccc::getModel('Admin');
		$totalCount = $adminModel->getAdapter()->fetchOne("SELECT count('adminId') FROM `admin`");
		$this->getPager()->execute($totalCount,$admin);
		$admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $admins;
	}

	public function getPager()
	{
		return $this->pager;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this->pager;
	}
}

