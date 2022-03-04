<?php $config = $this->getConfig(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Config edit</title>
</head>
<body>

<form action="<?php echo$controllerCoreAction->getUrl('save','config',['id' =>  $config->configId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Config Information</td>
			</tr>

			<tr>
				<td width="10%">config Id</td>
				<td><input type="text" name="config[id]" value="<?php echo $config->configId ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="config[name]" value="<?php echo $config->name ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Value</td>
				<td><input type="text" name="config[value]" value="<?php echo $config->value ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="config[code]" value="<?php echo $config->code ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="config[status]" value="<?php echo $config->status; ?>">
						<?php foreach ($config->getStatus() as $key => $value): ?>
              			<option <?php if($config->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>


			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>