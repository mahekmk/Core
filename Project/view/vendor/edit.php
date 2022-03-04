<?php $vendorAddress = $this->getVendorAddress(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>vendor edit</title>
</head>
<body>
	<form action="<?php echo$controllerCoreAction->getUrl('save','vendor',['id' =>  $vendorAddress->vendorId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Vendor Information</td>
			</tr>

			<tr>
				<td width="10%">Vendor Id</td>
				<td><input type="text" name="vendor[id]" value="<?php echo $vendorAddress->vendorId; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="vendor[firstName]" value="<?php echo $vendorAddress->firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="vendor[lastName]" value="<?php echo $vendorAddress->lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="vendor[email]" value="<?php echo $vendorAddress->email ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">mobile</td>
				<td><input type="number" name="vendor[mobile]" value="<?php echo $vendorAddress->mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="vendor[status]" >
						<?php foreach ($vendorAddress->getStatus() as $key => $value): ?>
              			<option <?php if($vendorAddress->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">Address Id</td>
				<td><input type="text" name="address[id]" value="<?php echo $vendorAddress->addressId; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]" value="<?php echo $vendorAddress->address ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]" value="<?php echo $vendorAddress->postalCode ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]" value="<?php echo $vendorAddress->city ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]" value="<?php echo $vendorAddress->state ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $vendorAddress->country ; ?>"></td>
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
</body>
</html>