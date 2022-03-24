 <?php $customerAddress = $this->getCustomer(); ?>
<?php $customer = $customerAddress['customer'];?>
<?php $billing = $customerAddress['billing'];?>
<?php $shipping = $customerAddress['shipping'];?>
<?php //$controllerCoreAction = new Controller_Core_Action();?>

	<form action= "<?php echo$this->getUrl('save','customer',['id' =>  $customer->customerId],false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"><h3> Customer Information</h3></td>
			</tr>

			<tr>
				<td width="10%">Customer Id</td>
				<td><input type="text" name="customer[customerId]" value="<?php echo $customer->customerId; ?>" placeholder="Not for user."
					readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="email" name="customer[email]" value="<?php echo $customer->email ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">mobile</td>
				<td><input type="number" name="customer[mobile]" value="<?php echo $customer->mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="customer[status]" >
						<?php foreach ($customer->getStatus() as $key => $value): ?>
              			<option <?php if($customer->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr><td colspan="2"><h3> Billing Address </h3></td></tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" id="billingAddress" name="billingAddress[address]" value="<?php echo $billing->address ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" id="billingPostalCode" name="billingAddress[postalCode]" value="<?php echo $billing->postalCode ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" id="billingCity" name="billingAddress[city]" value="<?php echo $billing->city ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" id="billingState" name="billingAddress[state]" value="<?php echo $billing->state ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" id="billingCountry" name="billingAddress[country]" value="<?php echo $billing->country ; ?>"></td>
			</tr>


			<tr>
			<td colspan="2"><input type="checkbox" name="sameShipping" <?php if($billing->same == 1):?> checked <?php endif; ?> onclick="showHide(this)">Mark Shipping as Billing</td>
		</tr>
		</table>


		<script type="text/javascript">
			function showHide(checkbox) {
				var shippingAddress = document.getElementById('shipping');
				shippingAddress.style.display = checkbox.checked ? "none" : "block";
			}
		</script>
		 
    <div id='shipping' <?php if($billing->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
	<table border="1" width="100%" cellspacing="4">
		
			<tr><td colspan="2"><h3> Shipping Address </h3></td></tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" id="shippingAddress" name="shippingAddress[address]" value="<?php echo $shipping->address ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" id="shippingPostalCode" name="shippingAddress[postalCode]" value="<?php echo $shipping->postalCode ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" id="shippingCity" name="shippingAddress[city]" value="<?php echo $shipping->city ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>
				<td><input type="text" id="shippingState" name="shippingAddress[state]" value="<?php echo $shipping->state ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" id="shippingCountry" name="shippingAddress[country]" value="<?php echo $shipping->country ; ?>"></td>
			</tr>

			

		</table>
	</div>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" <?php echo $this->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
	</form>
