
<?php
class Controller_Customer{

	public function gridAction()
	{
		require_once('view/customer/grid.php');
	}

	public function editAction()
	{
		require_once('view/customer/edit.php');
	}

	public function addAction()
	{
		require_once('view/customer/add.php');
	}

	public function saveAction()
	{
		$adapter = new Model_Core_Adapter();

		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		
			$id=$_POST['customer']['id'];
			$firstName=$_POST['customer']['firstName'];
			$lastName=$_POST['customer']['lastName'];
			$email=$_POST['customer']['email'];
			$mobile=$_POST['customer']['mobile'];
			$status = $_POST['customer']['status'];
			$createdAt = $date;
			$updatedAt = $date;
			$address = $_POST['address']['address'];
			$postalCode = $_POST['address']['postalCode'];
			$city = $_POST['address']['city'];
			$state = $_POST['address']['state'];
			$country = $_POST['address']['country'];
			$billingAddress = $_POST['address']['billingAddress'];
			$shippingAddress = $_POST['address']['shippingAddress'];
			
		try{	
			if($id == NULL):
				$query1 = "INSERT INTO `customer`(`firstName`,`lastName`,`mobile`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName','$mobile','$email','$status','$date')";
				$result1 = $adapter->insert($query1);
				if(!$result1){
					throw new Exception("System is unable to insert customer info.",1);
				}
				$query2 = "INSERT INTO `address`( `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billingAddress`,`shippingAddress`) VALUES ('$result1','$address','$postalCode','$city','$state','country','$billingAddress' ,'$shippingAddress')";
				$result2 = $adapter->insert($query2);
				if(!$result2){
					throw new Exception("System is unable to insert address info.",1);
				}
				$this->redirect('index.php?c=customer&a=grid');
			else:
				$query ="UPDATE customer c INNER JOIN address a ON c.customerId = a.customerId SET c.firstName='$firstName' , c.lastName='$lastName' ,  c.mobile='$mobile' , c.email='$email' , c.status='$status' , c.updatedAt='$date' , a.address='$address' , a.postalCode='$postalCode' ,  a.city='$city' , a.state='$state' , a.country='$country' , a.billingAddress='$billingAddress' , a.shippingAddress='$shippingAddress' WHERE c.customerID = '$id'";
				$result = $adapter->update($query);
				if(!$result){
					throw new Exception("System is unable to update information.",1);
				}
				$this->redirect('index.php?c=customer&a=grid');
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
			$id = $_GET['id'];
			$result= $adapter->delete("DELETE FROM customer WHERE customerId = '$id'  ");
			if(!$result){
				throw new Exception("System is unable to delete record.", 1);	
			}
				//var_dump($result);
			$this->redirect('index.php?c=customer&a=grid');
		}
		catch (Exception $e) {
			$this->redirect('index.php?c=customer&a=grid');	
		}
	}

	public function redirect($url)
	{
		header("location:$url");	
		exit();			
	}


	public function errorAction()
	{
		echo "error";
	}

}

?>