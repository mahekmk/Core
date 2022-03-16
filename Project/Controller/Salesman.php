<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Salesman Grid');
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("Salesman_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();      
    }

    public function editAction()
    {
        $this->setTitle('Salesman Edit');
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $salesman = Ccc::getModel('Salesman')->load($id);
            if(!$salesman)
            {
                 throw new Exception("unable to load salesman.");
            }
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock("Salesman_Edit")->setData(['salesman' => $salesman]);
            $content->addChild($salesmanEdit);
            $this->renderLayout();        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','salesman',null,true));
        }
    }

    public function addAction()
    {
        $this->setTitle('Salesman Add');
        $salesman = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman' => $salesman]);
        $content->addChild($salesmanAdd);
        $this->renderLayout();
    }


    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            $salesman = Ccc::getModel('salesman');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('salesman');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            }     

            $salesmanId = (int)$this->getRequest()->getRequest('id');
            $salesman = Ccc::getModel('Salesman')->load($salesmanId);
            if(!$salesman)
            {
                $salesman = Ccc::getModel('Salesman');
                $salesman->setData($row);
                $salesman->createdAt = $date;
            }
            else
            {
                $salesman->setData($row);
                $salesman->updatedAt = $date;
            }
            $result = $salesman->save();

            if (!$result)
            {
                throw new Exception("System is unable to update information.");
            }
            $message->addMessage('Data Saved Successfully'); 
            $this->redirect($this->getUrl('grid',null,['id' => null],false));
        }      
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid',null,['id' => null],false));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $salesman = Ccc::getModel('salesman')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $salesman->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully');
             $this->redirect($this->getUrl('grid',null,['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
             $this->redirect($this->getUrl('grid',null,['id' => null],false));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
