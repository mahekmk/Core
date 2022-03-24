<?php $order = $this->getOrder(); //print_r($order); die;?>
<?php $customer = $this->getCustomer(); //print_r($order); die;?>
<?php $orderAddress = $this->getOrderAddress(); //print_r($orderAddress); die;?>
<?php $orderItems = $this->getOrderItems(); //print_r($orderItems); die;?>
<?php $shippingMethod = $this->getShippingMethod(); //print_r($order); die;?>
<?php $paymentMethod = $this->getPaymentMethod(); //print_r($order); die;?>
<?php $billingAddress = $this->getBillingAddress(); //print_r($billingAddress); die;?>
<?php $shippingAddress = $this->getShippingAddress(); //print_r($shippingAddress); die;?>
<?php $products = $this->getProducts(); //print_r($product); die;?>
<?php $mediaModel = Ccc::getModel('Product_Media'); ?>

<h2>Customer Details <h2>
<table border=1 width=100%>
    <tr>
        <th> Id </th>
        <th> First Name </th>
        <th> Last Name </th>
        
    </tr>
    <?php if($customer):?>
            <tr>
                <td><?php echo $customer->customerId ?></td>
                <td><?php echo $customer->firstName ?></td>
                <td><?php echo $customer->lastName ?></td>
                
    <?php else:?>
        <tr><td colspan='10'>No Record Available</td></tr>          
    <?php endif; ?>
</table>
<hr>
<table border="1" width="100%">
    <tr>
        <th colspan="2"><h2>Shipping Method</h2></th>
        <th><h2>Payment Method</h2></th>
    </tr>
    <tr>
        <td><?php echo $shippingMethod->name; ?></td>
        <td><?php echo "₹" ." ".$shippingMethod->price; ?></td>
        <td><?php echo $paymentMethod->name; ?></td>
    </tr>

</table>

<hr>
<table border="1" width="100%">
    <tr>
        <th><h2>Billing Details</h2></th>
        <th><h2>Shipping Details</h2></th>
    </tr>
    <tr>
        <td>
                <?php echo $billingAddress->firstName ." ". $billingAddress->lastName?>
            <br><?php echo $billingAddress->address ?>
            <br><?php echo $billingAddress->city ."-". $billingAddress->postalCode ?>
            <br><?php echo $billingAddress->state ?>
            <br><?php echo $billingAddress->country ?>
            <br><?php echo $billingAddress->phone ?>
        </td>
        <td>
                <?php echo $shippingAddress->firstName ." ". $shippingAddress->lastName?>
            <br><?php echo $shippingAddress->address ?>
            <br><?php echo $shippingAddress->city ."-". $shippingAddress->postalCode ?>
            <br><?php echo $shippingAddress->state ?>
            <br><?php echo $shippingAddress->country ?>
            <br><?php echo $shippingAddress->phone ?>
        </td>
    </tr>

</table>
<hr>

<table border="1" width="100%">
    <tr>
        <th><h2>Product Details</h2></th>
    </tr>
        <?php foreach ($orderItems as $orderItem): ?>
    <tr>
        <td width="25%">
            <?php if(!$orderItem->image): echo "No Image." ?>
                <?php else: ?>
            <img src="<?php echo $mediaModel->getImageUrl() . $orderItem->image; ?>" width="75px" height="75px">
            <?php endif;?>
                    </td>
        <td>
            <?php echo $orderItem->name;?><br>
            <?php echo $orderItem->sku;?><br>
            <?php echo "₹" ." ".$orderItem->price;?><br>
            <?php echo "Quantity: " .$orderItem->quantity;?><br>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<hr>

<?php $cartItems = $this->getCartItems(); //print_r($cartItems); die; ?>
<?php $cart = $this->getCart(); //print_r($cart); die; ?>
<?php $totalDiscount = 0; ?>
<?php foreach ($cartItems as $cartItem)
    {
        $totalDiscount = $totalDiscount + $cartItem->discount;
        //print_r($totalDiscount); die;
    } 
?>
<h2>Order Details</h2>
<table border="1" width="100%" cellspacing="4">
<?php if(!$cartItems):?>
    <tr>
        <th>Sub Total</th>
        <td>0</td>
    </tr>
    <tr>
        <th>Shipping Amount</th>
        <td>0</td>
    </tr>
    <tr>
        <th>Tax</th>
        <td>0</td>
    </tr>
    <tr>
        <th>Discount</th>
        <td>0</td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td>0</td>
    </tr>
    <?php else:?>
    <tr>
        <th>Sub Total</th>
        <td>
            <?php $total = 0;?>
            <?php foreach ($cartItems as $cartItem) 
            {
            $priceTotal = $cartItem->quantity * $cartItem->price;
            $total = $priceTotal + $total;
            }
            ?>
            <?php echo "₹" ." ".$total;?>
        </td>
    </tr>
    <tr>
        <th>Shipping Amount</th>
        <td>
            <?php echo "₹" ." ".$cart->shippingAmount?>
        </td>
    </tr>
    <tr>
        <th>Tax</th>
        <td>
            <?php $taxTotal = 0;?>
            <?php foreach ($cartItems as $cartItem) 
                {
                    $taxTotal = $taxTotal + $cartItem->taxAmount;
                }
                ?>
            <?php echo "₹" ." ".$taxTotal;?>
        </td>
    </tr>
    <tr>
        <th>Discount</th>
        <td><?php echo "₹" ." ".$totalDiscount ?></td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td>
            <?php echo "₹" ." ".($total + $cart->shippingAmount + $taxTotal - $totalDiscount); ?>
        </td>
    </tr>
        <?php endif; ?>
    
</table>
<hr>
    <button type="button"><a href="<?php echo $this->getUrl('grid','order',null,true) ?>">Back To Orders</a></button>