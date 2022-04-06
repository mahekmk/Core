
<?php

Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
	protected $billingAddress;
    protected $shippingAddress;
    protected $salesman;
    protected $price;
    protected $cart = null;
    protected $order = null;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';
	

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
	}

	public function getStatus($key = null)
	{		
		
		$statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
					self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

		if(!$key)
		{
			return $statues;
		}

		if(array_key_exists($key , $statues))
		{
			return $statues[$key];
		}

		return self::STATUS_DEFAULT;
	}

	public function saveSalesmanInfo($customerIds)
	{
		$salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
		
		foreach ($customerIds as $customerId) 
		{		
			$customer = Ccc::getModel('customer');
			$customer->customerId = $customerId;
			$customer->salesmanId = $salesmanId;
			$result = $customer->save();

		}
		return $result;
	}


    public function getBillingAddress($reload = false)
    {
        /*echo "<pre>";
        print_r($this->id);*/
        $addressModel = Ccc::getModel('Customer_Address');
        if(!$this->customerId)
        {
            //echo 22;
            return $addressModel;
        }
        if($this->billingAddress && !$reload)
        {
            //echo 33;
            return $this->billingAddress;
        }

        $address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customerId` = {$this->customerId} AND `billing` = 1");
        if(!$address)
        {
            return $addressModel;
        }

        $this->setBillingAddress($address);
        //print_r($this->billingAddress);
        return $this->billingAddress;
    }

    public function setBillingAddress(Model_Customer_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getShippingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        if(!$this->customerId)
        {
            return $addressModel;
        }
        if($this->shippingAddress && !$reload)
        {
            return $this->shippingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customerId` = {$this->customerId} AND `shipping` = 1");
        if(!$address)
        {
            return $addressModel;
        }

        $this->setShippingAddress($address);
        return $this->shippingAddress;
    }

    public function setShippingAddress(Model_Customer_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getSalesman($reload = false)
    {
        $salesmanModel = Ccc::getModel('Salesman');
        
        if(!$this->salesmanId)
        {
            return $salesmanModel;
        }

        if($this->salesman && !$reload)
        { 
            return $this->salesman;
        }
        $salesman = $salesmanModel->fetchAll("SELECT * from salesman WHERE salesmanId = {$this->salesmanId}");
        if(!$salesman)
        {
            return $salesmanModel;
        }
        $this->setsalesman($salesman);
        return $salesman;
    }

    public function setsalesman(Model_salesman $salesman)
    {
        $this->salesman = $salesman;
        return $this;
    }

    public function getPrice($reload = false)
    {
        $priceModel = Ccc::getModel('Customer_Price');
        
        if(!$this->entityId)
        {
            echo 11;
            return $priceModel;
        }

        if($this->price && !$reload)
        { 
            echo 22 ;
            return $this->price;
        }
        $price = $priceModel->fetchAll("SELECT * from customer_price WHERE entityId = {$this->priceId}");
        if(!$price)
        {
            return $priceModel;
        }
        $this->setprice($price);
        return $price;
    }

    public function setprice(Model_price $price)
    {
        $this->price = $price;
        return $this;
    }

    public function getCart($reload = false)
    {
        $cartModel = Ccc::getModel('Cart');
        
        if(!$this->customerId)
        {
            return $cartModel;
        }

        if($this->cart && !$reload)
        { 
            return $this->cartModel;
        }

        $cart = $cartModel->fetchRow("SELECT * from cart WHERE customerId = {$this->customerId};");
        if(!$cart)
        {
            return $this->cartModel;
        }
        $this->setCart($cart);
        return $cart;
    }

    public function setCart(Model_Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getOrder($reload = false)
    {
       // print_r($this);
        $orderModel = Ccc::getModel('Order');
        
        if(!$this->customerId)
        {
            return $orderModel;
        }

        if($this->order && !$reload)
        { 
            return $this->orderModel;
        }

        $order = $orderModel->fetchRow("SELECT * from orders WHERE customerId = {$this->customerId};");
        if(!$order)
        {
            return $this->orderModel;
        }
        $this->setorder($order);
        return $order;
    }

    public function setorder(Model_order $order)
    {
        $this->order = $order;
        return $this;
    }


}


