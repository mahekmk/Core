<?php $medias = $this->getProductMedias(); ?>	
<?php $mediaModel = Ccc::getModel('Product_Media')?>

<form action="<?php echo $this->getUrl('save','product_media',null,false) ?>" method="POST" align="center">
	<input type="submit" name="update" value="UPDATE"> 
<button class="btn btn-danger"><a href="<?php echo $this->getUrl('grid','product',null,false) ?>">Cancel</a>
</button>
<br>
<br>
	<table border=1 width=100%>
		<tr>
			<th>Image Id</th>
				<th>Imageeee</th>
				<th>Base</th>
				<th>Thumb</th>
				<th>Small</th>
				<th>Gallery</th>
				<th>Status</th>
				<th>Remove</th>
		</tr>
		<?php if($medias): ?>
		<?php?>
			<?php foreach ($medias as $media): ?>	

				<tr>
		    		<td><?php echo $media->imageId ; ?></td>
					<td><img src="<?php echo  $mediaModel->getImageUrl()  . $media->image; ?>" width="100px" height="100px" alt="image"></td>
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
	
<form align="center" action="<?php echo $this->getUrl('add','product_media',null,false) ?>" method="POST" enctype="multipart/form-data">
	<table width="50%" border="1px" align="center">
		<tr>
			<td><label>Select File</label></td>
			<td><input type="file" name="image[]" accept="image/*"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Upload"></td>
		</tr>	
	</table>
</form>
