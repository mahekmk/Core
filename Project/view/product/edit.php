<?php $product = $this->getProduct(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product edit</title>
</head>
<body>

<form action="index.php?c=product&a=save&id=<?php echo $product['productId']?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Product Information</td>
			</tr>

			<tr>
				<td width="10%">Product Id</td>
				<td><input type="text" name="product[id]" value="<?php echo $product['productId'] ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $product['name'];?>" ></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo  $product['price'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $product['quantity'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="product[status]" value="<?php $product['status']; ?>">
						<option value="1" <?php if($product['status']== 1):?>  selected="selected" <?php endif; ?>>Active</option>
						<option value="2" <?php if($product['status']== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" index.php?c=product&a=grid">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>