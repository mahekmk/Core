<?php
echo '<pre>';
class Model_Core_Request
{ 
    public function getPost($key = null , $value = null)
    {
        if($key == null && $value == null)
        {
            //print_r($_POST);
            return $_POST;
        }
        
        elseif($key == null && $value!=null)
        {
            return $_POST[$value];
        }

        else
        {
            if(array_key_exists($key, $_POST))
            {
                return $_POST[$key];
            }
        }
    }

    public function getRequest($key = null , $value = null)
    {
        if($key == null && $value == null)
        {
            return $_REQUEST;
        }

        elseif($key == null && $value!=null)
        {
            return $value;
        }

        else
        {
            if(array_key_exists($key, $_REQUEST))
            {
                return $_REQUEST[$key];
            }
        }
    }

    public function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            return true;
        }
        return false;
    }

    public function getActionName()
    {
        $actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'error';
        return $actionName;
    }

    public function getControllerName()
    {
        $controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer';
        return $controllerName;        
    }
    
}




