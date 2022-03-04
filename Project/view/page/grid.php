<?php $pages = $this->getPages(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

		<h1 align="center"> Page Information </h1>	
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','page',null,true) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>page Id</th>
				<th>Name</th>
				<th>Code</th>
				<th>Content</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$pages): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($pages as $page): ?>
				<tr>
					<td><?php echo $page->pageId;?></td>
					<td><?php echo $page->name;?></td>
					<td><?php echo $page->code;?></td>
					<td><?php echo $page->content;?></td>
					<td><?php echo $page->getStatus($page->status); ?></td>
					<td><?php echo $page->createdAt;?></td>
					<td><?php echo $page->updatedAt;?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','page',['id'=> $page->pageId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','page',['id'=> $page->pageId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
