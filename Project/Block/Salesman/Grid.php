<?php 

Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Grid extends Block_Core_Template
{
	protected $pager;
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getSalesmen()
	{
		$salesman = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$salesmanModel = Ccc::getModel('Salesman');
		$totalCount = $salesmanModel->getAdapter()->fetchOne("SELECT count('salesmanId') FROM `salesman`");
		$this->getPager()->execute($totalCount,$salesman);
		$salesmen = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $salesmen;
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



