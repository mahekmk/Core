<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>
<?php
class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Category_Grid')->toHtml();
    }

    public function editAction()
    {
        global $adapter;
        $view = $this->getView();
        try 
        {
            $pid = (int) $this->getRequest()->getRequest('id');
            if(!$pid){
                throw new Exception("Id not valid.");
            }
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = {$pid} ");
            Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml(); 
            $categoryPathPair = $adapter->fetchPairs('SELECT categoryId,categoryPath FROM Category');
            $view->addData('categoryPathPair',$categoryPathPair);
            $categoryPath = $this->getCategoryWithPath();
            $view->addData('categoryPath',$categoryPath);
            $view->toHtml();
               
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }

        /*$adapter = new Model_Core_Adapter();      
        $id=$_GET['id'];
        $query = "SELECT * FROM Category WHERE categoryId={$id}";
        $category = $adapter-> fetchRow($query);
        $view = $this->getView();
        
        $view->setTemplate('view/category/edit.php');
        $view->addData('category',$category);
        
        $categoryPathPair = $adapter->fetchPairs("SELECT categoryId,categoryPath FROM category");
        $view->addData('categoryPathPair',$categoryPathPair);
 
        $categoryPath = $this->getCategoryWithPath();
        $view->addData('categoryPath',$categoryPath);
        $view->toHtml();*/
    }

    public function addAction()
    {
        Ccc::getBlock('Category_Add')->toHtml();
    }

    public function saveAction()
    {
        try 
        {   global $adapter;
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
                $this->redirect($this->getUrl('grid','category',null,true));
            }

            else
            {

                global $adapter;
                $category = $_POST['category'];
                $path = '';

                if (array_key_exists('id', $category)) 
                {
                    if(!(int)$category['id'])
                    {
                        throw new Exception("Invalid Request.", 1);
                    }
                    $query = "UPDATE category 
                    SET name='".$category['name']."',
                    updatedAt='".$date."',
                    status='".$category['status']."'
                    WHERE categoryId='".$category['id']."'"; 

                    $update = $adapter->update($query);
                    if(!$update)
                    {
                        throw new Exception("System is unable to update.", 1);
                    }
                    $result = $this->updatePathIntoCategory($category['id'],$category['parentId']);     
                }

                else
                {
                    if ($category['parentId'] == 'NULL') 
                    {
                        $query = "INSERT INTO Category(name,createdAt,status) 
                        VALUES('".$category['name']."',
                               '".$date."',
                               '".$category['status']."')";
                    }
                                 
                }
            }
            $this->redirect("index.php?c=category&a=grid");
        }
        catch (Exception $e) 
        {
             $this->redirect($this->getUrl('grid','category',null,true)); 
        }
    }

            /*if (!isset($_POST['category'])) 
            {
                throw new Exception("Invalid Request.", 1);             
            }
            global $adapter;
            global $date;
            $category = $_POST['category'];
            $path = '';

            if (array_key_exists('id', $category)) 
            {
                if(!(int)$category['id'])
                {
                    throw new Exception("Invalid Request.", 1);
                }
                
                $query = "UPDATE Category 
                SET name='".$category['name']."',
                    updatedAt='".$date."',
                    status='".$category['status']."'
                WHERE categoryId='".$category['id']."'";
                $update = $adapter->update($query);
                if(!$update)
                {
                    throw new Exception("System is unable to update.", 1);
                }
                $result = $this->updatePathIntoCategory($category['id'],$category['parentId']);
                
            }
            else
            {
                if ($category['parentId'] == 'NULL') 
                {
                    $query = "INSERT INTO Category(name,createdAt,status) 
                    VALUES('".$category['name']."',
                           '".$date."',
                           '".$category['status']."')";
                }
                             
            }*/
     
    
    public function updatePathIntoCategory($categoryId,$parentId)
    {
        global $adapter;
        global $date;

        $category=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
        $categoryPath=$adapter->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category['categoryPath'].'/%'."' ORDER BY categoryPath");
        if($parentId == 'NULL')
        {   
            $query = "UPDATE Category 
            SET parentId=null, 
            categoryPath= $categoryId
            WHERE categoryId=$categoryId";
        }
        else
        {
            $parent=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
            $query = "UPDATE Category 
            SET parentId=".$parentId.", 
            categoryPath= '".$parent['categoryPath'].'/'.$categoryId."' 
            WHERE categoryId=".$categoryId;
        }
        $update = $adapter->update($query);
        if(!$update)
        {
            echo "error";
            exit;
            throw new Exception("System is unable to update.", 1);
        }   
        foreach ($categoryPath as $category) 
        {
            $parent=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$category['parentId']);
            $newPath = $parent['categoryPath'].'/'.$category['categoryId'];

            $query = "UPDATE Category
                SET categoryPath = '".$newPath."',
                    updatedAt = '".$date."'
                    WHERE categoryId = ".$category['categoryId'];
            $update = $adapter->update($query);
            if(!$update)
            {
                throw new Exception("System is unable to update.", 1);
            }   

        }
        $this->redirect("index.php?c=category&a=grid");
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
            $query = "DELETE FROM category WHERE categoryId = '$id' ";
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

   /* public function updatePathIntoCategory($id,$parentId)
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
       */     /*$query1 = "SELECT parentId FROM category WHERE categoryId = ' $id '";
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
