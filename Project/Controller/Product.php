<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>


<?php
class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		$adapter = new Model_Core_Adapter();
		$products = $adapter->fetchAll("SELECT * FROM product");
		echo "<pre>";
		$view = $this->getView();
		$view->addData('products',$products);
		$view->setTemplate('view/product/grid.php'); 
		$view->toHtml();
		
		/*require_once('view/product/grid.php');*/
	}

	public function editAction()
	{
		global $adapter;
		$request = new Model_Core_Request();
        $getId = $request->getRequest('id');
		if($getId)
		{
			$id = $getId;
			$productRow = $adapter->fetchRow("SELECT * FROM product WHERE productID = '$id'");
		}
		$view = $this->getView();
		$view->addData('productRow',$productRow);
		$view->setTemplate('view/product/edit.php'); 
		$view->toHtml();

		//require_once('view/product/edit.php');
	}

	public function addAction()
	{
		$adapter = new Model_Core_Adapter();
		$view = $this->getView();
		$view->setTemplate('view/product/add.php'); 
		$view->toHtml();
		//require_once('view/product/add.php');
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
				$this->redirect('index.php?c=product&a=grid');
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
			$this->redirect("index.php?c=product&a=grid");
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