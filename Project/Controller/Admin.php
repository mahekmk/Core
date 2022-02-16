<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Admin');

class Controller_Admin extends Controller_Core_Action
{
    public function testAction()
    { 
        $adminTable = new Model_Admin(); //Model_Core_Table
        echo '<pre>';
        //echo $adminTable->getTableName();

        $adminTable->setTableName('admin');
        $adminTable->setPrimaryKey('adminId');
       // $adminTable->insert(['firstName' => 'M' , 'lastName' => 'k' , 'email' => 'a@b.com' ,'password' => 'abc' , 'status' => '1' ]);
        

        $adminTable->update(['firstName' => 'R' , 'lastName' => 'K' ], ['adminId'=>9]); // array or id

        //$adminTable->delete(['adminId' => 6]); // array or id 
    
        $adminTable->fetchRow("SELECT * FROM admin WHERE adminId = 9");
        $adminTable->fetchAll("SELECT * FROM admin ");
    }

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $admins = $adapter->fetchAll("SELECT * FROM admin");
        $view = $this->getView();
        $view->addData('admins', $admins);
        $view->setTemplate('view/admin/grid.php');
        $view->toHtml();

        //require_once('view/admin/grid.php');       
    }

    public function editAction()
    {
        global $adapter; 
        $request = new Model_Core_Request();
        $getId = $request->getRequest('id');
        if ($getId)
        {
            $id = $getId;
            $admins = $adapter->fetchRow("SELECT * FROM admin  WHERE adminId = '$id'");
        }
        $view = $this->getView();
        $view->addData('admins', $admins);
        $view->setTemplate('view/admin/edit.php');
        $view->toHtml();
        //require_once('view/admin/edit.php');
    }

    public function addAction()
    {
        $view = $this->getView();
        $view->setTemplate('view/admin/add.php');
        $view->toHtml();
        //require_once('view/admin/add.php');    
    }

    public function saveAction()
    {
        try
        {
            global $adapter;
            $request = new Model_Core_Request();
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $request->getPost('admin');
            $id = $row['id'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $password = $row['password'];
            $status = $row['status'];
            $createdAt = $date;
            $updatedAt = $date;

            if (!$id):
                $query = "INSERT INTO `admin`(`firstName`,`lastName`,`password`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName',md5('$password'),'$email','$status','$date')";
                $result = $adapter->insert($query);
                if (!$result):
                    throw new Exception("System is unable to insert admin info.", 1);
                endif;

            else:

            $query = "UPDATE admin 
			SET firstName='$firstName' ,
				lastName='$lastName' ,  
				password=md5('$password') , 
				email='$email' ,
				status='$status' , 
				updatedAt='$date' 
			WHERE adminId = '$id'";
                $result = $adapter->update($query);
                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }

            endif;
            $this->redirect('index.php?c=admin&a=grid');
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $request = new Model_Core_Request();
        $getId = $request->getRequest('id');
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $adapter = new Model_Core_Adapter();
            $id = $getId;
            $result = $adapter->delete("DELETE FROM admin WHERE adminId = '$id'  ");
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect('index.php?c=admin&a=grid');
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
