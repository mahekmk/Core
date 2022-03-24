<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Order extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Order Grid');
        $content = $this->getLayout()->getContent();
        $orderGrid = Ccc::getBlock('Order_Grid');
        $content->addChild($orderGrid);
        $this->renderLayout();
    }

    public function saveOrderAction()
    {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');

        $customerId = $this->getRequest()->getRequest('id');
        if(!$customerId)
        {
            throw new Exception("Invalid Request.");
        }
        $customerModel = Ccc::getModel('Customer')->load($customerId);
        if(!$customerModel)
        {
            throw new Exception("Unable to load Data.");
        }
        $cartModel = $customerModel->getCart(); 
        $cartId = $cartModel->cartId;
        $cartItem = Ccc::getModel('Cart_Item');
        if(!$cartItem)
        {
            throw new Exception("Unable to load Data.");
        }
        $cartItems = $cartItem->fetchAll("SELECT c.itemId,p.name,c.quantity,p.price,pm.image AS baseImage from cart_item c LEFT JOIN product p on c.productId = p.productId LEFT join product_media pm on p.productId = pm.productId AND (pm.base = 1) WHERE c.cartId = {$cartId};");

        $total = 0;
        foreach ($cartItems as $cartItem) 
        {
            $mul = $cartItem->quantity * $cartItem->price;
            $total = $mul + $total;
        }

        $cartModel->total = $total;
        $cartModel->save();

        $cartItemModel = $cartModel->getCartItems();  
        $orderModel = $customerModel->getOrder();  
        $cartId = $cartModel->cartId;
        $cartBillingAddress = $cartModel->getBillingAddress();
        $cartShippingAddress = $cartModel->getShippingAddress();


        $totalTax = 0;
        foreach($cartItemModel as $value)
        {
            $totalTax = $totalTax + $value->taxAmount;
        }

        $totalDiscount = 0;
        foreach($cartItemModel as $value)
        {
            $totalDiscount = $totalDiscount + ($value->discount * $value->quantity);
        }

        
        $grandTotal = ($cartModel->total + $cartModel->shippingAmount + $totalTax) - $totalDiscount;

        //print_r($totalDiscount); die;

        if(!$orderModel)
        {
            $orderModel = Ccc::getModel('Order');

        }
        $orderModel->customerId = $customerId;
        $orderModel->firstName = $cartShippingAddress->firstName;
        $orderModel->lastName = $cartShippingAddress->lastName;
        $orderModel->mobile = $cartShippingAddress->mobile;
        $orderModel->email = $cartShippingAddress->email;
        $orderModel->taxAmount = $totalTax;
        $orderModel->grandTotal = $grandTotal;
        $orderModel->shippingMethodId = $cartModel->shippingMethodId;
        $orderModel->paymentMethodId = $cartModel->paymentMethodId;
        $orderModel->shippingAmount = $cartModel->shippingAmount;
        $orderModel->createdAt = $date;
        $orderModel->save();

        $orderBillingAddress = $orderModel->getBillingAddress();
        $orderShippingAddress = $orderModel->getShippingAddress();

        if(!$orderBillingAddress)
        {
            $orderBillingAddress = Ccc::getModel('Order_Address');
        }
        $orderBillingAddress->orderId = $orderModel->orderId;
        $orderBillingAddress->firstName = $cartBillingAddress->firstName;
        $orderBillingAddress->lastName = $cartBillingAddress->lastName;
        $orderBillingAddress->mobile = $cartBillingAddress->mobile;
        $orderBillingAddress->email = $cartBillingAddress->email;
        $orderBillingAddress->city = $cartBillingAddress->city;
        $orderBillingAddress->state = $cartBillingAddress->state;
        $orderBillingAddress->country = $cartBillingAddress->country;
        $orderBillingAddress->postalCode = $cartBillingAddress->postalCode;
        $orderBillingAddress->address = $cartBillingAddress->address;
        $orderBillingAddress->type = 1 ;
        $orderBillingAddress->createdAt = $date ;
        $orderBillingAddress->save() ;

        if(!$orderShippingAddress)
        {
            $orderShippingAddress = Ccc::getModel('Order_Address');
        }

        $orderShippingAddress->orderId = $orderModel->orderId;
        $orderShippingAddress->firstName = $cartShippingAddress->firstName;
        $orderShippingAddress->lastName = $cartShippingAddress->lastName;
        $orderShippingAddress->mobile = $cartShippingAddress->mobile;
        $orderShippingAddress->email = $cartShippingAddress->email;
        $orderShippingAddress->city = $cartShippingAddress->city;
        $orderShippingAddress->state = $cartShippingAddress->state;
        $orderShippingAddress->country = $cartShippingAddress->country;
        $orderShippingAddress->postalCode = $cartShippingAddress->postalCode;
        $orderShippingAddress->address = $cartShippingAddress->address;
        $orderShippingAddress->type = 2 ;
        $orderShippingAddress->createdAt = $date ;
        $orderShippingAddress->save() ;
        
        $orderItemModel = $orderModel->getOrderItem();
        if($orderItemModel)
        {
            foreach($orderItemModel as $value)
            {
                $query = "DELETE FROM `order_item` WHERE orderId = {$value->orderId};";
                $result = $this->getAdapter()->delete($query);       
            }
        }
        foreach($cartItemModel as $value)
        {
            $orderItemModel = Ccc::getModel('Order_Item');
            $productModel = $value->getProduct();
            $orderItemModel->orderId = $orderModel->orderId;
            $orderItemModel->productId = $productModel->productId;
            $orderItemModel->name = $productModel->name;
            $orderItemModel->sku = $productModel->sku;
            $orderItemModel->price = $productModel->price;
            $orderItemModel->cost = $productModel->cost;

            $discount = $productModel->discount;
            if($productModel->discountMode == 1)
            {
                $discount = ($productModel->price * $productModel->discount) / 100;
            }
            $orderItemModel->discount = $discount * $value->quantity;
            $orderItemModel->tax = $productModel->tax;
            $orderItemModel->taxAmount = ($productModel->price * $productModel->tax)/100 * $value->quantity;
            $orderItemModel->quantity = $value->quantity;
            $orderItemModel->createdAt = $date;
            $orderItemModel->save();
        }
    
        $message->addMessage('Order Added Successfully.');
        $this->redirect($this->getLayout()->getUrl('grid','order',null,true));
        
    }

    public function editAction()
    {
        $this->setTitle('Order Edit');
        $message = $this->getMessage();
        try
        {
            $orderId = (int)$this->getRequest()->getRequest('id');
            if (!$orderId)
            {
                throw new Exception('Edit is not working');
            }
            $order = Ccc::getModel('Order')->load($orderId);
            
            if (!$order) 
            {
                throw new Exception("Invalid Id.");
            }
            $content = $this->getLayout()->getContent();
            $orderEdit = Ccc::getBlock('Order_Edit')->setData(['order' => $order]);
            $content->addChild($orderEdit);
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'order', null, true));        
        }
    }

    public function saveAction()
    {
        $order = Ccc::getModel('order');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('order'); 
        $message = $this->getMessage();

        try
        {
            if (!$getSaveData)
            {
            throw new Exception('You can not insert data in order.');
            }

            $orderId = (int)$this->getRequest()->getRequest('id');
            $order = Ccc::getModel('order')->load($orderId);

            if(!$order)
            {
                $order = Ccc::getModel('order');
                $order->setData($getSaveData);
                $order->createdAt = $date;
            }
            else
            {
                $order->setData($getSaveData);
                $order->updatedAt = $date;
            }
                $result = $order->save();

            if (!$result) 
            {
                throw new Exception("System is not able to update.");
            } 
            else 
            {
                $message->addMessage('Data Saved.');
                $this->redirect($this->getLayout()->getUrl('grid', 'order', null, false));
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'order', ['id' => null], false));        
        }
    }

    public function viewAction()
    {
        $orderId = (int)$this->getRequest()->getRequest('id');
        $this->setTitle('Order Grid');
        $content = $this->getLayout()->getContent();
        $orderGrid = Ccc::getBlock('Order_View');
        $content->addChild($orderGrid);
        $this->renderLayout();
    }
}