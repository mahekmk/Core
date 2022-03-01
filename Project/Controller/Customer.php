<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
		/*$customerModel = Ccc::getModel('Customer');
		echo "<pre>";
		print_r($customerModel);
		$customer = $customerModel->getRow();
		$customer->customerId = '174';
		$customer->firstName = 'Mahek';
		$customer->lastName = 'Mahek';
		unset($customer->lastName);
		$customer->email = '123@mahek.com';
		$customer->save();
		print_r($customer);*/

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
			$customerModel = Ccc::getModel('Customer');
			$customer = $customerModel->fetchRow("SELECT c.*, a.* FROM customer c LEFT JOIN address a ON c.customerId = a.customerId WHERE c.customerID = '$id'");
			if(!$customer)
			{
				throw new Exception("unable to load customer.");
			}
			Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->toHtml();		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function addAction()
	{
		$customer = Ccc::getModel('Customer');
		Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->toHtml();
		//Ccc::getBlock('Customer_Add')->toHtml();
	}

	protected function saveCustomer()
	{
		$customer = Ccc::getModel('Customer');
		//$customer = $customerModel->getRow();
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('customer');
		//$customer = $customerModel->load($row['id']);
		if(array_key_exists('id',$row) && $row['id'] == NULL)
		{
				$customer->firstName = $row['firstName'];
				$customer->lastName =  $row['lastName'];
				$customer->email =  $row['email'];
				$customer->mobile =  $row['mobile'];
				$customer->status =  $row['status'];
				$result = $customer->save();
				return $result;
		}
		else{
				$customer->load($row['id']);
				$customer->customerId = $row["id"];
				$customer->firstName = $row['firstName'];
				$customer->lastName =  $row['lastName'];
				$customer->email =  $row['email'];
				$customer->mobile =  $row['mobile'];
				$customer->status =  $row['status'];
				$customer->updatedAt =  $date;
				$customer->save();
				return $row['id'];
		}
		
		/*if(!array_key_exists('id',$row))
		{	
			$result = $customerModel->insert(['firstName' => $row['firstName'] , 'lastName' => $row['lastName'] , 'email' => $row['email'] , 'mobile' => $row['mobile'] , 'status' => $row['status']]);
			if(!$result)
			{
				throw new Exception("System is unable to insert customer info.",1);
			}
			return $result;
		}
		else
		{
			$id=$row['id'];
			$result = $customerModel->update(['firstName' => $row['firstName'] , 'lastName' => $row['lastName'] , 'email' => $row['email'] , 'mobile' => $row['mobile'] , 'status' => $row['status'] , 'updatedAt' => $date] , ['customerId' => $id]);
			if(!$result)
			{
				throw new Exception("System is unable to update information.",1);
			}
			return $id;
		}*/
	}

	protected function saveAddress($customerId)	
	{
		$address = Ccc::getModel('Customer_Address');
		//$address = $addressModel->getRow();
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('address');

		$addressId = $row['id'];
		
		$billing = 0;
	    $shipping = 0;

        if (array_key_exists("billing", $row) && $row["billing"] == 1) 
        {
            $billing = 1;
        }
        if (array_key_exists("shipping", $row) && $row["shipping"] == 1) 
        {
            $shipping = 1;
        }
		

		$addressData = $address->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");
		/*$addressArr = $addressData->getData();*/
		
		if(!$addressData):

			$address->customerId = $customerId;
			$address->address = $row['address'];
			$address->postalCode = $row['postalCode'];
			$address->city = $row['city'];
			$address->state= $row['state'];
			$address->country = $row['country'];
			$address->billing = $row['billing'];
			$address->shipping = $row['shipping'];
			$result = $address->save();

/*
		$result = $addressModel->insert(['customerId' => $customerId , 'address' => $row['address'] , 'postalCode' => $row['postalCode'] , 'city' => $row['city'] , 'state' => $row['state'] , 'country' => $row['country'] , 'billing' => $row['billing'] , 'shipping' => $row['shipping']]);
		if(!$result):
			throw new Exception("System is unable to insert address info.",1);
		endif;
*/

		else:
			$e = $address->load($row['id']);
			$address->addressId = $row['id'];
			$address->customerId = $customerId;
			$address->address = $row['address'];
			$address->postalCode = $row['postalCode'];
			$address->city = $row['city'];
			$address->state= $row['state'];
			$address->country = $row['country'];
			$address->billing = $row['billing'];
			$address->shipping = $row['shipping'];
			$result = $address->save();

		
       /* $id = $row['id'];
		$result = $addressModel->update(['customerId' => $customerId , 'address' => $row["address"] , 'city' => $row["city"] ,'state' => $row["state"] , 'country' => $row["country"] , 'postalCode' => $row["postalCode"] , 'billing' => $billing,'shipping' =>  $shipping ],['addressId' => $id] );*/
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
			$this->redirect($this->getUrl('grid','customer',null,true));
		} 
		
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function deleteAction()
	{
        $getId = $this->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($getId);
		try
		{	
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id = $getId;
			$result=$customer->delete();
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);	
			}
			$this->redirect($this->getUrl('grid','customer',null,true));
		}
		catch (Exception $e)
		{
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