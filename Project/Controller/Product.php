<?php 
Ccc::loadClass('Controller_Core_Action');
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
		$adapter = new Model_Core_Adapter();
		if($_GET['id'])
		{
			$id = $_GET['id'];
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
		$adapter = new Model_Core_Adapter();

		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');

		$id =$_POST['product']['id'];
		$name=$_POST['product']['name'];
		$price=$_POST['product']['price'];
		$quantity=$_POST['product']['quantity'];
		$status = $_POST['product']['status'];
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
		try {
			
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			$adapter = new Model_Core_Adapter();
			$pid = $_GET['id'];
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