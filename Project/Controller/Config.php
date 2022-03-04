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
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $config = Ccc::getModel('Config')->load($id);
            //$config = $configModel->fetchRow("SELECT * FROM config WHERE configId = {$id} ");
            if(!$config){
                throw new Exception("unable to load config.");
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
     // Ccc::getBlock('Config_Add')->toHtml();  
    }

    public function saveAction()
    {
        try
        {

            $config = Ccc::getModel('Config');
            date_default_timezone_set("Asia/Kolkata");
            //$config = $configModel->getRow();
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('config');
            
            if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL):
            
                $config->name = $row['name'];
                $config->value = $row['value'];
                $config->code = $row['code'];
                $config->status = $row['status'];
                $config->createdAt = $date;
                $config->save();

            else:

                $config->load($row['id']);
                $config->configId = $row["id"];
                $config->name = $row['name'];
                $config->value = $row['value'];
                $config->code = $row['code'];
                $config->status = $row['status'];
                $result = $config->save();

           /* $result = $configModel->update(['firstName' => $firstName , 'lastName' => $lastName , 'email' => $email ,'password' => $password , 'status' => $status ,'updatedAt' => $date ], ['configId'=> $id]);*/

                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }

            endif;
           $this->redirect($this->getUrl('grid','config',null,true));
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getId = $this->getRequest()->getRequest('id');
        $config = Ccc::getModel('Config')->load($getId);
        /*$configTable = new Model_config();*/
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $config->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect($this->getUrl('grid','config',null,true));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
