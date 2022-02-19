<?php $products = $this->getProducts(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
	<body>
		<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
		<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','product',null,true) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Product Id</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$products): ?>
				<tr>
					<td colspan="10">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product['productId']?></td>
					<td><?php echo $product['name']?></td>
					<td><?php echo $product['price']?></td>
					<td><?php echo $product['quantity']?></td>
					<td><?php echo $product['status']?></td>
					<td><?php echo $product['createdAt']?></td>
					<td><?php echo $product['updatedAt']?></td>
					<td><a href="<?php echo$controllerCoreAction->getUrl('edit','product',['id' =>  $product['productId']],true) ?>">Edit</a></td>
					<td><a href="<?php echo$controllerCoreAction->getUrl('delete','product',['id' =>  $product['productId']],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>