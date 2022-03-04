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
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$product = Ccc::getModel('Product')->load($id);
			//$product = $productModel->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
			if(!$product)
			{
				throw new Exception("unable to load product.");
			}
			$content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock("Product_Edit")->addData("product", $product);
            $content->addChild($productEdit);
            $this->renderLayout(); 		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function addAction()
	{
		 $product = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->addData('product',$product);
        $content->addChild($productAdd);
        $this->renderLayout();
	}

	public function saveAction()
	{
		try
		{
			$product = Ccc::getModel('Product');
			date_default_timezone_set("Asia/Kolkata");
			$date = date('Y-m-d H:i:s');
			//$product = $productModel->getRow();
			$row = $this->getRequest()->getRequest('product');

			
			if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL):

            	$product->name = $row['name'];
            	$product->price = $row['price'];
            	$product->quantity = $row['quantity'];
            	$product->status = $row['status'];
            	$result = $product->save();


				/*$result = $productModel->insert(['name' => $name, 'price' => $price , 'quantity' => $quantity , 'status' => $status]);*/
				if(!$result)
				{
					throw new Exception("System is unable to insert information.",1);
				}
				$this->redirect($this->getUrl('grid','product',null,true));
			else:

				$product->load($row['id']);
				$product->productId = $row["id"];
				$product->name = $row['name'];
            	$product->price = $row['price'];
            	$product->quantity = $row['quantity'];
            	$product->status = $row['status'];
            	$product->updatedAt = $date;
            	$result = $product->save();

				/*$result = $productModel->update(['name' => $name, 'status' => $status, 'price' => $price, 'quantity' => $quantity, 'updatedAt' => $date], ['productId' => $id]);*/

				if(!$result)
				{
					throw new Exception("System is unable to update information.",1);
				}
				$this->redirect($this->getUrl('grid','product',null,true));
			endif;
		}
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}

	}


	public function deleteAction()
	{
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
			$this->redirect($this->getUrl('grid','product',null,true));
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','product',null,true));
		}
	}

	public function redirect($url)
	{
		header("location:$url");	
		exit();			
	}

	public function errorAction()
	{
		echo "echo";
	}

}




?>