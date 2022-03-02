<?php  $controllerCoreAction = new Controller_Core_Action(); ?>

<?php 

$content = $controllerCoreAction->getLayout()->getHeader();
$menuGrid = Ccc::getBlock("Core_Layout_Header_Menu");
$content->addChild($menuGrid);


?>

<?php foreach ($content->getChildren() as $key => $child): ?>
<?php $child->toHtml(); ?>
<?php endforeach; ?>



