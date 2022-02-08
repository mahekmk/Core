<?php require_once('Model/Core/Adapter.php') ?>
<?php 
$adapter = new Model_Core_Adapter();
$categories = $adapter->fetchAll("SELECT * FROM category");
?>

<html>
<head>
	<body>
		<button name='Add'><a href="index.php?c=category&a=add">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Category Id</th>
				<th>Name</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$categories): ?>
				<tr>
					<td colspan="9">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category['categoryId']?></td>
					<td><?php echo $category['name']?></td>
					<td><?php echo $category['status']?></td>
					<td><?php echo $category['createdAt']?></td>
					<td><?php echo $category['updatedAt']?></td>
					<td><a href="index.php?c=category&a=edit&id=<?php echo $category['categoryId'] ?>">Edit</a></td>
					<td><a href="index.php?c=category&a=delete&id=<?php echo $category['categoryId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>