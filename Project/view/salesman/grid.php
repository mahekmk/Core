<?php $salesmen = $this->getSalesmen(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<html>
<head>
	<body>
		
		<button name='Add'><a href="<?php echo $controllerCoreAction->getUrl('add','salesman',null,true) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>salesman Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$salesmen): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($salesmen as $salesman): ?>
				<tr>
					<td><?php echo $salesman->salesmanId;?></td>
					<td><?php echo $salesman->firstName;?></td>
					<td><?php echo $salesman->lastName;?></td>
					<td><?php echo $salesman->email;?></td>
					<td><?php echo $salesman->mobile;?></td>
					<td><?php echo $salesman->getStatus($salesman->status); ?></td>
					<td><?php echo $salesman->createdAt;?></td>
					<td><?php echo $salesman->updatedAt;?></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('edit','salesman',['id'=> $salesman->salesmanId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $controllerCoreAction->getUrl('delete','salesman',['id'=> $salesman->salesmanId],true) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>

	</body>

</head>