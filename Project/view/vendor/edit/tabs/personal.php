<?php $vendor = $this->getVendor(); ?>

<table border="1" width="100%" cellspacing="4">
	<tr>
		<td colspan="2"> Vendor Information</td>
	</tr>

	<tr>
		<td width="10%">Vendor Id</td>
		<td><input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId; ?>" placeholder="Not for user." readonly></td>
	</tr>

	<tr>
		<td width="10%">First Name</td>
		<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ; ?>" ></td>
	</tr>

	<tr>
		<td width="10%">Last Name</td>
		<td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName ;?>"></td>
	</tr>

	<tr>
		<td width="10%">email</td>
		<td><input type="email" name="vendor[email]" value="<?php echo $vendor->email ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">mobile</td>
		<td><input type="number" name="vendor[mobile]" value="<?php echo $vendor->mobile ;?>"></td>
	</tr>

	<tr>
		<td width="10%">Status</td>
		<td>
			<select name="vendor[status]" >
				<?php foreach ($vendor->getStatus() as $key => $value): ?>
      			<option <?php if($vendor->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
    			<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td><button type="submit" class="cancelbtn">Next</button></td>
		<td><button type="button"><a href=" <?php echo $this->getUrl('grid','vendor',null,true) ?>">Cancel</a></button></td>
	</tr>
</table>
