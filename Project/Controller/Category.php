<?php
Ccc::loadClass('Controller_Core_Action');
?>
<?php
class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY path");
        echo "<pre>";
        $view = $this->getView();
        $view->addData('categories', $categories);
        $view->setTemplate('view/category/grid.php');
        $view->toHtml();

        /*require_once('view/category/grid.php');*/
    }

    public function editAction()
    {
        require_once ('view/category/edit.php');
    }

    public function addAction()
    {
        $adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/category/add.php');
        $view->toHtml();
        //require_once('view/category/add.php');
        
    }

    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        try
        {
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $id = $_POST['category']['id'];
            $name = $_POST['category']['name'];
            $parentId = $_POST['category']['parentId'];
            $status = $_POST['category']['status'];
            $createdAt = $date;
            $updatedAt = $date;
            echo $parentId;
            if (!$id)
            {
                if (!$parentId)
                {
                    $query = "INSERT INTO category(name,createdAt,status) VALUES ('$name' , '$date', '$status')";
                    $insert = $adapter->insert($query);
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                        $query1 = "UPDATE category SET path = '$insert' WHERE categoryId = '$insert'";
                        $result1 = $adapter->update($query1);
                        if (!$result1)
                        {
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                else
                {
                    $query = "INSERT INTO category(name,createdAt,status,parentId) VALUES ('$name' , '$date' , '$status' , '$parentId')";
                    $insert = $adapter->insert($query);
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                        $query2 = "SELECT `path` FROM category WHERE categoryId = '$parentId'";
                        $result2 = $adapter->fetchOne($query2);
                        $output = $result2 . '/' . $insert;
                        $query3 = "UPDATE category SET path = '$output' WHERE categoryId = '$insert'";
                        $result3 = $adapter->update($query3);
                        if (!$result3)
                        {
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                $this->redirect('index.php?c=category&a=grid');
            }
            else{
            $path = 1/2;
            $path = mysqli_real_escape_string($path);
            $query = "SELECT * FROM category WHERE path LIKE '{$path}%' ";
            $result = $adapter->fetchAll($query);
            print_r($result);
            exit(); 
        }
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
            $pid = $_GET['id'];
            $query = "DELETE FROM category WHERE categoryId = '$pid' ";
            $result = $adapter->delete($query);
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            //var_dump($result);
            $this->redirect('index.php?c=category&a=grid');
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function getCategoryWithPath()
    {
        $adapter = new Model_Core_Adapter();
        $category = [];
        $categoryIdName = $adapter->fetchPairs('SELECT categoryId , name FROM category');
        $categoryIdPath = $adapter->fetchPairs('SELECT categoryId , path FROM category');
        foreach ($categoryIdPath as $categoryId => $path)
        {
            $id_array = explode("/", $path);
            $temp = [];
            foreach ($id_array as $key => $Id)
            {
                if (array_key_exists($Id, $categoryIdName)):
                    array_push($temp, $categoryIdName[$Id]);
                endif;
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;
        }
        return ($category);
    }

    public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function errorAction()
    {
        echo "echo";
    }

}

?>
