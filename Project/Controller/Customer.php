<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		$this->setTitle('Customer Grid');
		$content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock("Customer_Grid");
        $content->addChild($customerGrid);
        $this->renderLayout();
	}

	public function editAction()
	{
		$this->setTitle('Customer Edit');
		$message = $this->getMessage();
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
			$content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer]);
            $content->addChild($customerEdit);
            $this->renderLayout();		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','customer',null,true));
		}
	}

	public function addAction()
	{
		$this->setTitle('Customer Add');
		$customer = Ccc::getModel('Customer');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer' => $customer]);
        $content->addChild($customerAdd);
        $this->renderLayout();
	}

	protected function saveCustomer()
	{
		$message = $this->getMessage();
		$customer = Ccc::getModel('Customer');
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('customer');
		$customerId = (int)$this->getRequest()->getRequest('id');
        $customer = Ccc::getModel('Customer')->load($customerId);
        if(!$customer)
        {
            $customer = Ccc::getModel('Customer');
            $customer->setData($row);
            $customer->createdAt = $date;
        }
        else
        {
            $customer->setData($row);
            $customer->updatedAt = $date;
        }
        $result = $customer->save();
        return $result->customerId;	
	}

	protected function saveAddress($customerId)	
	{
		$message = $this->getMessage();
		$address = Ccc::getModel('Customer_Address');
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
		$addressData = $address->fetchRow("SELECT * FROM `address` WHERE `customerId` = {$customerId}");
		if(!$addressData)
		{	
          	$address = Ccc::getModel('Customer_Address');
            $address->setData($row);
            $address->customerId = $customerId;
            $result = $address->save();	
		}

		else
		{
			$address->setData($row);
            $address->customerId = $customerId;
            $address->billing = $row['billing'];
            $address->shipping = $row['shipping'];
			$result = $address->save();
		}

		if (!$result)
        {
            throw new Exception("System is unable to update information.");
        }
        $message->addMessage('Data Updated Successfully');
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
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','customer',null,true));
		}
	}

	public function deleteAction()
	{
		$message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($getId);
		try
		{	
			if (!$getId) 
			{
				throw new Exception("Invalid Request.");
			}
			$id = $getId;
			$result=$customer->delete();
			if(!$result)
			{
				throw new Exception("System is unable to delete record.");	
			}
			$message->addMessage('Data Deleted Successfully');
			$this->redirect($this->getUrl('grid','customer',null,true));
		}
		catch (Exception $e)
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','customer',null,true));
		}
	}

	public function errorAction()
	{
		echo "error";
	}

}

?>