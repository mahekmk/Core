<?php
class Model_Core_View
{ 
    public $template = NULL;
    public $data = [];

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
   	}

   public function toHtml()
   {
   		ob_start();
        require($this->getTemplate());
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
   }

   public function getData($key=null)
   {
        if(!$key)
        {
            return $this->data;
        }
        if(!array_key_exists($key,$this->data)){
            return $this;
        }
   		return $this->data[$key];
   }

   public function setData(array $data)
   {
   		$this->data =  $data;
   		return $this;
   }

   public function removeData($key)
   {
   		if(array_key_exists($key , $this->data))
   		{
   			unset($this->data[$key]);
   		}
   		return $this;
   }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __unset($key)
    {
        if (array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data)){
            return $this;
        }
        return $this;
    }

     public function getUrl($action = null, $controller = null, array $parameters = null, $reset = false) 
    {
        $resultUrl = [];
        if(!$controller)
        {
            $resultUrl['c'] = Ccc::getFront()->getRequest()->getRequest('c'); 
        }

        else
        {
            $resultUrl['c'] = $controller;
        }

        if(!$action)
        {
            $resultUrl['a'] = Ccc::getFront()->getRequest()->getRequest('a'); 
        }
        
        else
        {
            $resultUrl['a'] = $action;
        }

        if($reset)
        {
            if($parameters)
            {
                $resultUrl = array_merge($resultUrl, $parameters);
            }
        }
        
        else
        {
            $resultUrl = array_merge(Ccc::getFront()->getRequest()->getRequest(), $resultUrl);
        
            if($parameters)
            {
                $resultUrl = array_merge($resultUrl, $parameters);
            }
        }
        
        $url = 'index.php?'.http_build_query($resultUrl);
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




