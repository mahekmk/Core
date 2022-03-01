<?php /*$controllerCoreAction = new Controller_Core_Action();*/ ?>
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Add</title>
</head>
<body>
	<form action="<?php echo $controllerCoreAction->getUrl('save','admin',null,true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"><h2>Admin Information</h2> </td>
			</tr>
		
			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="admin[lastName]"></td>
			</tr>

			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="admin[email]"></td>
			</tr>

			<tr>
				<td width="10%">Password</td>
				<td><input type="password" name="admin[password]"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="admin[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
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
</html> -->