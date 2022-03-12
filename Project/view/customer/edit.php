<?php $customerAddress = $this->getCustomerAddress(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

	<form action="<?php echo$controllerCoreAction->getUrl('save','customer',['id' =>  $customerAddress->customerId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Customer Information</td>
			</tr>

			<tr>
				<td width="10%">Customer Id</td>
				<td><input type="text" name="customer[id]" value="<?php echo $customerAddress->customerId; ?>" placeholder="Not for user."
					readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $customerAddress->firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $customerAddress->lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="text" name="customer[email]" value="<?php echo $customerAddress->email ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">mobile</td>
				<td><input type="number" name="customer[mobile]" value="<?php echo $customerAddress->mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="customer[status]" >
						<?php foreach ($customerAddress->getStatus() as $key => $value): ?>
              			<option <?php if($customerAddress->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">Address Id</td>
				<td><input type="text" name="address[id]" value="<?php echo $customerAddress->addressId; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]" value="<?php echo $customerAddress->address ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]" value="<?php echo $customerAddress->postalCode ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]" value="<?php echo $customerAddress->city ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]" value="<?php echo $customerAddress->state ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $customerAddress->country ; ?>"></td>
			</tr>

			<tr>    
		      <td>
		        <?php if($customerAddress->billing == '1'): ?>
		          <input type="checkbox" name="address[billing]" value=1 checked>Billing Addres</td>
		        <?php else: ?>
		          <input type="checkbox" name="address[billing]" value=1>Billing Addres</td>
		        <?php endif; ?>

		      <td>
		        <?php if($customerAddress->shipping == '1'): ?>
		          <input type="checkbox" name="address[shipping]" checked value=1> Shipping Address</td>
		        <?php else: ?>
		          <input type="checkbox" name="address[shipping]" value=1> Shipping Address</td>
		        <?php endif; ?>
		    </tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" <?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
				</td>
			</tr>

		</table>
	</form>
