<?php require_once('Model/Core/Adapter.php');  ?>
<?php
class Ccc
{
	public $front = null;

	public function getFront()
	{
		Ccc::loadClass('Controller_Core_Front');
		if(!$this->front)
		{
			$front = new Controller_Core_Front();
			$this->setFront($front);
		}
		return $this->front;
	}

	public function setFront($front)
	{
		$this->front = $front;
		return $this;
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

	public function init()
	{
		$this->getFront()->init();

		/*$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer' ;
		$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerClassName = 'Controller_'.$controllerName;
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();*/
	}
}
$obj = new Ccc();
$obj->init();
?>