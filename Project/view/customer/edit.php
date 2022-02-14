<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer edit</title>
</head>
<body>
	<form action="index.php?c=customer&a=save&id=<?php echo $_GET['id']?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Customer Information</td>
			</tr>

			<tr>
				<td width="10%">Customer Id</td>
				<td><input type="text" name="customer[id]" value="<?php echo $data['customerAddresses']['customerId']; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $data['customerAddresses']['firstName'] ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $data['customerAddresses']['lastName'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="customer[email]" value="<?php echo $data['customerAddresses']['email'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">mobile</td>
				<td><input type="number" name="customer[mobile]" value="<?php echo $data['customerAddresses']['mobile'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="customer[status]" value="<?php echo $data['customerAddresses']['status']; ?>">
						<option value="1"  <?php if($data['customerAddresses']['status']== 1):?>  selected="selected" <?php endif; ?>>Active</option>
						<option value="2"  <?php if($data['customerAddresses']['status']== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]" value="<?php echo $data['customerAddresses']['address'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]" value="<?php echo $data['customerAddresses']['postalCode'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]" value="<?php echo $data['customerAddresses']['city'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]" value="<?php echo $data['customerAddresses']['state'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $data['customerAddresses']['country'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Address Type</td>
				<td><input type="checkbox" name="address[billingAddress]" value="1" <?php if($data['customerAddresses']['billingAddress'] == 1):?>  checked <?php endif; ?>>Billing Address
					<input type="checkbox" name="address[shippingAddress]" value="1" <?php if($data['customerAddresses']['shippingAddress'] == 1):?>  checked <?php endif; ?>>Shipping Address</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" index.php?c=customer&a=grid">Cancel</a></button>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>