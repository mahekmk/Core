<?php $page = $this->getPage(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<form action="<?php echo$controllerCoreAction->getUrl('save','page',null,false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Page Information</td>
			</tr>

			<tr>
				<td width="10%">Page Id</td>
				<td><input type="text" name="page[pageId]" value="<?php echo $page->pageId ; ?>" placeholder="Not for user." readonly></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="page[name]" value="<?php echo $page->name ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="page[code]" value="<?php echo $page->code ; ?>"></td>
			</tr>

			<tr>
				<td width="10%">Content</td>
				<td><input type="text" name="page[content]" value="<?php echo $page->content ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="page[status]" value="<?php echo $page->status; ?>">
						<?php foreach ($page->getStatus() as $key => $value): ?>
              			<option <?php if($page->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>


			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $controllerCoreAction->getUrl('grid','page',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>