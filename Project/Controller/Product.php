<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		$this->setTitle('Product Grid');
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock("Product_Grid");
		$content->addChild($productGrid);
		$this->renderLayout();
	}

	public function editAction()
	{	
		$this->setTitle('Product Edit');
		$message = $this->getMessage();
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				 throw new Exception("Id not valid.");
			}
			$product = Ccc::getModel('Product')->load($id);
			$categoryProduct = Ccc::getModel('Category_Product')->getAdapter()->fetchPairs("SELECT entityId,categoryId FROM category_product WHERE productId = {$id}");
			
			if(!$product)
			{
				 throw new Exception("unable to load product.");
			}
			$content = $this->getLayout()->getContent();
         $productEdit = Ccc::getBlock("Product_Edit");
         $categoryPath = Ccc::getModel('Category');
         $productEdit->setData(['product' => $product , 'categoryProductPair' => $this->getAdapter()->fetchPairs("SELECT entityId,categoryId FROM category_product WHERE productId = {$id}") , 'categoryPath' => $categoryPath ]);
         $content->addChild($productEdit);
         $this->renderLayout(); 		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function addAction()
	{
		$this->setTitle('Product Add');
		$product = Ccc::getModel('Product');
		$content = $this->getLayout()->getContent();
		$productAdd = Ccc::getBlock('Product_Edit')->setData(['product' => $product, 'categoryProductPair' => []]);
		$content->addChild($productAdd);
		$this->renderLayout();
	}

	public function saveAction()
	{
		$message = $this->getMessage();
		 
		try
		{
			$product = Ccc::getModel('Product');
			$categoryProduct = Ccc::getModel('Category_Product');
			date_default_timezone_set("Asia/Kolkata");
			$date = date('Y-m-d H:i:s');
			$row = $this->getRequest()->getPost('product');

			$categoryIds = $row['category'];

			$productId = $row['id'];
			$row1 = $this->getRequest()->getRequest('categoryProduct');	
			$row2 = $row1['checkbox'];

			$query = "SELECT entityId,categoryId FROM category_product WHERE productId = {$row['id']}";
			$categoryPair = $this->getAdapter()->fetchPairs($query);

			if (!$row) 
			{
			 	throw new Exception("Invalid Request.");             
         }           
         if (array_key_exists('id',$row) && $row['id'] == NULL)
         {

         	$product->name = $row['name'];
         	$product->price = $row['price'];
         	$product->quantity = $row['quantity'];
         	$product->sku = $row['sku'];
         	$product->status = $row['status'];
         	$result = $product->save();
         	$productId = $result->productId;
         	$product->saveCategories($categoryIds,$productId);
				if(!$result)
				{
					 throw new Exception("System is unable to insert information.");
				}
				$message->addMessage('Data Added Successfully');
				$this->redirect($this->getUrl('grid',null,['id' => null],false));
			}
			else
			{

				$product->load($row['id']);
				$product->productId = $row["id"];
				$product->name = $row['name'];
         	$product->price = $row['price'];
         	$product->quantity = $row['quantity'];
         	$product->sku = $row['sku'];
         	$product->status = $row['status'];
         	$product->updatedAt = $date;
         	$result = $product->save();
         	$product->saveCategories($categoryIds);
         		

				if(!$result)
				{
					 throw new Exception("System is unable to update information.");
				}
				$message->addMessage('Data Updated Successfully');
				$this->redirect($this->getUrl('grid',null,['id' => null],false));
			}
		}
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getUrl('grid',null,['id' => null],false));
		}

	}


	public function deleteAction()
	{
		$message = $this->getMessage();
      $getId = $this->getRequest()->getRequest('id');
		$product = Ccc::getModel('Product')->load($getId);
		try 
		{
			$query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media pm ON p.productId = pm.productId  WHERE p.productId = $getId;";

			$result1 = $this->getAdapter()->fetchPairs($query1);
			
			if (!$getId) 
			{
				 throw new Exception("Invalid Request.");
			}
			$id = $getId;
			$result = $product->delete(); 
			
			foreach($result1 as $key => $value)
			{
               if($result)
               {
                  unlink($this->getBaseUrl('Media/product/') . $value);
               }
            }

			if(!$result)
			{
				 throw new Exception("System is unable to delete record.");
			}
			$message->addMessage('Data Deleted Successfully');
			$this->redirect($this->getUrl('grid',null,['id' => null],false));
		}
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getUrl('grid',null,['id' => null],false));
		}
	}

	public function errorAction()
	{
		echo "echo";
	}

}




?>