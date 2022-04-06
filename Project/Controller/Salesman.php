<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_salesman'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php
class Controller_Salesman extends Controller_Core_Action
{   
    public function gridAction()
    {
        $this->setTitle("Salesmana Grid");
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("salesman_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

     public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('salesman_Index');
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $salesmanGrid = Ccc::getBlock("salesman_Grid")->toHtml();
         $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         $response = [
            'status' => 'success',
            'content' => $salesmanGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $salesman = Ccc::getModel('salesman');
        Ccc::register('salesman',$salesman);
        $customer = $salesman->getCustomers();
        Ccc::register('customer',$customer);
        $salesmanAdd =$this->getLayout()->getBlock('salesman_Edit')->toHtml();
        $response = [
            'status' => 'success',
            'content' => $salesmanAdd
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $salesmanModel = Ccc::getModel('salesman')->load($id);
            $salesman = $salesmanModel->fetchRow("SELECT * FROM `salesman` WHERE `salesmanId` = $id");
            Ccc::register('salesman',$salesman);
            $customer = $salesmanModel->getCustomers();
            Ccc::register('customer',$customer);
        
            if(!$salesman)
            {
                throw new Exception("unable to load salesman.");
            }
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock("salesman_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $salesmanEdit
        ];
        $this->renderJson($response);
    }

    public function addAction()
    {
        $this->setTitle("Salesmana Add");
        $salesman = Ccc::getModel('salesman');
        $content = $this->getLayout()->getContent();
        Ccc::register('salesman',$salesman);
        $salesmanAdd = Ccc::getBlock("salesman_Edit");//->setData(['salesman' => $salesman]);
        $content->addChild($salesmanAdd);
        $this->renderLayout();  
    }

    public function editAction()
    {   
        try 
        {
            $this->setTitle("Salesmana Edit");
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $salesman = Ccc::getModel('salesman')->load($id);
            if(!$salesman)
            {
                throw new Exception("unable to load salesman.");
            }
            Ccc::register('salesman',$salesman);    
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock("salesman_Edit");//->setData(['salesman' => $salesman]);
            $content->addChild($salesmanEdit);
            $this->renderLayout();  
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true)); ;
        }
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        
        try
        {
            $row = $this->getRequest()->getPost('salesman');
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
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getLayout()->getUrl('addBlock',null,['id' => $result->salesmanId , 'tab' => 'customer'],true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid','salesman',null,true));
        }

}
    
    public function deleteAction()
    {
        try 
        {   
            $message = $this->getMessage();
            $getId = $this->getRequest()->getRequest('id'); 
            $salesmanTable = Ccc::getModel('salesman')->load($getId);
            if (!$getId) 
            {
                throw new Exception("Invalid Request.");
            }
            $delete = $salesmanTable->delete(['salesmanId' => $getId]);
            if(!$delete)
            {
                throw new Exception("System is unable to delete record.");
                                        
            }
            $message->addMessage('Delete Successfully.');           
            $this->redirect($this->getLayout()->getUrl('grid','salesman',['id' => null],false));    
                
        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));  
        }
    }
}
