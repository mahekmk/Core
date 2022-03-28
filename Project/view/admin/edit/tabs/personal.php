<?php $admin = $this->getAdmin(); ?>

<table border="1" width="100%" cellspacing="4">
	<tr>
		<td colspan="2"> Admin Information</td>
	</tr>

	<tr>
		<td width="10%">Admin Id</td>
		<td><input type="text" name="admin[id]" value="<?php echo $admin->adminId ; ?>" placeholder="Not for user." readonly></td>
	</tr>

	<tr>
		<td width="10%">First Name</td>
		<td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ; ?>" ></td>
	</tr>

	<tr>
		<td width="10%">Last Name</td>
		<td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ;?>"></td>
	</tr>

	<tr>
		<td width="10%">email</td>
		<td><input type="email" name="admin[email]" value="<?php echo $admin->email ; ?>"></td>
	</tr>

	<?php if(!$admin->password): ?>
	<tr>
		<td width="10%">password</td>
		<td><input type="password" name="admin[password]" value="<?php echo $admin->password ;?>"></td>
	</tr>
<?php endif;?>

	<tr>
		<td width="10%">Status</td>
		<td>
			<select name="admin[status]" >
				<?php foreach ($admin->getStatus() as $key => $value): ?>
      			<option <?php if($admin->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
    			<?php endforeach; ?>
			</select>
		</td>
	</tr>


	<tr>
	<td width="10%">&nbsp;</td>
		<td>
			<input type="submit" name="submit" value="Save">
			<button type="button"><a href="<?php echo $this->getUrl('grid','admin',null,true) ?>">Cancel</a></button>
		</td>
</tr>
</table>
