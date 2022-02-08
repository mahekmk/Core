<?php require_once('Model/Core/Adapter.php') ?>
<?php 
$adapter = new Model_Core_Adapter();
$customers = $adapter->fetchAll("SELECT c.*, a.* FROM customer c LEFT JOIN address a ON c.customerId = a.customerId");
//$customers = $adapter->fetchAll("SELECT c.* , a.* FROM customer c  ");
?>

<html>
<head>
	<body>
		<button name='Add'><a href="index.php?c=customer&a=add">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Customer Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Address Id</th>
				<th>Address</th>
				<th>Postal Code</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>Billing Address</th>
				<th>Shipping Address</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$customers): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($customers as $customer): ?>
				<tr>
					<td><?php echo $customer['customerId']?></td>
					<td><?php echo $customer['firstName']?></td>
					<td><?php echo $customer['lastName']?></td>
					<td><?php echo $customer['email']?></td>
					<td><?php echo $customer['mobile']?></td>
					<td><?php echo $customer['status']?></td>
					<td><?php echo $customer['createdAt']?></td>
					<td><?php echo $customer['updatedAt']?></td>
					<td><?php echo $customer['addressId']?></td>
					<td><?php echo $customer['address']?></td>
					<td><?php echo $customer['postalCode']?></td>
					<td><?php echo $customer['city']?></td>
					<td><?php echo $customer['state']?></td>
					<td><?php echo $customer['country']?></td>
					<td><?php echo $customer['billingAddress']?></td>
					<td><?php echo $customer['shippingAddress']?></td>
					<td><a href="index.php?c=customer&a=edit&id=<?php echo $customer['customerId'] ?>">Edit</a></td>
					<td><a href="index.php?c=customer&a=delete&id=<?php echo $customer['customerId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>