<?php $categories = $this->getCategories(); ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<html>
<head>
	<body>
		<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
		<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','category',null,true) ?>">Add</a></button>
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
						<?php $result = $getCategoryWithPath; 
		    				echo $result[$category['categoryId']];
			    		?>
					</td>
					<td><?php echo $category['status']?></td>
					<td><?php echo $category['createdAt']?></td>
					<td><?php echo $category['updatedAt']?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','category',['categoryId'=> $category['categoryId']],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','category',['categoryId'=> $category['categoryId']],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>