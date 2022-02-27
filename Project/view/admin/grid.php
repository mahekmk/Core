<?php $admins = $this->getAdmins(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<html>
<head>
	<body>
		<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
		<button name='Config'><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>">Config</a></button>
		<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','admin',null,true) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>admin Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$admins): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($admins as $admin): ?>
				<tr>
					<td><?php echo $admin->adminId;?></td>
					<td><?php echo $admin->firstName;?></td>
					<td><?php echo $admin->lastName;?></td>
					<td><?php echo $admin->email;?></td>
					<td><?php echo $admin->getStatus($admin->status); ?></td>
					<td><?php echo $admin->createdAt;?></td>
					<td><?php echo $admin->updatedAt;?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','admin',['id'=> $admin->adminId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','admin',['id'=> $admin->adminId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>