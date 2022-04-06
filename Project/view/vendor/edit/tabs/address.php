<?php 
$vendorId = Ccc::getFront()->getRequest()->getRequest('id');
$vendor = Ccc::getModel('Vendor')->load($vendorId);
$address = $vendor->getVendorAddress(); ?>

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
									<td colspan="4"><h1>Vendor Address</h1></td>
								</tr>
								<tr>
									<td >Id</td>
									<td><input type="text" name="address[addressId]" value="<?php echo $address->addressId ?>" placeholder="not for user" readonly></td>
								</tr>	
								<tr>
									<td>Address</td>
									<td><input type="text" name="address[address]"  value="<?php echo $address->address ?>"></td>
								</tr>
								<tr>
									<td >Postal Code</td>
									<td><input type="text" name="address[postalCode]"  value="<?php echo $address->postalCode ?>"></td>
								</tr>
								<tr>
									<td >City</td>
									<td><input type="text" name="address[city]"  value="<?php echo $address->city ?>"></td>
								</tr>
								<tr>
									<td >State</td>
									<td><input type="text" name="address[state]"  value="<?php echo $address->state ?>"></td>
								</tr>
								<tr>
									<td>Country</td>
									<td><input type="text" name="address[country]" value="<?php echo $address->country ?>"></td>
								</tr>

								<tr>
									<td >&nbsp;</td>
									<td>
										<button class="btn btn-success " type="button" onclick="saveAddress()">Save</button>
	<button class="btn btn-primary " type="button" onclick="addressCancel()">Cancel</button>	
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

	function saveAddress() {
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
	    //alert(admin.getUrl());
	    admin.load();
	}

	function addressCancel() {
	     //alert('button clicked');
	     admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
	     admin.load();
	 }
	</script>