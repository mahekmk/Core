<?php $page = $this->getPage(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page edit</title>
</head>
<body>

<form action="<?php echo$controllerCoreAction->getUrl('save','page',['id' =>  $page->pageId],true) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Page Information</td>
			</tr>

			<tr>
				<td width="10%">Page Id</td>
				<td><input type="text" name="page[id]" value="<?php echo $page->pageId ; ?>" readonly></td>
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
						<?php if($page->status == 2): ?>
				              <option value='2'>InActive</option>
				              <option value='1'>Active</option>
				          <?php else: ?>
				              <option value='1'>Active</option>
				              <option value='2'>InActive</option>
				          <?php endif;?>
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

</body>
</html>