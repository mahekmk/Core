<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Page_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}

	public function getPages()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('pageId') FROM page");
		$this->getPager()->execute($totalCount,$page);
		$pages = $pageModel->fetchAll("SELECT * FROM page LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $pages;
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

