<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');

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
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$productModel = Ccc::getModel('Product');
			$product = $productModel->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
			if(!$product){
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
		$productModel = Ccc::getModel('Product');
		global $adapter;
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('product');
		$id =$row['id'];
		$name=$row['name'];
		$price=$row['price'];
		$quantity=$row['quantity'];
		$status = $row['status'];
		$createdAt = $date;
		$updatedAt = $date;
		try{
			if($id == NULL):
				$result = $productModel->insert(['name' => $name, 'price' => $price , 'quantity' => $quantity , 'status' => $status]);
				if(!$result){
					throw new Exception("System is unable to insert information.",1);
				}
				$this->redirect($this->getUrl('grid','product',null,true));
			else:
				$result = $productModel->update(['name' => $name, 'status' => $status, 'price' => $price, 'quantity' => $quantity, 'updatedAt' => $date], ['productId' => $id]);

				if(!$result){
					throw new Exception("System is unable to update information.",1);
				}
				$this->redirect($this->getUrl('grid','product',null,true));
			endif;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}


	public function deleteAction()
	{
		$productModel = Ccc::getModel('Product');
        $getId = $this->getRequest()->getRequest('id');;
		try {
			
			if (!isset($getId)) {
				throw new Exception("Invalid Request.", 1);
			}
			$adapter = new Model_Core_Adapter();
			$id = $getId;
			$result= $productModel->delete(['productId' => $id]);
			if(!$result){
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect($this->getUrl('grid','product',null,true));
		}//var_dump($result);
		catch (Exception $e) {
			echo $e->getMessage();
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