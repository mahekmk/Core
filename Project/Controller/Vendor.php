<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock("Vendor_Grid");
        $content->addChild($vendorGrid);
        $this->renderLayout();   
	}

	public function editAction()
	{
		$message = $this->getMessage();
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$vendorModel = Ccc::getModel('Vendor');
			$vendor = $vendorModel->fetchRow("SELECT v.*, va.* FROM vendor v LEFT JOIN vendor_address va ON v.vendorId = va.vendorId WHERE v.vendorID = '$id'");
			if(!$vendor)
			{
				throw new Exception("unable to load vendor.");
			}
			$content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendor]);
            $content->addChild($vendorEdit);
            $this->renderLayout(); 		
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);    
            $this->redirect($this->getUrl('grid','vendor',null,true));
		}
	}

	public function addAction()
	{
		$vendor = Ccc::getModel('vendor');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('vendor_Edit')->setData(['vendor' => $vendor]);
        $content->addChild($vendorAdd);
        $this->renderLayout();
	}

	protected function saveVendor()
	{
		$vendor = Ccc::getModel('Vendor');
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('vendor');
		if(array_key_exists('id',$row) && $row['id'] == NULL)
		{
			$vendor->firstName = $row['firstName'];
			$vendor->lastName =  $row['lastName'];
			$vendor->email =  $row['email'];
			$vendor->mobile =  $row['mobile'];
			$vendor->status =  $row['status'];
			$vendor->createdAt = $date;
			$result = $vendor->save();
			if(!$result)
			{
                throw new Exception("System is unable to insert customer information.");
			}
			return $result;
		}
		else
		{
			$vendor->load($row['id']);
			$vendor->vendorId = $row['id'];
			$vendor->firstName = $row['firstName'];
			$vendor->lastName =  $row['lastName'];
			$vendor->email =  $row['email'];
			$vendor->mobile =  $row['mobile'];
			$vendor->status =  $row['status'];
			$vendor->updatedAt =  $date;
			$vendor->save();
			return $row['id'];
		}	
	}

	protected function saveAddress($vendorId)	
	{
		$message = $this->getMessage();
		$address = Ccc::getModel('Vendor_Address');
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		$row = $this->getRequest()->getRequest('address');
		$addressId = $row['id'];
		$addressData = $address->fetchRow("SELECT * FROM vendor_address WHERE vendorId = '$vendorId'");
		if(!$addressData)
		{
			$address->vendorId = $vendorId;
			$address->address = $row['address'];
			$address->postalCode = $row['postalCode'];
			$address->city = $row['city'];
			$address->state= $row['state'];
			$address->country = $row['country'];
			$result = $address->save();
			if (!$result)
            {
                throw new Exception("System is unable to update information.");
            }
            $message->addMessage('Data Inserted Successfully.');
		}

		else
		{
			$e = $address->load($row['id']);
			$address->addressId = $row['id'];
			$address->vendorId = $vendorId;
			$address->address = $row['address'];
			$address->postalCode = $row['postalCode'];
			$address->city = $row['city'];
			$address->state= $row['state'];
			$address->country = $row['country'];
			$result = $address->save();
			if (!$result)
	        {
	            throw new Exception("System is unable to update information.");
	        }
	        $message->addMessage('Data Updated Successfully');		
		}
	}

	public function saveAction()
	{
		try
		{
			$vendorId = $this->savevendor();
			$this->saveAddress($vendorId);
			$this->redirect($this->getUrl('grid','vendor',null,true));
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);      
            $this->redirect($this->getUrl('grid','vendor',null,true));
		}
	}

	public function deleteAction()
	{
		$message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
		$vendor = Ccc::getModel('vendor')->load($getId);
		try
		{	
			if (!isset($getId)) 
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
			$this->redirect($this->getUrl('grid','vendor',null,true));
		}
		catch (Exception $e)
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);     
            $this->redirect($this->getUrl('grid','vendor',null,true)); 	
		}
	}

	public function errorAction()
	{
		echo "error";
	}
}
