<?php $category = $this->getCategory();?>
<?php $UrlAction = new Controller_Core_Action();?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $result = $getCategoryWithPath;  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Update</title>
</head>
<body>
	<table border="1" width="100%">
		<form method="post" action="<?php echo $UrlAction->getUrl('save','category',['categoryId' =>  $category['categoryId']],true) ?>
">
			<tr>
                <td>Id</td>
                <td><input type="text" name="category[categoryId]" value="<?php echo $category['categoryId']; ?>" readonly></td>
            </tr>
			<tr>
			<td width="10%">Category</td>
			<td>
				<select name="category[parentId]">
					<option value="">Main Category</option>
					<?php
						foreach ($result as $key => $row) {
						 	?>
						 	<option value="<?php echo $key; ?>" <?php if ($category['parentId'] == $key) {
						 		echo "selected";
						 	} ?>><?php echo $row; ?></option>
						 	<?php
						 } 
						
					?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Status</td>
			<td><select name="category[status]" value="<?php echo $category['status'];?>">
				<option value="1" <?php if($category['status'] == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
				<option value="2" <?php if($category['status'] == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Category Name</td>
		<td>
			<input type="text" name="category[name]" value="<?php echo $category['name']; ?>">
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="Submit">
			<button type="button"><a href="<?php echo $UrlAction->getUrl('grid','category',null,true) ?>">Cancel</a></button></td>
		</tr>
	</form>        
</table>
</body>
</html>