<?php // $controllerCoreAction = new Controller_Core_Action(); ?>

<button name='Admin'><a href="<?php echo $this->getUrl('grid','admin',null,true) ?>">Admin</a></button>
<button name='Category'><a href="<?php echo $this->getUrl('grid','category',null,true) ?>">Category</a></button>
<button name='Config'><a href="<?php echo $this->getUrl('grid','config',null,true) ?>">Config</a></button>
<button name='Customer'><a href="<?php echo $this->getUrl('grid','customer',null,true) ?>">Customer</a></button>
<button name='Order'><a href="<?php echo $this->getUrl('grid','order',null,true) ?>">Order</a></button>
<button name='PaymentMethod'><a href="<?php echo $this->getUrl('grid','paymentMethod',null,true) ?>">Payment Method</a></button>
<button name='Page'><a href="<?php echo $this->getUrl('grid','page',null,true) ?>">Page</a></button>
<button name='Product'><a href="<?php echo $this->getUrl('grid','product',null,true) ?>">Product</a></button>
<button name='Salesman'><a href="<?php echo $this->getUrl('grid','salesman',null,true) ?>">Salesman</a></button>
<button name='ShippingMethod'><a href="<?php echo $this->getUrl('grid','shippingMethod',null,true) ?>">Shipping Method</a></button>
<button name='Vendor'><a href="<?php echo $this->getUrl('grid','vendor',null,true) ?>">Vendor</a></button>
<button name='Logout'><a href="<?php echo $this->getUrl('logout','admin_login',null,true) ?>">Logout</a></button>
<br>
<br>