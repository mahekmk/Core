<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Admin extends Controller_Core_Action
{

    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
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
                $this->redirect($this->getUrl('grid')); 
                //throw new Exception("Id not valid.");
            }
            $admin = Ccc::getModel('Admin')->load($id);
            
            if(!$admin){
                $message->addMessage('unable to load admin.',Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid')); 
                //throw new Exception("unable to load admin.");
            }
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit")->addData("admin", $admin);
            $content->addChild($adminEdit);
            $this->renderLayout();       
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $admin = Ccc::getModel('Admin');
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock('Admin_Edit')->addData('admin',$admin);
        $content->addChild($adminAdd);
        $this->renderLayout(); 
      
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {

            $admin = Ccc::getModel('Admin');
            date_default_timezone_set("Asia/Kolkata");
            //$admin = $adminModel->getRow();
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('admin');
            
            if (!isset($row)) {
                $message->addMessage('Invalid Request.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid')); 
                //throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL){

                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = $row['password'];
                $admin->status = $row['status'];
                $result = $admin->save();

                if (!$result)
                {
                    $message->addMessage('System is unable to update information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid')); 
                   // throw new Exception("System is unable to update information.", 1);
                }

                if($result)
                {
                    $message->addMessage('Admin Data Added Successfully');
                }
            }

            else
            {
                $admin->load($row['id']);
                $admin->adminId = $row["id"];
                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = $row['password'];
                $admin->status = $row['status'];
                $admin->updatedAt = $date;
                $result = $admin->save();

                if (!$result)
                {
                    $message->addMessage('System is unable to update information.',Model_Core_Message::ERROR);          
                    $this->redirect($this->getUrl('grid')); 
                   // throw new Exception("System is unable to update information.", 1);
                }
                $message->addMessage('Admin Data Edited Successfully');   

            }
           $this->redirect($this->getUrl('grid','admin',null,true));
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
        $admin = Ccc::getModel('Admin')->load($getId);
        /*$adminTable = new Model_Admin();*/
        try
        {
            if (!isset($getId))
            {
                $message->addMessage('Invalid Request.',Model_Core_Message::ERROR);         
                $this->redirect($this->getUrl('grid')); 
               // throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $admin->delete(); 
            if (!$result)
            {
                $message->addMessage('System is unable to delete record.',Model_Core_Message::ERROR);           
                $this->redirect($this->getUrl('grid')); 
               // throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Admin Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','admin',null,true));
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
