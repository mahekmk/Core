<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>
<?php
class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY path");
        //echo "<pre>";
        $view = $this->getView();
        $view->addData('categories', $categories);
        $view->setTemplate('view/category/grid.php');
        $view->toHtml();

        /*require_once('view/category/grid.php');*/
    }

    public function editAction()
    {
        $adapter = new Model_Core_Adapter();
        if ($_GET["id"])
        {
            $id = $_GET["id"];
            $categories = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryId` = $id");
        }
        $view = $this->getView();
        $view->addData("categories", $categories);
        $view->setTemplate("view/category/edit.php");
        $view->toHtml();
    

        //require_once ('view/category/edit.php');
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

            else
            {

                if(!$parentId)
                {
                    $parentId = NULL;
                    $this->updatePathIntoCategory($id,$parentId);
                }
                else
                {
                    $this->updatePathIntoCategory($id,$parentId);
                }
            }          	
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
            $pid = $getId;
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

    public function updatePathIntoCategory($id,$parentId)
    {
        
        $adapter = new Model_Core_Adapter();
        $query = "SELECT path FROM category WHERE categoryId = '$id'";
        $result = $adapter->fetchOne($query);
        $output = $result . '/%';
        $pathQuery="SELECT path FROM category WHERE categoryId = '$parentId'";
        $path = $adapter->fetchOne($pathQuery);
        $newPath = $path . '/' . $id;
        $updatePath = $adapter->update("UPDATE category SET path = '$newPath' WHERE categoryId = '$id'");
        $categories = $adapter->fetchAll("SELECT * FROM category WHERE `path` LIKE('$output') ORDER BY `path`");
        print_r($categories);
        exit();
        if(!$categories) 
        { 
            echo 'No others paths found....';
        }
        else {

            foreach ($categories as $id => $category) {
                $newParentId = $category['parentId'];
                $newCategoryId = $category['categoryId'];
                $getParentPath = $adapter->fetchOne("SELECT path FROM category WHERE categoryId='$newParentId'");
                $updatedPath = $getParentPath . '/' . $category['categoryId'];
                $updateResult = $adapter->update("UPDATE category
                                                    SET path = '$updatedPath'
                                                    WHERE categoryId = '$newCategoryId'");
            }
        }
    }
            /*$query1 = "SELECT parentId FROM category WHERE categoryId = ' $id '";
                $result1 = $adapter->fetchOne($query1);
                
                $query2 = "SELECT path FROM category WHERE categoryId = '$result1' ";
                $result2 = $adapter->fetchOne($query2);

                $path = $result2 . '/%';
                $newpath = $result2 . '/' . $id;

                $query3 = "SELECT * FROM category WHERE path LIKE '$path'";
                $categories = $adapter->fetchAll($query3);

                foreach($categories as $id => $category ){
                    $newCategoryId = $category['categoryId'];
                    $newParentId = $category['parentId'];*/
    

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
