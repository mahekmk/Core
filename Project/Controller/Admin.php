<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        //$this->getLayout();
        //$this->renderLayout();
        Ccc::getBlock('Admin_Grid')->toHtml();      
    }

    public function editAction()
    {
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $admin = Ccc::getModel('Admin')->load($id);
            //$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE adminId = {$id} ");
            if(!$admin){
                throw new Exception("unable to load admin.");
            }
            Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();       
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $admin = Ccc::getModel('Admin');
        Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();
       //Ccc::getBlock('Admin_Add')->toHtml();  
    }

    public function saveAction()
    {
        try
        {

            $admin = Ccc::getModel('Admin');
            date_default_timezone_set("Asia/Kolkata");
            //$admin = $adminModel->getRow();
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('admin');
            //$id = $row['id'];
          /*  $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $password = $row['password'];
            $status = $row['status'];
            $createdAt = $date;
            $updatedAt = $date;*/
            if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL):

                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = $row['password'];
                $admin->status = $row['status'];
                $admin->save();

              /* $result = $adminModel->insert(['firstName' => $firstName , 'lastName' => $lastName , 'email' => $email ,'password' => $password , 'status' => $status ]);
                if (!$result):
                    throw new Exception("System is unable to insert admin info.", 1);
                endif;*/

            else:
                $admin->load($row['id']);
                $admin->adminId = $row["id"];
                $admin->firstName = $row['firstName'];
                $admin->lastName = $row['lastName'];
                $admin->email = $row['email'];
                $admin->password = $row['password'];
                $admin->status = $row['status'];
                $admin->updatedAt = $date;
                $result = $admin->save();

           /* $result = $adminModel->update(['firstName' => $firstName , 'lastName' => $lastName , 'email' => $email ,'password' => $password , 'status' => $status ,'updatedAt' => $date ], ['adminId'=> $id]);*/

                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }

            endif;
           $this->redirect($this->getUrl('grid','admin',null,true));
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
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
            $this->redirect($this->getUrl('grid','admin',null,true));
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
