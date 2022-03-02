<?php $salesman = $this->getSalesman(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Salesman edit</title>
</head>
<body>

<form action="<?php echo$controllerCoreAction->getUrl('save','salesman',['id' =>  $salesman->salesmanId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> salesman Information</td>
			</tr>

			<tr>
				<td width="10%">salesman Id</td>
				<td><input type="text" name="salesman[id]" value="<?php echo $salesman->salesmanId ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Mobile</td>
				<td><input type="number" name="salesman[mobile]" value="<?php echo $salesman->mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="salesman[email]" value="<?php echo $salesman->email ; ?>"></td>
			</tr>


			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="salesman[status]" >
						 <?php if($salesman->status == 2): ?>
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
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>