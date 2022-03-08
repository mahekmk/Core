<?php $categories = $this->getCategories(); ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<h1 align="center"> Category Information </h1>		
<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add') ?>">Add</a></button>
<table border="1" width="100%" cellspacing="4">
	<tr>
		<th>Category Id</th>
		<th>Name</th>
		<th>Status</th>
		<th>Created Date</th>
		<th>Updated Date</th>
		<th>Base</th>
		<th>Small</th>
		<th>Thumb</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Media</th>
	</tr>
	<?php if(!$categories): ?>
		<tr>
			<td colspan="9">No Record available.</td>
		</tr>
	<?php else : ?>
		<?php foreach ($categories as $category): ?>
		<tr>
			<td><?php echo $category->categoryId?></td>
			<td>
				<?php $result = $getCategoryWithPath; 
    				echo $result[$category->categoryId];
	    		?>
			</td>
			<td><?php echo $category->getStatus($category->status); ?></td>
			<td><?php echo $category->createdAt?></td>
			<td><?php echo $category->updatedAt?></td>
			<td>
				<?php if(!$category->baseImage): echo "No image Selected"?>
				<?php else:?><img src="<?php echo 'Media/category/' . $category->baseImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?>
			</td>
			<td><?php if(!$category->smallImage): echo "No image Selected"?>
				<?php else:?><img src="<?php echo 'Media/category/' . $category->smallImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?></td>
			<td><?php if(!$category->thumbImage): echo "No image Selected"?>
				<?php else:?><img src="<?php echo 'Media/category/' . $category->thumbImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?></td>
			<td><a href="<?php echo $controllerCoreAction->getUrl('edit','category',['categoryId'=> $category->categoryId],true) ?>">Edit</a></td>
			<td><a href="<?php echo $controllerCoreAction->getUrl('delete','category',['categoryId'=> $category->categoryId],true) ?>">Delete</a></td>
			<td><a href="<?php echo$controllerCoreAction->getUrl('grid','category_media',['id' =>  $category->categoryId],true) ?>">Media</a></td>
		</tr>
		<?php endforeach;	?>
<?php endif;  ?>
</table>
