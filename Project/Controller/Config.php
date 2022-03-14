<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock("Config_Grid");
        $content->addChild($configGrid);
        $this->renderLayout();         
    }

    public function editAction()
    {
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
               throw new Exception("Id not valid.");
            }
            $config = Ccc::getModel('Config')->load($id);
            if(!$config){
                throw new Exception("unable to load config.");
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock("Config_Edit")->setData(["config" => $config]);
            $content->addChild($configEdit);
            $this->renderLayout();        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);     
            $this->redirect($this->getUrl('grid','config',null,true));
        }
    }

    public function addAction()
    {
        $config = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->setData(["config" => $config]);
        $content->addChild($configAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('config');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 

            $configId = (int)$this->getRequest()->getRequest('id');
            $config = Ccc::getModel('Config')->load($configId);
            if(!$config)
            {
                $config = Ccc::getModel('Config');
                $config->setData($row);
                $config->createdAt = $date;
            }
            else
            {
                $config->setData($row);
            }
            $result = $config->save();

            if (!$result)
            {
                throw new Exception("System is unable to update information.");
            }
            $message->addMessage('Data Saved Successfully'); 
            $this->redirect($this->getUrl('grid','config',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','config',null,true));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $config = Ccc::getModel('Config')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $config->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','config',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','config',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}


