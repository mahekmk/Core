<?php  $controllerCoreAction = new Controller_Core_Action(); ?>

<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
<button name='Config'><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>">Config</a></button>
<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
<button name='Salesman'><a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>">Salesman</a></button>
<button name='Page'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',null,true) ?>">Page</a></button>
<button name='Vendor'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',null,true) ?>">Vendor</a></button>
<br>
<br>