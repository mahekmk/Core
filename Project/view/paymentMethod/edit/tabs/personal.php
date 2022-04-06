<?php $paymentMethod = $this->getPaymentMethod(); ?>
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
									<td colspan="2"> PaymentMethod Information</td>
								</tr>

								<tr>
									<td width="10%">PaymentMethod Id</td>
									<td><input type="text" name="paymentMethod[methodId]" value="<?php echo $paymentMethod->methodId ; ?>" placeholder="Not for user." readonly></td>
								</tr>

								<tr>
									<td width="10%">Name</td>
									<td><input type="text" name="paymentMethod[name]" value="<?php echo $paymentMethod->name ; ?>" ></td>
								</tr>

								<tr>
									<td width="10%">Note</td>
									<td><input type="text" name="paymentMethod[note]" value="<?php echo $paymentMethod->note ;?>"></td>
								</tr>

								<tr>
									<td width="10%">Status</td>
									<td>
										<select name="paymentMethod[status]" value="<?php echo $paymentMethod->status; ?>">
											<?php foreach ($paymentMethod->getStatus() as $key => $value): ?>
												<option <?php if($paymentMethod->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>

								<tr>
									<td width="10%">&nbsp;</td>
									<td>
										<button class="btn btn-success" type="button" onclick="saveForm()">Save</button>
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