<?php $products = $this->getProducts(); ?>
<?php $mediaModel = Ccc::getModel('Product_Media')?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getStart()],true) ?>&rpp="+ele.value;
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
<button name='Start'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>


		<h1 align="center"> Product Information </h1>
		<button name='Add'><a href="<?php echo $this->getUrl('add','product',['p' => $this->getPager()->getEnd()],false) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Product Id</th>
				<th>Name</th>
				<th>Price</th>
				<th>Tax</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>Discount</th>
				<th>Discount Mode</th>
				<th>Sku</th>
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
			<?php if(!$products): ?>
				<tr>
					<td colspan="13">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->productId; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->price; ?></td>
					<td><?php echo $product->tax; ?></td>
					<td><?php echo $product->quantity; ?></td>
					<td><?php echo $product->cost; ?></td>
		    		<td><?php echo $product->discount; ?></td>
		    		<td><?php echo $product->getDiscountMode($product->discountMode); ?></td>
					<td><?php echo $product->sku; ?></td>
					<td><?php echo $product->getStatus($product->status); ?></td>
					<td><?php echo $product->createdAt; ?></td>
					<td><?php echo $product->updatedAt; ?></td>
					<td>
						<?php if(!$product->baseImage): echo "No image Selected"?>
						<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $product->baseImage; ?>" width="100px" height="100px" alt=" No Image Selected">
						<?php endif;?>
					</td>
					<td><?php if(!$product->smallImage): echo "No image Selected"?>
						<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $product->smallImage; ?>" width="100px" height="100px" alt=" No Image Selected">
						<?php endif;?></td>
					<td><?php if(!$product->thumbImage): echo "No image Selected"?>
						<?php else:?><img src="<?php echo $mediaModel->getImageUrl() . $product->thumbImage; ?>" width="100px" height="100px" alt=" No Image Selected">
						<?php endif;?></td>
					<td><a href="<?php echo$this->getUrl('edit','product',['id' =>  $product->productId],false) ?>">Edit</a></td>
					<td><a href="<?php echo$this->getUrl('delete','product',['id' =>  $product->productId],false) ?>">Delete</a></td>
					<td><a href="<?php echo$this->getUrl('grid','product_media',['id' =>  $product->productId],false) ?>">Media</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
