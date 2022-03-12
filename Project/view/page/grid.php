<?php $pages = $this->getPages(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "http://localhost/cybercom/Core/Project/index.php?c=page&a=grid&p=1&rpp="+ele.value;
		window.open(pageUrl,"_self");	
	}
</script>
		
<select name="page" id="page" onchange="url(this)">
	<?php foreach ($this->getPager()->getPerPageCountOptions() as $perPage): ?>
		<?php if($perPageCount == $perPage): ?>
		<option selected='selected' value="<?php echo $perPage; ?>"> 
			<?php echo $perPage; ?>	
			</option>
		<?php else:?>
			<option value="<?php echo $perPage; ?>"> 
			<?php echo $perPage; ?>	
			</option>
		<?php endif; ?>
	<?php endforeach; ?>
</select>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Start' disabled ><a>Start</a></button>
<?php else: ?>
<button name='Start'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>


<h1 align="center"> Page Information </h1>	
<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','page',['p' => $this->getPager()->getEnd()],false) ?>">Add</a></button>
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
			<td><a href="<?php echo $controllerCoreAction->getUrl('edit','page',['id'=> $page->pageId ],false) ?>">Edit</a></td>
			<td><a href="<?php echo $controllerCoreAction->getUrl('delete','page',['id'=> $page->pageId ],false) ?>">Delete</a></td>
		</tr>
		<?php endforeach;	?>
<?php endif;  ?>
</table>
