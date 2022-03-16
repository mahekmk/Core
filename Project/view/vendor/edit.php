
<?php $vendorAddress = $this->getVendorAddress(); //print_r($vendorAddress); die;?>
<?php $vendor = $vendorAddress['vendor']; //print_r($vendor); die;?>
<?php $address = $vendorAddress['vendorAddress']; //print_r($vendorAddress); die;?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

	<form action="<?php echo$controllerCoreAction->getUrl('save','vendor',['id' =>  $vendor->vendorId],false) ?>" method="POST">
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
					<button type="button"><a href=" <?php echo $controllerCoreAction->getUrl('grid','vendor',null,true) ?>">Cancel</a></button>
				</td>
			</tr>

		</table>
	</form>
