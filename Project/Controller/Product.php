<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		  $content = $this->getLayout()->getContent();
	     $productGrid = Ccc::getBlock("Product_Grid");
	     $content->addChild($productGrid);
	     $this->renderLayout();
	}

	public function editAction()
	{	
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
         $productEdit->addData("product", $product);
         $productEdit->addData('categoryProductPair',$this->getAdapter()->fetchPairs("SELECT entityId,categoryId FROM category_product WHERE productId = {$id}"));
         $productEdit->addData('categoryPath',$categoryPath);
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
		 $product = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->addData('product',$product);
        $productAdd->addData("categoryProductPair",[]);
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
			$row = $this->getRequest()->getRequest('product');

			$categoryIds = $row['category'];

			$productId = $row['id'];
			$row1 = $this->getRequest()->getRequest('categoryProduct');	
			$row2 = $row1['checkbox'];

			$query = "SELECT entityId,categoryId FROM category_product WHERE productId = {$row['id']}";
			$categoryPair = $this->getAdapter()->fetchPairs($query);

			if (!isset($row)) 
			{
			 	throw new Exception("Invalid Request.", 1);             
         }           
            if (array_key_exists('id',$row) && $row['id'] == NULL){

            	$product->name = $row['name'];
            	$product->price = $row['price'];
            	$product->quantity = $row['quantity'];
            	$product->sku = $row['sku'];
            	$product->status = $row['status'];
            	$result = $product->save();
            	$productId = $result;
            	$product->saveCategories($categoryIds,$productId);

				if(!$result)
				{
					 throw new Exception("System is unable to insert information.",1);
				}
				 $message->addMessage('Data Added Successfully');
				$this->redirect($this->getUrl('grid','product',null,true));
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
					 throw new Exception("System is unable to update information.",1);
				}
				$message->addMessage('Data Updated Successfully');
				$this->redirect($this->getUrl('grid','product',null,true));
			}
		}
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getUrl('grid','product',null,true));
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
			
			if (!isset($getId)) 
			{
				 throw new Exception("Invalid Request.", 1);
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
				 throw new Exception("System is unable to delete record.", 1);
			}
			$message->addMessage('Data Deleted Successfully');
			$this->redirect($this->getUrl('grid','product',null,true));
		}
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function errorAction()
	{
		echo "echo";
	}

}




?>