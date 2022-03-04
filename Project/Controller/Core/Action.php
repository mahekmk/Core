<?php 
Ccc::loadClass('Block_Core_Layout');
Ccc::loadClass('Model_Core_Request');
?>

<?php 
class Controller_Core_Action{

    protected $layout = null; 
    protected $message = null; 

    public function getMessages()
    {
        if(!$this->message)
        {
            $this->setMessage(new Block_Core_Message());
        }
        return $this->message;
    }

     public function addMessage($message)
    {
        $this->message = $message;
        return $this;
    }

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

    public function getLayout()
    {
        if(!$this->layout)
        {
            $this->setLayout(new Block_Core_Layout());
        }
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function renderLayout()
    {
        return $this->getLayout()->toHtml();
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
