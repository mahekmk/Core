<?php
class Controller_Product{

	public function gridAction()
	{
		require_once('view/product/grid.php');
	}

	public function editAction()
	{
		require_once('view/product/edit.php');
	}

	public function addAction()
	{
		require_once('view/product/add.php');
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
				$query = "UPDATE product SET productId='$id' , name='$name' , price='$price' , quantity='$quantity' , status='$status' , updatedAt='$date' WHERE productID = '$id' ";
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