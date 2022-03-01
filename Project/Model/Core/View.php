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
   		require($this->getTemplate());
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

   public function addData($key , $value)
   {
   		$this->data[$key] = $value;
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
}




