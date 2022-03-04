<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

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
        $message = Ccc::getModel('Core_Message');
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                $message->addMessage('Id not valid.',Model_Core_Message::ERROR);            
                $this->redirect($this->getUrl('grid','config',null,true));
                //throw new Exception("Id not valid.");
            }
            $config = Ccc::getModel('Config')->load($id);
            if(!$config){
                $message->addMessage('unable to load.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid','config',null,true));
                //throw new Exception("unable to load config.");
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock("Config_Edit")->addData("config", $config);
            $content->addChild($configEdit);
            $this->renderLayout();        
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $config = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->addData('config',$config);
        $content->addChild($configAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {

            $config = Ccc::getModel('Config');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('config');
            
            if (!isset($row)) {
                $message->addMessage('Invalid Request.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','config',null,true));
                //throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL){
            
                $config->name = $row['name'];
                $config->value = $row['value'];
                $config->code = $row['code'];
                $config->status = $row['status'];
                $config->createdAt = $date;
                $result = $config->save();

                if (!$result)
                {
                    $message->addMessage('System is unable to inserted information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid','config',null,true)); 
                   // throw new Exception("System is unable to update information.", 1);
                }

                if($result)
                {
                    $message->addMessage('Data Added Successfully');
                }
            }

            else
            {
                $config->load($row['id']);
                $config->configId = $row["id"];
                $config->name = $row['name'];
                $config->value = $row['value'];
                $config->code = $row['code'];
                $config->status = $row['status'];
                $result = $config->save();
                if (!$result)
                {
                    $message->addMessage('System is unable to update information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid','config',null,true)); 
                   // throw new Exception("System is unable to update information.", 1);
                }
                $message->addMessage('Data Updated Successfully'); 
            }
           $this->redirect($this->getUrl('grid','config',null,true));
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $message = Ccc::getModel('Core_Message');
        $getId = $this->getRequest()->getRequest('id');
        $config = Ccc::getModel('Config')->load($getId);
        /*$configTable = new Model_config();*/
        try
        {
            if (!isset($getId))
            {
                $message->addMessage('Invalid Request.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid','config',null,true)); 
                //throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $config->delete(); 
            if (!$result)
            {
                $message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);           
                $this->redirect($this->getUrl('grid','config',null,true));
                //throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','config',null,true));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
