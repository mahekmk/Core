<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_Cart extends Controller_Core_Action
{
	
	public function gridAction()
	{

		$this->setTitle("Cart Grid");
		$content = $this->getLayout()->getContent();
        $cartGrid = Ccc::getBlock("Cart_Grid");
        $content->addChild($cartGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$content = $this->getLayout()->getContent();
		$customerModel = Ccc::getModel('Cart');
		$customers = $customerModel->getCustomers();
		$cartAdd = Ccc::getBlock("Cart_Add")->setData(['customers' => $customers]);
		$content->addChild($cartAdd);
        $this->renderLayout();
	}

	public function cartCheckAction()
	{
		try 
		{
			$message = $this->getMessage();
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d H:i:s");
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel = $customer->getCart();
			if(!$cartModel)
			{
				$cartModel = Ccc::getModel('Cart');
				$cartModel->customerId = $customerId;
				$cartModel->createdAt = $date;
				$result = $cartModel->save();
				$session = $this->getMessage()->getSession();
				$session->cartId = $result->cartId;
			}
			$session = $this->getMessage()->getSession();
			$session->cartId = $cartModel->cartId;
			print_r($this->getMessage()->getSession()->cartId); 

			//echo 21126; 
			
			$message->addMessage('Load Successfully'); 
            $this->redirect($this->getLayout()->getUrl('cartShow','cart',['id' => null],false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
	}

	public function cartShowAction()
    {
        $cartModel = Ccc::getModel('Cart');
        $customers = $cartModel->getCustomers();
        Ccc::register('cartCustomer' , $customers);
        $cartAdd = $this->getLayout()->getBlock('Cart_CartShow')->toHtml();//->setData(['customers' => $customers]);
         $response = [
            'status' => 'success',
            'content' => $cartAdd
         ] ;
        $this->renderJson($response);
    }

	public function updatePaymentMethodAction()
	{
		try 
		{
			$message = $this->getMessage();
			$paymentMethodId = $this->getRequest()->getPost('paymentMethod');
			$cartId = $this->getMessage()->getSession()->cartId;
			$cartModel = Ccc::getModel('Cart')->load($cartId);
			$customerId = $cartModel->customerId;
			//$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel = $customer->getCart();
			$cartModel->paymentMethodId = $paymentMethodId;
			$cartModel->save();
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
		
	}

	public function updateShippingMethodAction()
	{
		try 
		{
			$message = $this->getMessage();
			$shippingMethodId = $this->getRequest()->getPost('shippingMethod');
			if(!$shippingMethodId)
			{
				throw new Exception("Invalid Request");
			}
			$cartId = $this->getMessage()->getSession()->cartId;
			$cartModel = Ccc::getModel('Cart')->load($cartId);
			$customerId = $cartModel->customerId;
			//$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel = $customer->getCart();
			$shippingAmount = $this->getAdapter()->fetchOne("SELECT price from shippingMethod where methodId = {$shippingMethodId};");
			if(!$shippingAmount)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel->shippingMethodId = $shippingMethodId;
			$cartModel->shippingAmount = $shippingAmount;
			$cartModel->save();
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
		
	}

	public function saveAddressAction()
	{
		try 
		{
			$message = $this->getMessage();
			$postData = $this->getRequest()->getPost();
			if(!$postData)
			{
				throw new Exception("Invalid Request");
			}
			$billingRow = $this->getRequest()->getPost('billingAddress');
			$customerBillingRow = $this->getRequest()->getPost('customerBilling');

			if(!$billingRow)
			{
				throw new Exception("Invalid Request");
			}
	        $shippingRow = (array_key_exists('same', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
	        $customerShippingRow = (array_key_exists('same', $this->getRequest()->getPost())) ? $customerBillingRow : $this->getRequest()->getPost('customerShipping'); 
	        if(!$shippingRow)
			{
				throw new Exception("Invalid Request");
			}
			$cartId = $this->getMessage()->getSession()->cartId;
			$cartModel = Ccc::getModel('Cart')->load($cartId);
			$customerId = $cartModel->customerId;
			//$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$billingAddressModel = $customer->getBillingAddress();
			$shippingAddressModel = $customer->getShippingAddress();

			$cartModel = $customer->getCart();
			$cartBillingAddress = $cartModel->getBillingAddress(true);
			$cartShippingAddress = $cartModel->getShippingAddress(true);
			$cartId = $cartModel->cartId;
			
			$cartBillingAddress->setData($billingRow); 
			$cartBillingAddress->setData($customerBillingRow); 
			$cartBillingAddress->cartId = $cartId;
			$cartBillingAddress->billing = 1;
			$cartBillingAddress->shipping = 0;
			$cartBillingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;
			$cartBillingAddress->save();


			$cartShippingAddress->setData($shippingRow);
			$cartShippingAddress->setData($customerShippingRow); 
			$cartShippingAddress->cartId = $cartId;
			$cartShippingAddress->billing = 0;
			$cartShippingAddress->shipping = 1;
			$cartShippingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;
			$cartShippingAddress->save();


			if(array_key_exists('billingAddressBook',$postData))
			{
				$billingAddressModel->setData($billingRow);
				$billingAddressModel->save();
			}

			if(array_key_exists('shippingAddressBook',$postData))
			{
				$shippingAddressModel->setData($shippingRow);
				$shippingAddressModel->save();
			}
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		}
		
		
	}

	public function removeProductAction()
	{
		try 
		{
			$this->setTitle("Item Delete");
			$message = $this->getMessage();
			$id = $this->getRequest()->getRequest('itemId'); 
			$itemTable = Ccc::getModel('Cart_Item')->load($id);	
			if (!$id) 
			{	
				throw new Exception("Invalid Request.");
			}
			$delete = $itemTable->delete(['itemId' => $id]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");						
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect($this->getLayout()->getUrl('cartShow',null,['itemId' => null],false));			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow',null,['itemId' => null],false));	
		}
	}

	public function addProductAction()
	{
		try 
		{
			$message = $this->getMessage();
			$postData = $this->getRequest()->getPost();
			if (!$postData) 
			{	
				throw new Exception("Invalid Request.");
			}
			$ids = $postData['selected'];
			$quantities = $postData['quantity'];
			$cartId = $this->getMessage()->getSession()->cartId;
			$cartModel = Ccc::getModel('Cart')->load($cartId);
			$customerId = $cartModel->customerId;
			if (!$customerId) 
			{	
				throw new Exception("Invalid Request.");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$customer = $customer->getCart();
			$cartId = $customer->cartId;

			foreach ($quantities as $key => $value) 
			{
			
				foreach ($ids as $id) 
				{
					if($key == $id)
					{
						$productModel = Ccc::getModel('Product')->load($id);
						$cartItemModel = Ccc::getModel('Cart_Item');
						$cartItemModel->cartId = $cartId;
						$cartItemModel->productId = $id;
						$cartItemModel->quantity = $value;

						$discount = $productModel->discount;
						if($productModel->discountMode == 1)
						{
							$discount = ($productModel->price * $productModel->discount) / 100;
						}


						$cartItemModel->cost = $productModel->cost;
						$cartItemModel->price = $productModel->price; 
						$cartItemModel->tax = $productModel->tax;
						$cartItemModel->discount = $discount * $value;
						$cartItemModel->taxAmount = (($productModel->price * $productModel->tax)/100) * $value;
						$cartItemModel->save();
					}
				}
			}	
			$message->addMessage('Product Added Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		}
		
	}

	public function updateItemAction()
	{
		$message = $this->getMessage();
		try 
		{
			$cartId = $this->getMessage()->getSession()->cartId;
			$cartModel = Ccc::getModel('Cart')->load($cartId);
			$customerId = $cartModel->customerId;
			//$customerId = $this->getRequest()->getRequest('id');
			$itemIds = $this->getRequest()->getPost('quan');

			foreach ($itemIds as $itemId => $quantity) 
			{
				$cartItemModel = Ccc::getModel('Cart_Item')->load($itemId);
				$cartItemModel->quantity = $quantity;
				$cartItemModel->save();
			}
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
		 
	}
	
}