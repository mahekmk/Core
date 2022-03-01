<?php $product = $this->getProduct(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product edit</title>
</head>
<body>

<form action="<?php echo$controllerCoreAction->getUrl('save','product',['id' =>  $product->productId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Product Information</td>
			</tr>

			<tr>
				<td width="10%">Product Id</td>
				<td><input type="text" name="product[id]" value="<?php echo $product->productId  ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $product->name ;?>" ></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo  $product->price  ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $product->quantity  ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="product[status]" value="<?php echo $product->status;?>">
						<?php if($product->status == 2): ?>
				              <option value='2'>InActive</option>
				              <option value='1'>Active</option>
				          <?php else: ?>
				              <option value='1'>Active</option>
				              <option value='2'>InActive</option>
				          <?php endif;?>
					</select>
				</td>
			</tr>

			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>