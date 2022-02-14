
<?php //require_once('Model/Core/Adapter.php') ?>
<?php 
/*$adapter = new Model_Core_Adapter();
$admins = $adapter->fetchAll("SELECT * FROM admin");*/

?>

<html>
<head>
	<body>
		<button name='Admin'><a href="">Admin</a></button>
		<button name='Customer'><a href="index.php?c=customer&a=grid">Customer</a></button>
		<button name='Category'><a href="index.php?c=category&a=grid">Category</a></button>
		<button name='Product'><a href="index.php?c=product&a=grid">Product</a></button>
		<button name='Add'><a href="index.php?c=admin&a=add">Add</a></button>
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
			<?php if(!$data['admins']): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($data['admins'] as $admin): ?>
				<tr>
					<td><?php echo $admin['adminId']?></td>
					<td><?php echo $admin['firstName']?></td>
					<td><?php echo $admin['lastName']?></td>
					<td><?php echo $admin['email']?></td>
					<td><?php echo $admin['status']?></td>
					<td><?php echo $admin['createdAt']?></td>
					<td><?php echo $admin['updatedAt']?></td>
					<td><a href="index.php?c=admin&a=edit&id=<?php echo $admin['adminId'] ?>">Edit</a></td>
					<td><a href="index.php?c=admin&a=delete&id=<?php echo $admin['adminId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>