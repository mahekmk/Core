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
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				$message->addMessage('Id not valid.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','vendor',null,true));
				//throw new Exception("Id not valid.");
			}
			$vendorModel = Ccc::getModel('Vendor');
			$vendor = $vendorModel->fetchRow("SELECT v.*, va.* FROM vendor v LEFT JOIN vendor_address va ON v.vendorId = va.vendorId WHERE v.vendorID = '$id'");
			if(!$vendor)
			{
				$message->addMessage('Unable to load vendor.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','vendor',null,true));
				//throw new Exception("unable to load vendor.");
			}
			$content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor);
            $content->addChild($vendorEdit);
            $this->renderLayout(); 		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function addAction()
	{
		 $vendor = Ccc::getModel('vendor');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('vendor_Edit')->addData('vendor',$vendor);
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
					$message->addMessage('System is unable to insert customer information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid','vendor',null,true)); 

				}
				return $result;
		}
		else{
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
		$message = Ccc::getModel('Core_Message');
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
                    $message->addMessage('System is unable to insert information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid','vendor',null,true)); 
                   // throw new Exception("System is unable to update information.", 1);
                }

            if($result)
            {
                $message->addMessage('Data Inserted Successfully.');
            }
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
            $message->addMessage('System is unable to update information.',Model_Core_Message::ERROR);          
            $this->redirect($this->getUrl('grid','vendor',null,true)); 
           // throw new Exception("System is unable to update information.", 1);
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
			echo $e->getMessage();
		}
	}

	public function deleteAction()
	{
		$message = Ccc::getModel('Core_Message');
        $getId = $this->getRequest()->getRequest('id');
		$vendor = Ccc::getModel('vendor')->load($getId);
		try
		{	
			if (!isset($getId)) 
			{
				$message->addMessage('Invalid Request.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','vendor',null,true));
				//throw new Exception("Invalid Request.", 1);
			}
			$id = $getId;
			$result=$vendor->delete();
			if(!$result)
			{
				$message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','vendor',null,true));
				//throw new Exception("System is unable to delete record.", 1);	
			}
			$message->addMessage('Data Deleted Successfully');
			$this->redirect($this->getUrl('grid','vendor',null,true));
		}
		catch (Exception $e)
		{
			echo $e->getMessage(); 	
		}
	}

	public function errorAction()
	{
		echo "error";
	}

}

?>