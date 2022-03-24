<?php 

Ccc::loadClass('Block_Core_Template');
class Block_PaymentMethod_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/paymentMethod/grid.php');
	}

	public function getPaymentMethods()
	{
		$paymentMethod = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		$totalCount = $paymentMethodModel->getAdapter()->fetchOne("SELECT count('paymentMethodId') FROM `paymentMethod`");
		$this->getPager()->execute($totalCount,$paymentMethod);
		$paymentMethods = $paymentMethodModel->fetchAll("SELECT * FROM `paymentMethod` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $paymentMethods;
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
