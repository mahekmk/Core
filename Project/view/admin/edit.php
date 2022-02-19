<?php $admin = $this->getAdmin(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin edit</title>
</head>
<body>

<form action="<?php echo$controllerCoreAction->getUrl('save','admin',['id' =>  $admin['adminId']],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Admin Information</td>
			</tr>

			<tr>
				<td width="10%">Admin Id</td>
				<td><input type="text" name="admin[id]" value="<?php echo $admin['adminId'] ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $admin['firstName'] ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $admin['lastName'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="admin[email]" value="<?php echo $admin['email'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">password</td>
				<td><input type="password" name="admin[password]" value="<?php echo $admin['password'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="admin[status]" value="<?php echo $admin['status']; ?>">
						<option value="1"  <?php if( $admin['status']== 1):?>  selected="selected" <?php endif; ?>>Active</option>
						<option value="2"  <?php if($admin['status']== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>


			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>