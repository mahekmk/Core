<?php require_once('Model/Core/Adapter.php') ?>
<?php 
$adapter = new Model_Core_Adapter();
$products = $adapter->fetchAll("SELECT * FROM product");
?>

<html>
<head>
	<body>
		<button name='Add'><a href="index.php?c=product&a=add">Add</a></button>
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
					<td><a href="index.php?c=product&a=edit&id=<?php echo $product['productId'] ?>">Edit</a></td>
					<td><a href="index.php?c=product&a=delete&id=<?php echo $product['productId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>