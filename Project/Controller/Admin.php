<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Admin Grid');
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
        $this->renderLayout(); 
    }

    public function editAction()
    {
        $this->setTitle('Admin Edit');
        $message = $this->getMessage();

        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $admin = Ccc::getModel('Admin')->load($id);
            
            if(!$admin){
                throw new Exception("unable to load admin.");
            }
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit")->setData(["admin" => $admin]);
            $content->addChild($adminEdit);
            $this->renderLayout();       
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid','admin',null,true)); 
        }
    }

    public function addAction()
    {
        $this->setTitle('Admin Add');
        $admin = Ccc::getModel('Admin');
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock('Admin_Edit')->setData(["admin" => $admin]);
        $content->addChild($adminAdd);
        $this->renderLayout(); 
      
    }

    public function saveAction()
    {
       $message = $this->getMessage();
        try
        {

            $admin = Ccc::getModel('Admin');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('admin');
            
            if (!$row) {
                throw new Exception("Invalid Request.");             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL){

                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = md5($row['password']);
                $admin->status = $row['status'];
                $result = $admin->save();

                if (!$result)
                {
                     throw new Exception("System is unable to update information.");
                }

                $message->addMessage('Data Inserted Successfully');
            }

            else
            {
                $admin->load($row['id']);
                $admin->adminId = $row['id'];
                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = md5($row['password']);
                $admin->status = $row['status'];
                $admin->updatedAt = $date;
                $result = $admin->save();

                if (!$result)
                {
                    throw new Exception("System is unable to update information.");
                }
                $message->addMessage('Data Updated Successfully');   

            }
           $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }

        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $admin = Ccc::getModel('Admin')->load($getId);
        
        try
        {
            if (!$getId)
            {
                 throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $admin->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Admin Data Deleted Successfully');
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
            
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
