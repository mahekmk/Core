<?php $address = $this->getVendorAddress(); ?>

<table border="1" width="100%" cellspacing="4">

	<tr>
		<td width="10%">Address Id</td>
		<td><input type="text" name="address[addressId]" value="<?php echo $address->addressId; ?>" placeholder="Not for user." readonly></td>
	</tr>

	<tr>
		<td width="10%">Address</td>
		<td><input type="text" name="address[address]" value="<?php echo $address->address ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">Postal Code</td>
		<td><input type="text" name="address[postalCode]" value="<?php echo $address->postalCode ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">City</td>
		<td><input type="text" name="address[city]" value="<?php echo $address->city ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">State</td>
		<td><input type="text" name="address[state]" value="<?php echo $address->state ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">Country</td>
		<td><input type="text" name="address[country]" value="<?php echo $address->country ; ?>"></td>
	</tr>

	<tr>
		<td width="10%">&nbsp;</td>
		<td>
			<input type="submit" name="submit" value="Save">
			<button type="button"><a href=" <?php echo $this->getUrl('grid','vendor',null,true) ?>">Cancel</a></button>
		</td>
	</tr>

</table>