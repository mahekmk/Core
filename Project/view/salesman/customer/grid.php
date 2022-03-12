<?php $salesmanCustomers = $this->getSalesmanCustomers(); ?>
<?php $customersWithNoSalesman = $this->getCustomersWithNoSalesman(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>


<form action="<?php echo $controllerCoreAction->getUrl('save',null,null,false) ?>" method="POST">
<table border="1" width="100%">
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Action</th>
		<th>Price</th>
	</tr>

	<?php if(!$salesmanCustomers): ?>
		<tr>
			<td colspan="5">No customer for this Salesman</td>
		</tr>
	<?php else : ?>

	<?php foreach ($salesmanCustomers as $salesmanCustomer): ?>
		<tr>
			<td><?php echo $salesmanCustomer->customerId; ?></td>
			<td><?php echo $salesmanCustomer->firstName; ?></td>
			<td><?php echo $salesmanCustomer->lastName; ?></td>
			<td><?php echo $salesmanCustomer->email; ?></td>
			<td><input type="checkbox" name="salesmanCustomer[customer][]" value="" disabled></td>
			<td><a href="<?php echo $controllerCoreAction->getUrl('grid','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->customerId],true); ?>">Price</a></td>
		</tr>
	<?php endforeach; ?>
	<?php endif;  ?>
	<tr>
		<td colspan="6">Customer with no Salesman</td>
	</tr>

	<?php if(!$customersWithNoSalesman): ?>
		<tr>
			<td colspan="6">No Record available.</td>
		</tr>
	<?php else : ?>
	<?php foreach ($customersWithNoSalesman  as $customerWithNoSalesman ): ?>
		<tr>
			<td><?php echo $customerWithNoSalesman->customerId; ?></td>
			<td><?php echo $customerWithNoSalesman->firstName; ?></td>
			<td><?php echo $customerWithNoSalesman->lastName; ?></td>
			<td><?php echo $customerWithNoSalesman->email; ?></td>
			<td><input type="checkbox" name="customerWithNoSalesman[customer][]" value="<?php
			 echo $customerWithNoSalesman->customerId ; ?>"></td>
			 <th>Not a selected customer</th>
		</tr>
	<?php endforeach; ?>
	<?php endif;  ?>
		<tr>
			<td colspan="5"><input type="submit" name="submit" value="Save">
			<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>">Cancel</a></button>
			</td>
		</tr>
</table>
</form>