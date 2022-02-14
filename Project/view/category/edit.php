<?php
require_once('Model/Core/Adapter.php');
$controllerCategory = new Controller_Category();
$adapter = new Model_Core_Adapter();
if($_GET['id'])
{
$id = $_GET['id'];
$data = $adapter->fetchRow("Select * FROM category WHERE categoryID = '$id'");
 
 		$name = $data['name'];
 		$status = $data['status'];

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Category edit</title>
</head>
<body>

<form action="index.php?c=category&a=save&id=<?php echo $_GET['id']?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Category Information</td>
			</tr>

			<tr>
				<td width="10%">Category Id</td>
				<td><input type="text" name="category[id]" value="<?php echo $id ; ?>" readonly></td>
			</tr>

			<tr>
				<td width="10%">Select category</td>
				<td><select name="category[parentId]">
					<option value="">Main category </option>
						<?php
							$result = $controllerCategory->getCategoryWithPath();			
							foreach($result as $key => $value):
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
				<td><input type="text" name="category[name]" value="<?php echo $name ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="category[status]" value="<?php echo $status; ?>">
						<option value="1" <?php if($status == 1):?>  selected="selected" <?php endif; ?> >Active</option>
						<option value="2" <?php if($status== 2):?>  selected="selected" <?php endif; ?>>Inactive</option>
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