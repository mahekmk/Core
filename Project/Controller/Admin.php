<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Admin extends Controller_Core_Action
{

    public function testAction()
    {
        echo "<pre>";
        /*$adminSession = Ccc::getModel('Admin_Session');
        $coreSession = Ccc::getModel('Core_Session');
        $message1 = Ccc::getModel('Core_Message');*/
        $message = $this->getMessage();
       /* print_r($message);
        print_r($message1);*/

        //$adminMessage = Ccc::getModel('Admin_Message');
        //$adminMessage = $this->getMessage();
        //print_r($adminMessage);

        $message->addMessage("helloooo");
        $message->addMessage("heoo");
        print_r($message->getSession());
        //print_r($adminSession);
        //print_r($coreSession);
        //print_r($adminMessage);
        //print_r($_SESSION);
        die;
    }

    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
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
            $admin = Ccc::getModel('Admin')->load($id);
            
            if(!$admin){
                throw new Exception("unable to load admin.");
            }
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit")->addData("admin", $admin);
            $content->addChild($adminEdit);
            $this->renderLayout();       
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','admin',null,true)); 
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
       $message = $this->getMessage();
        try
        {

            $admin = Ccc::getModel('Admin');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('admin');
            
            if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
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
                     throw new Exception("System is unable to update information.", 1);
                }

                if($result)
                {
                    $message->addMessage('Data Inserted Successfully');
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
                    throw new Exception("System is unable to update information.", 1);
                }
                $message->addMessage('Data Updated Successfully');   

            }
           $this->redirect($this->getUrl('grid','admin',null,true));
        }

        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','admin',null,true));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $admin = Ccc::getModel('Admin')->load($getId);
        /*$adminTable = new Model_Admin();*/
        try
        {
            if (!isset($getId))
            {
                 throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $admin->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Admin Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','admin',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','admin',null,true));
            
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
