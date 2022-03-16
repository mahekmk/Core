<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Grid extends Block_Core_Template
{
	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendorAddresses()
	{
		$vendor = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Vendor');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('vendorId') FROM `vendor`");
		$this->getPager()->execute($totalCount,$vendor);
		$vendors = $pageModel->fetchAll("SELECT v.*, va.* from vendor v left join vendor_address va on v.vendorId = va.vendorId LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $vendors;
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

	/*public function getVendorAddresses()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendors = $vendorModel->fetchAll("SELECT v.*, va.* from vendor v left join vendor_address va on v.vendorId = va.vendorId");
		return $vendors;
	}*/
}

