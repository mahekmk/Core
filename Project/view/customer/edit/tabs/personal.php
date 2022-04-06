<?php $customer = $this->getCustomer(); ?>
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
									<td colspan="4"><h1>Personal details</h1></td>
								</tr>

								<tr>
									<td >Id</td>
									<td><input type="text" placeholder="You cannot insert Id." name="customer[customerId]" value="<?php echo $customer->customerId ?>" readonly></td>
								</tr>	
								<tr>
									<td >First Name</td>
									<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>"></td>
								</tr>
								
								<tr>
									<td >Last Name</td>
									<td><input type="text" name="customer[lastName]"  value="<?php echo $customer->lastName ?>"></td>
								</tr>

								<tr>
									<td >Email</td>
									<td><input type="mail" name="customer[email]"  value="<?php echo $customer->email ?>"></td>
								</tr>

								<tr>
									<td >Mobile</td>
									<td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile ?>"></td>
								</tr>
								<tr>
									<td >Status</td>
									<td>
										<select name="customer[status]">
											<?php foreach ($customer->getStatus() as $key => $value): ?>
												<option <?php if($customer->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>

								<tr>
									<td >&nbsp;</td>
									<td>
										<button class="btn btn-success" type="button" onclick="saveAndNext()">Save & Next</button>
										<button class="btn btn-danger" type="button" onclick="cancelForm()">Cancel</button>
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

	function saveAndNext() 
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




