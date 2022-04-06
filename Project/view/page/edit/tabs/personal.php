<?php $page = $this->getPage(); ?>

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
									<td colspan="2"> Page Information</td>
								</tr>

								<tr>
									<td width="10%">Page Id</td>
									<td><input type="text" id="pageId" name="page[pageId]" value="<?php echo $page->pageId ; ?>" placeholder="Not for user." readonly></td>
								</tr>

								<tr>
									<td width="10%">Name</td>
									<td><input type="text" id="pageName" name="page[name]" value="<?php echo $page->name ; ?>" ></td>
								</tr>

								<tr>
									<td width="10%">Code</td>
									<td><input type="text" id="pageCode" name="page[code]" value="<?php echo $page->code ; ?>"></td>
								</tr>

								<tr>
									<td width="10%">Content</td>
									<td><input type="text" id="pageContent" name="page[content]" value="<?php echo $page->content ;?>"></td>
								</tr>

								<tr>
									<td width="10%">Status</td>
									<td>
										<select name="page[status]" id="pageStatus" value="<?php echo $page->status; ?>">
											<?php foreach ($page->getStatus() as $key => $value): ?>
												<option <?php if($page->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
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
