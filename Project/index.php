<?php require_once('Model\Core\Adapter.php'); 
	Ccc::loadClass('Controller_Core_Front');
	Ccc::loadClass('Controller_Core_Action');
	Ccc::loadClass('Model_Core_Request');
   date_default_timezone_set("Asia/Kolkata");
   $controllerCoreAction = new Controller_Core_Action(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<button name='Admin'><a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>">Admin</a></button>
		<button name='Config'><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>">Config</a></button>
		<button name='Customer'><a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>">Customer</a></button>
		<button name='Category'><a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>">Category</a></button>
		<button name='Product'><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>">Product</a></button>
		<button name='Salesman'><a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>">Salesman</a></button>
		<button name='Page'><a href="<?php echo $controllerCoreAction->getUrl('grid','page',null,true) ?>">Page</a></button>
		<button name='Vendor'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',null,true) ?>">Vendor</a></button>
		<br>
		<br>
</body>
</html>


<?php
class Ccc
{
	public static $front = null;

	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function setFront($front)
	{
		self::$front = $front;
		
	}

	public static function loadFile($path)
	{
		require_once($path);
	}

	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}

	public static function getModel($className)
	{
		$className='Model_'.$className;
		self::loadClass($className);
		return new $className();
	}
	
	public static function getBlock($className)
	{
		$className='Block_'.$className;
		self::loadClass($className);
		return new $className();
	}

	public static function init()
	{
		self::getFront()->init();
	}
}
/*$obj = new Ccc();
$obj->init();*/

Ccc::init();
?>