<?php
/*$categories = $this->getData('categories');*/
$controllerCategory = new Controller_Category();

?>

<html>
<head>
	<body>
		<button name='Admin'><a href="index.php?c=admin&a=grid">Admin</a></button>
		<button name='Customer'><a href="index.php?c=customer&a=grid">Customer</a></button>
		<button name='Category'><a href="">Category</a></button>
		<button name='Product'><a href="index.php?c=product&a=grid">Product</a></button>
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
			<?php if(!$data['categories']): ?>
				<tr>
					<td colspan="9">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($data['categories'] as $category): ?>
				<tr>
					<td><?php echo $category['categoryId']?></td>
					<td>
						<?php $result = $controllerCategory->getCategoryWithPath();
		    				echo $result[$category['categoryId']];
			    		?>
					</td>
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