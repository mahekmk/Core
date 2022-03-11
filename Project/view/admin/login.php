<?php $controllerCoreAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login form</title>
</head>
<body>
	<br><br><br><br>
	<?php 
		$messages = $this->getMessages();
		if($messages) {
		    foreach ($messages as $key => $value) {
		        echo $value;
		    }
		} 
	?>
	<form action="<?php echo $controllerCoreAction->getUrl('loginPost') ?>" method="POST">
		<table border="1" width="100%">
			<tr>
				<th colspan="2">Login Page</th>
			</tr>
			<tr>
				<td >Email Address</td>
				<td><input type="email" name="admin[email]" required></td>
			</tr>
			<tr>
				<td >Password</td>
				<td><input type="password" name="admin[password]" required></td>
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td><input type="submit" name="login" value="Login"></td>
			</tr>
		</table>
	</form>
</body>
</html>