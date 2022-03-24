<?php $customerAddresses = $this->getCustomerAddresses(); ?>
<?php //$controllerCoreAction = new Controller_Core_Action();?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getStart()],true) ?>&rpp="+ele.value;
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
<button name='Start'><a href="<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid','customer',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>

<h1 align="center"> Customer Information </h1>	
<button name='Add'><a href="<?php echo $this->getUrl('add','customer',['p' => $this->getPager()->getEnd()],false) ?>">Add</a></button>
<table border="1" width="100%" cellspacing="4">
	<tr>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Status</th>
		<th>Created Date</th>
		<th>Updated Date</th>
		<th>Address Id</th>
		<th>Address</th>
		<th>Postal Code</th>
		<th>City</th>
		<th>State</th>
		<th>Country</th>
		<th>Billing Address</th>
		<th>Shipping Address</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php if(!$customerAddresses): ?>
		<tr>
			<td colspan="17">No Record available.</td>
		</tr>
	<?php else : ?>
		<?php foreach ($customerAddresses as $customer): ?>
		<tr>
			<td><?php echo $customer->customerId;?></td>
			<td><?php echo $customer->firstName;?></td>
			<td><?php echo $customer->lastName;?></td>
			<td><?php echo $customer->email;?></td>
			<td><?php echo $customer->mobile;?></td>
			<td><?php echo $customer->getStatus($customer->status); ?></td>
			<td><?php echo $customer->createdAt;?></td>
			<td><?php echo $customer->updatedAt;?></td>
			<td><?php echo $customer->addressId;?></td>
			<td><?php echo $customer->address;?></td>
			<td><?php echo $customer->postalCode;?></td>
			<td><?php echo $customer->city;?></td>
			<td><?php echo $customer->state;?></td>
			<td><?php echo $customer->country;?></td>
			<td><?php echo $customer->billing;?></td>
			<td><?php echo $customer->shipping;?></td>
			<td><a href="<?php echo $this->getUrl('edit','customer',['id'=> $customer->customerId],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('delete','customer',['id'=> $customer->customerId],true) ?>">Delete</a></td>
		</tr>
		<?php endforeach;	?>
<?php endif;  ?>
</table>
