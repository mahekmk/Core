<?php
/*require_once('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();
if($_GET['id'])
{
$id = $_GET['id'];
$data = $adapter->fetchRow("SELECT * FROM admin  WHERE adminId = '$id'");
 
 		$firstName = $data['firstName'];
 		$lastName = $data['lastName'];
 		$email = $data['email'];
 		$password = $data['password'];
 		$status = $data['status'];
 	}*/

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin edit</title>
</head>
<body>

<form action="index.php?c=admin&a=save&id=<?php echo $_GET['id']?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Admin Information</td>
			</tr>

			<tr>
				<td width="10%">Admin Id</td>
				<td><input type="text" name="admin[id]" value="<?php echo $data['admins']['adminId'] ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $data['admins']['firstName'] ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $data['admins']['lastName'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="admin[email]" value="<?php echo $data['admins']['email'] ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">password</td>
				<td><input type="password" name="admin[password]" value="<?php echo $data['admins']['password'] ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="admin[status]" value="<?php echo $data['admins']['status']; ?>">
						<option value="1"  <?php if( $data['admins']['status']== 1):?>  selected="selected" <?php endif; ?>>Active</option>
						<option value="2"  <?php if($data['admins']['status']== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>


			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" index.php?c=admin&a=grid">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>