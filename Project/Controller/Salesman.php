<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
         $salesmanGrid = Ccc::getBlock("Salesman_Grid");
         $content->addChild($salesmanGrid);
         $this->renderLayout();      
    }

    public function editAction()
    {
        $message = Ccc::getModel('Core_Message');
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
            $salesmanEdit = Ccc::getBlock("Salesman_Edit")->addData("salesman", $salesman);
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
        $salesman = Ccc::getModel('Salesman');
        Ccc::getBlock('salesman_Edit')->addData('salesman',$salesman)->toHtml(); 
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {
            $salesman = Ccc::getModel('salesman');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('salesman');
            if (!isset($row)) 
            {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL)
            {

                $salesman->firstName = $row['firstName'];
                $salesman->lastName = $row['lastName'];
                $salesman->mobile = $row['mobile'];
                $salesman->email = $row['email'];
                $salesman->status = $row['status'];
                $salesman->createdAt = $date;
                $result = $salesman->save();

                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }

                if($result)
                {
                    $message->addMessage('Data Added Successfully');
                }
            }

            else
            {
                $salesman->load($row['id']);
                $salesman->salesmanId = $row["id"];
                $salesman->firstName = $row['firstName'];
                $salesman->lastName = $row['lastName'];
                $salesman->mobile = $row['mobile'];
                $salesman->email = $row['email'];
                $salesman->status = $row['status'];
                $salesman->updatedAt = $date;
                $result = $salesman->save();

                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }
                $message->addMessage('Data Updated Successfully'); 
            }
           $this->redirect($this->getUrl('grid','salesman',null,true));
        }

        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','salesman',null,true));
        }
    }

    public function deleteAction()
    {
        $message = Ccc::getModel('Core_Message');
        $getId = $this->getRequest()->getRequest('id');
        $salesman = Ccc::getModel('salesman')->load($getId);
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $salesman->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','salesman',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','salesman',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
