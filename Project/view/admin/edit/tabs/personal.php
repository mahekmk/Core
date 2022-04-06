<?php $admin = $this->getAdmin(); ?>

<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
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
										<button  class="btn btn-success" type="button" onclick="saveForm()">Save</button>
										<button  class="btn btn-danger"type="button" onclick="cancelForm()">Cancel</button>
									</td>
								</tr>
							</table>
							
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
</div>

<script type="text/javascript">
	function saveForm() 
	{
		//alert('button clicked');
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
		admin.load();
	}

	function cancelForm() 
	{
		admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
		admin.load();
	}
</script>
