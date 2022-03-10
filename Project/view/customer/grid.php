<?php $customerAddresses = $this->getCustomerAddresses(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

		<h1 align="center"> Customer Information </h1>	
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','customer',null,true) ?>">Add</a></button>
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
					<td><?php echo $customer->customerId;?></td>
					<td><?php echo $customer->firstName;?></td>
					<td><?php echo $customer->lastName;?></td>
					<td><?php echo $customer->email;?></td>
					<td><?php echo $customer->mobile;?></td>
					<td><?php echo $customer->getStatus($customer->status); ?></td>
					<td><?php echo $customer->createdAt;?></td>
					<td><?php echo $customer->updatedAt;?></td>
					<td><?php echo $customer->addressId;?></td>
					<td><?php echo $customer->address;?></td>
					<td><?php echo $customer->postalCode;?></td>
					<td><?php echo $customer->city;?></td>
					<td><?php echo $customer->state;?></td>
					<td><?php echo $customer->country;?></td>
					<td><?php echo $customer->billing;?></td>
					<td><?php echo $customer->shipping;?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','customer',['id'=> $customer->customerId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','customer',['id'=> $customer->customerId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
