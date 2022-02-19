<?php 
class Controller_Core_Front
{
	protected $request = NULL;

	public function getRequest()
	{
		if(!$this->request)
		{
			$request = new Model_Core_Request();
			$this->setRequest($request);
		}
		return $this->request;
	}

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}
	
	public function init()
	{
		$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer' ;
		$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerName = 'Controller_'.$controllerName;
		$controllerClassName = $this->prepareClassName($controllerName);
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}

	public function prepareClassName($name)
	{
		$name = ucwords($name , "_");
		return $name;
	}
}

?>