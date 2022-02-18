<?php $category = $this->getCategory(); ?>
<?php $categoryPathPair = $this->getData('categoryPathPair'); ?>
<?php $categoryPath = $this->getData('categoryPath'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Category edit</title>
</head>
<body>

<form action="index.php?c=category&a=save&id=<?php echo $category['categoryId']?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Category Information</td>
			</tr>

			<tr>
				<td width="10%">Category Id</td>
				<td><input type="text" name="category[id]" value="<?php echo $category['categoryId']  ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Select category</td>
				<td><select name="category[parentId]">
					<option value=<?php echo $category['parentId'] ?>><?php echo $categoryPath[$category['categoryId']]?></option>

					<option value="">Main category </option>
						<?php
							foreach($categoryPathPair as $key => $value):
						?>		<option value=<?php echo $key; ?> >
						<?php
								echo($value);
						?>
					</option>
						<?php
							endforeach;
						?>							
				</select>
			</td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $category['name'] ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="category[status]" value="<?php echo $category['status']; ?>">
						<option value="1" <?php if($category['status'] == 1):?>  selected="selected" <?php endif; ?> >Active</option>
						<option value="2" <?php if($category['status']== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href=" index.php?c=category&a=grid">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>

</body>
</html>