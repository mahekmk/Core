<?php require_once("Model/Core/Adapter.php");?>
<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		$adapter = new Model_Core_Adapter();
		$customers = $adapter->fetchAll("SELECT c.*, a.* FROM customer c LEFT JOIN address a ON c.customerId = a.customerId");
		$view=$this->getView();
		$view->addData('customers',$customers);
		$view->setTemplate('view/customer/grid.php');
		$view->toHtml();

		//require_once('view/customer/grid.php');
	}

	public function editAction()
	{
		global $adapter; 
        $request = new Model_Core_Request();
        $getId = $request->getRequest('id');
        if ($getId)
		{
			$id = $getId;
			$customerAddresses = $adapter->fetchRow("SELECT c.*, a.* FROM customer c LEFT JOIN address a ON c.customerId = a.customerId WHERE c.customerID = '$id'");
		}
		$view=$this->getView();
		$view->addData('customerAddresses',$customerAddresses);
		$view->setTemplate('view/customer/edit.php');
		$view->toHtml();
		//require_once('view/customer/edit.php');
	}

	public function addAction()
	{
		$view=$this->getView();
		$view->setTemplate('view/customer/add.php');
		$view->toHtml();
		//require_once('view/customer/add.php');
	}

	protected function saveCustomer()
	{
		global $adapter;
		$request = new Model_Core_Request();
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $request->getPost('customer');
		$id=$row['id'];
		$firstName=$row['firstName'];
		$lastName=$row['lastName'];
		$email=$row['email'];
		$mobile=$row['mobile'];
		$status = $row['status'];
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
		$request = new Model_Core_Request();
		$row = $request->getPost('address');
		$address = $row['address'];
		$postalCode = $row['postalCode'];
		$city = $row['city'];
		$state = $row['state'];
		$country = $row['country'];
		$billingAddress = $row['billingAddress'];
		$shippingAddress = $row['shippingAddress'];
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
		$request = new Model_Core_Request();
        $getId = $request->getRequest('id');
		try {
			
			if (!isset($getId)) {
				throw new Exception("Invalid Request.", 1);
			}
			$adapter = new Model_Core_Adapter();
			$id = $getId;
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