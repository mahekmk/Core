<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Category Add</title>
</head>
<body>
	<form action="index.php?c=category&a=save" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Category Information</td>
			</tr>
			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]"></td>
			</tr>


			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="category[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="index.php?c=category&a=grid">Cancel</a></button>
				</td>
			</tr>
		</table>



	</form>

</body>
</html>