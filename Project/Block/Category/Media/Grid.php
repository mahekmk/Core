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
   		$id = $_GET['id'];
   		$categoryMedia = Ccc::getModel('Category_Media');
		$categoryMedias = $categoryMedia->fetchAll("SELECT * FROM category_media WHERE categoryId = $id");
		return $categoryMedias;
   }
}




