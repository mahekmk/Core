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
		global $adapter;
        $request = new Model_Core_Request();
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $request->getPost('product');
		$id =$row['id'];
		$name=$row['name'];
		$price=$row['price'];
		$quantity=$row['quantity'];
		$status = $row['status'];
		$createdAt = $date;
		$updatedAt = $date;
		try{
			if($id == NULL):
				$query = "INSERT INTO product(name,price,quantity,status,createdAt) VALUES ('$name','$price','$quantity','$status','$date')";
				$result = $adapter->insert($query);
				if(!$result){
					throw new Exception("System is unable to insert information.",1);
				}
				$this->redirect($this->getUrl('grid','product',null,true));
			else:
				$query = "UPDATE product SET productId='$id' , name='$name' , price='$price' , quantity='$quantity' , status='$status' , updatedAt='$date' WHERE productId = '$id' ";
				$result = $adapter->update($query);

				if(!$result){
					throw new Exception("System is unable to update information.",1);
				}
				$this->redirect('index.php?c=product&a=grid');
			endif;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}


	public function deleteAction()
	{
		$request = new Model_Core_Request();
        $getId = $request->getRequest('id');
		try {
			
			if (!isset($getId)) {
				throw new Exception("Invalid Request.", 1);
			}
			$adapter = new Model_Core_Adapter();
			$pid = $getId;
			$result= $adapter->delete("DELETE FROM product WHERE productId = '$pid' ");
			if(!$result){
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect($this->getUrl('grid','admin',null,true));
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