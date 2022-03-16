<?php $customerAddress = $this->getCustomer(); ?>
<?php $customer = $customerAddress['customer'];?>
<?php $billing = $customerAddress['billing'];?>
<?php $shipping = $customerAddress['shipping'];?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

	<form action= "<?php echo$controllerCoreAction->getUrl('save','customer',['id' =>  $customer->customerId],true) ?>" method="POST">
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
				<td width="10%">Address Id</td>
				<td><input type="text" id="billingId" name="billingAddress[addressId]" value="<?php echo $billing->addressId; ?>" placeholder="Not for user."readonly></td>
			</tr>

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
				<td width="10%">Check for shipping also</td>
				<td><input type="checkbox"  id="checkbox" name="billingAddress[same]" onclick="SetBilling(this.checked);" value="<?php echo $billing->same ?>"<?php echo ($billing->same==1) ? 'checked' : '' ; ?>   ></td> 
			</tr>
		</table>
		  <script type="text/javascript">
      function SetBilling(checked) {
        if(checked)
        {
          document.getElementById('shippingAddress').value = document.getElementById('billingAddress').value;
          document.getElementById('shippingCity').value = document.getElementById('billingCity').value;
          document.getElementById('shippingState').value = document.getElementById('billingState').value;
          document.getElementById('shippingCountry').value = document.getElementById('billingCountry').value;
          document.getElementById('shippingPostalCode').value = document.getElementById('billingPostalCode').value;

        }
        else
        {
          document.getElementById('shippingAddress').value = '';
          document.getElementById('shippingCity').value = '';
          document.getElementById('shippingState').value = '';
          document.getElementById('shippingCountry').value = '';
          document.getElementById('shippingPostalcode').value = '';
        }
      }
    </script>
	<table border="1" width="100%" cellspacing="4">
		
			<tr><td colspan="2"><h3> Shipping Address </h3></td></tr>

			<tr>
				<td width="10%">Address Id</td>
				<td><input type="text" id="shippingId" name="shippingAddress[addressId]" value="<?php echo $shipping->addressId; ?>" placeholder="Not for user."readonly></td>
			</tr>

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

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" <?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
				</td>
			</tr>

		</table>
	</form>
