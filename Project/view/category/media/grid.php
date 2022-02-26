<?php $medias = $this->getCategoryMedias(); 
$id= $_GET['id'];?>	
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	

	<form action="<?php echo $controllerCoreAction->getUrl('save','category_media',['id' =>  $id],true) ?>" method="POST" align="center">
		<input type="submit" name="update" value="UPDATE"> 
	<button ><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Cancel</a></button>

		<table border=1 width=100%>
			<tr>
				<th>Image Id</th>
					<th>Image</th>
					<th>Base</th>
					<th>Thumb</th>
					<th>Small</th>
					<th>Gallery</th>
					<th>Status</th>
					<th>Remove</th>
			</tr>
			<?php if($medias): ?>
			
				<?php foreach ($medias as $media): ?>		
					<tr>
			    		<td><?php echo $media->imageId ; ?></td>
						<td><?php echo $media->image ; ?></td>
						<input type="hidden" name="media[imageId]" value="<?php echo $media->imageId?>">
						<td><input type="radio" name="media[base]" value="<?php echo $media->imageId?>"<?php echo ($media->base==1) ? 'checked' : '' ; ?>></td>
						<td><input type="radio" name="media[thumb]" value="<?php echo $media->imageId?>"<?php echo ($media->thumb==1) ? 'checked' : '' ;?>></td>
						<td><input type="radio" name="media[small]" value="<?php echo $media->imageId?>"<?php echo ($media->small==1) ? 'checked' : '' ;?>></td>
						<td><input type="checkbox" name="media[gallery][]" value="<?php echo $media->imageId ?>"<?php echo ($media->gallery==1) ? 'checked' : '' ; ?>></td>
						<td><input type="checkbox" name="media[status][]" value="<?php echo $media->imageId ?>"<?php echo ($media->status==1) ? 'checked' : '' ; ?>></td>
						<td><input type="checkbox" name="media[remove][]" value="<?php echo $media->imageId ?>"></td>	
			    		
			    	</tr>
			  	<?php endforeach; ?>
			<?php else: ?>
				<tr><td colspan='8'>No Record Available</td></tr>
			<?php endif; ?>
	 
		</table>
	</form>
	<br>
	<br>
	<br>
	<br>


<form align="center" action="<?php echo $controllerCoreAction->getUrl('add','category_media',['id' =>  $id],true) ?>" method="POST" enctype="multipart/form-data">
<input type="file" name="image[]">
<input type="submit" name="submit" value="Submit">



</form>



</body>
</html>