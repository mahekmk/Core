<?php //require_once("Model/Core/Adapter.php");
 ?>
<?php
Ccc::loadClass('Controller_Core_Action');
class Controller_admin extends Controller_Core_Action
{
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
        $adapter = new Model_Core_Adapter();
        if ($_GET['id'])
        {
            $id = $_GET['id'];
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

            $adapter = new Model_Core_Adapter();
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $id = $_POST['admin']['id'];
            $firstName = $_POST['admin']['firstName'];
            $lastName = $_POST['admin']['lastName'];
            $email = $_POST['admin']['email'];
            $password = $_POST['admin']['password'];
            $status = $_POST['admin']['status'];
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
        try
        {
            if (!isset($_GET['id']))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $adapter = new Model_Core_Adapter();
            $id = $_GET['id'];
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
