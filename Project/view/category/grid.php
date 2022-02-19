<?php $categories = $this->getCategories(); ?>
<?php $controllerCategory = new Controller_Category(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>



<html>
<head>
	<body>
		<button name='Admin'><a href="index.php?c=admin&a=grid">Admin</a></button>
		<button name='Customer'><a href="index.php?c=customer&a=grid">Customer</a></button>
		<button name='Category'><a href="">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('add','category',null,true) ?>">Product</a></button>
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
					<td>
						<?php $result = $controllerCategory->getCategoryWithPath();
		    				echo $result[$category['categoryId']];
			    		?>
					</td>
					<td><?php echo $category['status']?></td>
					<td><?php echo $category['createdAt']?></td>
					<td><?php echo $category['updatedAt']?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','category',['id'=> $category['categoryId']],true) ?>">Edit</a></td>
					<td><a href="index.php?c=category&a=delete&id=<?php echo $category['categoryId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>