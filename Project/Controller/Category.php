<?php
class Controller_Category{

	public function gridAction()
	{
		require_once('view/category/grid.php');
	}

	public function editAction()
	{
		require_once('view/category/edit.php');
	}

	public function addAction()
	{
		require_once('view/category/add.php');
	}

	public function saveAction()
	{
		$adapter = new Model_Core_Adapter();

		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');

		$id =$_POST['category']['id'];
		$name=$_POST['category']['name'];
		$status = $_POST['category']['status'];
		$createdAt = $date;
		$updatedAt = $date;

		try{
			if($id == NULL):
				$query = "INSERT INTO `category`(`name`,`status`,`createdAt`)
					 VALUES ('$name','$status','$date')";
				$result = $adapter->insert($query);
				if(!$result){
					throw new Exception("System is unable to insert information.",1);
				}
				$this->redirect('index.php?c=category&a=grid');
			else:
				$query = "UPDATE category 
					SET categoryId='$id' , 
						name='$name' ,  
						status='$status' , 
						updatedAt='$date' 
					WHERE categoryID = '$id' ";
				$result = $adapter->update($query);
				if(!$result){
					throw new Exception("System is unable to update information.",1);
				}
				$this->redirect('index.php?c=category&a=grid');
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
			$query = "DELETE FROM category WHERE categoryId = '$pid' ";
			$result= $adapter->delete($query);
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);	
			}
			//var_dump($result);
			$this->redirect('index.php?c=category&a=grid');
		}
		catch (Exception $e) {
			echo $e->getMessage();	
			//echo $e->getMessage();
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