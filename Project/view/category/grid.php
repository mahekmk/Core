<?php $categories = $this->getCategories(); ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $mediaModel = Ccc::getModel('Category_Media')?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()],true) ?>&rpp="+ele.value;
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
<button name='Start'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>


<h1 align="center"> Category Information </h1>		
<button name='Add'><a href="<?php echo $this->getUrl('add','category',['p' => $this->getPager()->getEnd()],false) ?>">Add</a></button>
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
				<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $category->baseImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?>
			</td>
			<td><?php if(!$category->smallImage): echo "No image Selected"?>
				<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $category->smallImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?></td>
			<td><?php if(!$category->thumbImage): echo "No image Selected"?>
				<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $category->thumbImage; ?>" width="100px" height="100px" alt=" No Image Selected">
				<?php endif;?></td>
			<td><a href="<?php echo $this->getUrl('edit','category',['categoryId'=> $category->categoryId],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('delete','category',['categoryId'=> $category->categoryId],true) ?>">Delete</a></td>
			<td><a href="<?php echo$this->getUrl('grid','category_media',['id' =>  $category->categoryId],true) ?>">Media</a></td>
		</tr>
		<?php endforeach;	?>
<?php endif;  ?>
</table>
