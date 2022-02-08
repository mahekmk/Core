<?php require_once("Model/Core/Adapter.php");?>
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

	protected function saveCustomer()
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

		if(!$id):
			$query = "INSERT INTO `customer`(`firstName`,`lastName`,`mobile`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName','$mobile','$email','$status','$date')";
			$result = $adapter->insert($query);
			if(!$result):
				throw new Exception("System is unable to insert customer info.",1);
			endif;
			return $result;
		else:

			$query ="UPDATE customer 
			SET firstName='$firstName' ,
				lastName='$lastName' ,  
				mobile='$mobile' , 
				email='$email' ,
				status='$status' , 
				updatedAt='$date' 
			WHERE customerId = '$id'";
			$result = $adapter->update($query);
			if(!$result){
				throw new Exception("System is unable to update information.",1);
			}
			return $id;
		endif;
		
		
	}

	protected function saveAddress($customerId)	
	{
		$adapter = new Model_Core_Adapter();
		$address = $_POST['address']['address'];
		$postalCode = $_POST['address']['postalCode'];
		$city = $_POST['address']['city'];
		$state = $_POST['address']['state'];
		$country = $_POST['address']['country'];
		$billingAddress = $_POST['address']['billingAddress'];
		$shippingAddress = $_POST['address']['shippingAddress'];
		$addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");
		if(!$addressData):
			$query = "INSERT INTO `address`( `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billingAddress`,`shippingAddress`) VALUES ('$customerId','$address','$postalCode','$city','$state','$country','$billingAddress' ,'$shippingAddress')";
			$result = $adapter->insert($query);
			if(!$result):
				throw new Exception("System is unable to insert address info.",1);
			endif;
		else:
			$query ="UPDATE address 
			SET address='$address' , 
				postalCode='$postalCode' ,  
				city='$city' , 
				state='$state' , 
				country='$country' , 
				billingAddress='$billingAddress' , 
				shippingAddress='$shippingAddress'
			WHERE customerId = '$customerId'";
			$result = $adapter->update($query);
			if(!$result):
				throw new Exception("System is unable to update information.",1);
			endif;
			
		endif;
			
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect('index.php?c=customer&a=grid');
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
			$this->redirect('index.php?c=customer&a=grid');
		}
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
		echo "error";
	}

}

?>