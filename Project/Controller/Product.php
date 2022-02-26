<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
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
			Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
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


			/*$id =$row['id'];
			$name=$row['name'];
			$price=$row['price'];
			$quantity=$row['quantity'];
			$status = $row['status'];
			$createdAt = $date;
			$updatedAt = $date;*/
			
			if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (!array_key_exists('id',$row)):

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
			
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id = $getId;
			$result = $product->delete(); 
			//$result= $productModel->delete(['productId' => $id]);
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