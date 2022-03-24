<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Vendor extends Controller_Core_Action
{

	public function testAction()
	{
		$vendor = Ccc::getModel('Vendor_Address')->getVendor();
		
	}

	public function gridAction()
	{
		$this->setTitle('Vendor Grid');
		$content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock("Vendor_Grid");
        $content->addChild($vendorGrid);
        $this->renderLayout();   
	}

	public function editAction()
	{
		$this->setTitle('Vendor Edit');
		$message = $this->getMessage();
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$vendorModel = Ccc::getModel('Vendor')->load($id);
			$vendor = $vendorModel->fetchRow("SELECT * FROM `vendor` WHERE vendorId = {$id}");
			$vendorAddress = $vendorModel->getVendorAddress();
			if(!$vendor)
			{
				throw new Exception("unable to load vendor.");
			}
			$content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendor , 'vendorAddress' => $vendorAddress]);
            $content->addChild($vendorEdit);
            $this->renderLayout(); 		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);    
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
		}
	}

	public function addAction()
	{
		$this->setTitle('Vendor Add');
		$vendorModel = Ccc::getModel('vendor');
        $content = $this->getLayout()->getContent();
        $vendorAddress = $vendorModel->getVendorAddress();
        $vendorAdd = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendorModel , 'vendorAddress' => $vendorAddress]);
        $content->addChild($vendorAdd);
        $this->renderLayout();
	}

	protected function saveVendor()
	{
		$vendor = Ccc::getModel('Vendor');
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('vendor');
		$vendorId = (int)$this->getRequest()->getRequest('id');
        $vendor = Ccc::getModel('Vendor')->load($vendorId);
        if(!$vendor)
        {
            $vendor = Ccc::getModel('Vendor');
            $vendor->setData($row);
            $vendor->createdAt = $date;
        }
        else
        {
            $vendor->setData($row);
            $vendor->updatedAt = $date;
        }
        $result = $vendor->save();
        return $result->vendorId;	
	}

	protected function saveAddress($vendorId)	
	{
		$message = $this->getMessage();
		$address = Ccc::getModel('Vendor_Address');
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('address');
		$addressId = $row['id'];
		$vendorModel = Ccc::getModel('Vendor')->load($vendorId);
        $addressData = $vendorModel->getVendorAddress();
		if(!$addressData)
		{	
          	$address = Ccc::getModel('Vendor_Address');
            $address->setData($row);
            $address->vendorId = $vendorId;
            $result = $address->save();	
		}

		else
		{
			$address->setData($row);
            $address->vendorId = $vendorId;
			$result = $address->save();
		}

		if (!$result)
        {
            throw new Exception("System is unable to update information.");
        }
        $message->addMessage('Data Updated Successfully');
        $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
	}

	public function saveAction()
	{
		$message = $this->getMessage();
		try
		{
			$vendorId = $this->savevendor();
			$this->saveAddress($vendorId);
			$this->redirect($this->getUrl('grid',null,['id' => null],false));
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);      
           	$this->redirect($this->getUrl('grid',null,['id' => null],false));
		}
	}

	public function deleteAction()
	{
		$message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
		$vendor = Ccc::getModel('vendor')->load($getId);
		try
		{	
			if (!$getId) 
			{
				throw new Exception("Invalid Request.");
			}
			$id = $getId;
			$result=$vendor->delete();
			if(!$result)
			{
				throw new Exception("System is unable to delete record.");	
			}
			$message->addMessage('Data Deleted Successfully');
			$this->redirect($this->getUrl('grid',null,['id' => null],false));
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
