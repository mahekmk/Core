<div  id="adminMessage"></div>
<form id="indexForm" action="<?php echo $this->getUrl('gridBlock');?>" method="POST">
	<div id="indexContent">

	</div>
</form>
<script type="text/javascript">
	admin.setForm(jQuery('#indexForm'));
	admin.load();
</script>