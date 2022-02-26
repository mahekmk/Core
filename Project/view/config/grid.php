<?php $configs = $this->getConfigs(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<html>
<head>
	<body>
		<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
		<button name='Config'><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>">Config</a></button>
		<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','config',null,true) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Config Id</th>
				<th>Name</th>
				<th>Value</th>
				<th>Code</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$configs): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($configs as $config): ?>
				<tr>
					<td><?php echo $config->configId;?></td>
					<td><?php echo $config->name;?></td>
					<td><?php echo $config->value;?></td>
					<td><?php echo $config->code;?></td>
					<td><?php echo $config->status;?></td>
					<td><?php echo $config->createdAt;?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','config',['id'=> $config->configId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','config',['id'=> $config->configId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>