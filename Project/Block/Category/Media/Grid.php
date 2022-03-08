<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Media_Grid extends Block_Core_Template   
{ 
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}

   public function getCategoryMedias()
   {	

   		$front = Ccc::getFront();
   		$id = $front->getRequest()->getRequest('id');
   		$categoryMedia = Ccc::getModel('Category_Media');
		$categoryMedias = $categoryMedia->fetchAll("SELECT * FROM category_media WHERE categoryId = $id");
		return $categoryMedias;
   }
}




