<?php $vendorAddresses = $this->getVendorAddresses(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

		<h1 align="center"> Vendor Information </h1>		
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add') ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Vendor Id</th>
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
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$vendorAddresses): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($vendorAddresses as $vendor): ?>
				<tr>
					<td><?php echo $vendor->vendorId;?></td>
					<td><?php echo $vendor->firstName;?></td>
					<td><?php echo $vendor->lastName;?></td>
					<td><?php echo $vendor->email;?></td>
					<td><?php echo $vendor->mobile;?></td>
					<td><?php echo $vendor->getStatus($vendor->status); ?></td>
					<td><?php echo $vendor->createdAt;?></td>
					<td><?php echo $vendor->updatedAt;?></td>
					<td><?php echo $vendor->addressId;?></td>
					<td><?php echo $vendor->address;?></td>
					<td><?php echo $vendor->postalCode;?></td>
					<td><?php echo $vendor->city;?></td>
					<td><?php echo $vendor->state;?></td>
					<td><?php echo $vendor->country;?></td>
					<td><a href="index.php?c=vendor&a=edit&id=<?php echo $vendor->vendorId; ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','vendor',['id'=> $vendor->vendorId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
