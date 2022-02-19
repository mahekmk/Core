<?php $customerAddresses = $this->getCustomerAddresses(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>
<html>
<head>
	<body>
		<button name='Admin'><a href="index.php?c=admin&a=grid">Admin</a></button>
		<button name='Customer'><a href="">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('add','customer',null,true) ?>">Category</a></button>
		<button name='Product'><a href="index.php?c=product&a=grid">Product</a></button>
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
			<?php if(!$customerAddresses): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($customerAddresses as $customer): ?>
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
					<td><?php echo $customer['billing']?></td>
					<td><?php echo $customer['shipping']?></td>
					<td><a href="index.php?c=customer&a=edit&id=<?php echo $customer['customerId'] ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','customer',['id'=> $customer['customerId']],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>