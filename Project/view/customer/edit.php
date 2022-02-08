<?php
require_once('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();
if($_GET['id'])
{
$id = $_GET['id'];
$data = $adapter->fetchRow("SELECT c.*, a.* FROM customer c LEFT JOIN address a ON c.customerId = a.customerId WHERE c.customerID = '$id'");
 
 		$firstName = $data['firstName'];
 		$lastName = $data['lastName'];
 		$email = $data['email'];
 		$mobile = $data['mobile'];
 		$status = $data['status'];
 		$address = $data['address'];
 		$postalCode = $data['postalCode'];
 		$city = $data['city'];
 		$state = $data['state'];
 		$country = $data['country'];
 		$billingAddress = $data['billingAddress'];
 		$shippingAddress = $data['shippingAddress'];
}
?>
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
				<td><input type="hidden" name="customer[id]" value="<?php echo $id ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="customer[email]" value="<?php echo $email ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">mobile</td>
				<td><input type="number" name="customer[mobile]" value="<?php echo $mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="customer[status]" value="<?php echo $status; ?>">
						<option value="1"  <?php if($status== 1):?>  selected="selected" <?php endif; ?>>Active</option>
						<option value="2"  <?php if($status== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]" value="<?php echo $address ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]" value="<?php echo $postalCode ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]" value="<?php echo $city ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]" value="<?php echo $state ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $country ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Address Type</td>
				<td><input type="checkbox" name="address[billingAddress]" value="1" <?php if($billingAddress == 1):?>  checked <?php endif; ?>>Billing Address
				<input type="checkbox" name="address[shippingAddress]" value="1" <?php if($shippingAddress == 1):?>  checked <?php endif; ?>>Shipping Address</td>

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