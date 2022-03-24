<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Order_Grid extends Block_Core_Template
{
	protected $pager;
	public function __construct()
	{
		$this->setTemplate('view/order/grid.php');
	}

	public function getOrders()
	{
		$order = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$orderModel = Ccc::getModel('order');
		$totalCount = $orderModel->getAdapter()->fetchOne("SELECT count('orderId') FROM `orders`");
		$this->getPager()->execute($totalCount,$order);
		$orders = $orderModel->fetchAll("SELECT * FROM `orders` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $orders;
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