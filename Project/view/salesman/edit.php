<?php $salesman = $this->getSalesman(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<form action="<?php echo$controllerCoreAction->getUrl('save','salesman',['id' =>  $salesman->salesmanId],false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> salesman Information</td>
			</tr>

			<tr>
				<td width="10%">salesman Id</td>
				<td><input type="text" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ; ?>" placeholder="Not for user." readonly></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Mobile</td>
				<td><input type="number" name="salesman[mobile]" value="<?php echo $salesman->mobile ;?>"></td>
			</tr>

			<tr>
				<td width="10%">email</td>
				<td><input type="email" name="salesman[email]" value="<?php echo $salesman->email ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">percentage</td>
				<td><input  type="number" step="0.01" name="salesman[percentage]" value="<?php echo $salesman->percentage ; ?>"></td>
			</tr>


			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="salesman[status]" >
						 <?php foreach ($salesman->getStatus() as $key => $value): ?>
              			<option <?php if($salesman->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>


			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,false) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>
