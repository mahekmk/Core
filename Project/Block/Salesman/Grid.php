<?php 

Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getSalesmen()
	{
		$salesman = Ccc::getModel('Salesman');
		$salesmen = $salesman->fetchAll("SELECT * FROM `salesman`");
		return $salesmen;
	}

}



