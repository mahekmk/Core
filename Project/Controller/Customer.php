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
			$customerModel = Ccc::getModel('Customer')->load($id);
			$customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = {$id}");
			$billing = $customerModel->getBillingAddress();
			$shipping = $customerModel->getShippingAddress();
			
			if(!$customer)
			{
				throw new Exception("unable to load customer.");
			}
			$content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock("Customer_Edit")->setData(['customer' => $customer , 'billing' => $billing , 'shipping' => $shipping]);
            $content->addChild($customerEdit);
            $this->renderLayout();		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid','customer',null,true));
		}
	}

	public function addAction()
	{
		$this->setTitle('Customer Add');
		$customer = Ccc::getModel('Customer');
		$billing = Ccc::getModel('Customer_Address');
		$shipping = Ccc::getModel('Customer_Address');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer' => $customer , 'billing' => $billing , 'shipping' => $shipping]);
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
		$billingRow = $this->getRequest()->getPost('billingAddress');
		$shippingRow = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
		$customerModel = Ccc::getModel('customer')->load($customerId);
        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();

        if(!$billingAddress->getData())
		{	
			$billingAddress->customerId = $customerId;

		}
		if(!$shippingAddress->getData())
		{
			$shippingAddress->customerId = $customerId;
		}
		$billingAddress->setData($billingRow);
		$billingAddress->billing = 1;
		$billingAddress->shipping = 0;
		$billingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

		$shippingAddress->setData($shippingRow);
		$shippingAddress->billing = 0;
		$shippingAddress->shipping = 1;
		$shippingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

		$billingAddress->save();
		$shippingAddress->save();

		$message->addMessage('Customer & Address Added successfully.');

	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			
			$this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
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
			$this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
		}
		catch (Exception $e)
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
		}
	}

	public function errorAction()
	{
		echo "error";
	}

}

?>