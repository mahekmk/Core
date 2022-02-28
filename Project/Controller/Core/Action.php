<?php 
Ccc::loadClass('Model_Core_View');
Ccc::loadClass('Model_Core_Request');
?>

<?php 
class Controller_Core_Action{

    public $view = null; 

    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }

	public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function getView()
    {
        if(!$this->view){
            $this->setView(new Model_Core_View());
        }
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getRequest()
    {
        return Ccc::getFront()->getRequest();
    }

    public function getUrl($action=null,$controller=null,array $parameters=null,$reset=false)
    {
       $tempArray = [];
        if(!$controller)
        {
            $tempArray['c'] = $this->getRequest()->getRequest('c'); 
        }
        else
        {
            $tempArray['c'] = $controller;
        }

        if(!$action)
        {
            $tempArray['a'] = $this->getRequest()->getRequest('a'); 
        }
        else
        {
            $tempArray['a'] = $action;
        }

        if($reset)
        {
            if($parameters)
            {
                $tempArray = array_merge($tempArray,$parameters);
            }
        }
        else
        {
            $tempArray = array_merge($this->getRequest()->getRequest(),$tempArray);
            if($parameters)
            {
                $tempArray = array_merge($tempArray,$parameters);
            }
        }
        $url = 'index.php?'.http_build_query($tempArray);
        return $url;
    }

    public function getBaseUrl($subUrl = null)
    {
        $url = "E:/xampp/htdocs/Cybercom/Core/Project";
        if($subUrl){
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}
