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
        try{
            $categoryId = (int)$this->getRequest()->getRequest('categoryId');
            if(!$categoryId){
                throw new Exception("Error Processing Request edit 1", 1);
            }
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = $categoryId");
            
            if(!$category){
                throw new Exception("Error Processing Request edit 2", 1);
            }
            Ccc::getBlock('Category_Edit')->addData('category', $category)->toHtml();
            
            }catch(Exception $e){
                echo $e->getMessage();
            }
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
    

    public function addAction()
    {
        Ccc::getBlock('Category_Add')->toHtml();
    }

    public function saveAction()
    {
        $categoryData = $this->getRequest()->getRequest('category');
        try {
            if (!$this->getRequest()->getRequest('category')) {
                throw new Exception("Invalid Request.", 1);
            }
            global $adapter;
            $date = date('Y-m-d H:i:s');
            $categoryData = $this->getRequest()->getRequest('category');
            $name = $categoryData['name'];
            $parentId = $categoryData['parentId'];
            $status = $categoryData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $categoryData)) {
                if (!(int)$categoryData['categoryId']) {
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryId = $categoryData['categoryId'];
                if (!$parentId) {
                    $updateQuery = "UPDATE category
                                    SET name = '$name',
                                        parentId = null,
                                        status = '$status',
                                        updatedAt = '$updatedAt'
                                    WHERE categoryId = '$categoryId'";
                    $updateResult = $adapter->update($updateQuery);
                    if(!$updateResult) {
                        throw new Exception("System is unable to update the record.", 1);
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                else {
                    $query = "UPDATE category 
                        SET name = '$name',
                            parentId = '$parentId', 
                            status = '$status',
                            updatedAt = '$updatedAt' 
                        WHERE categoryId  = '$categoryId'";
                    $result = $adapter->update($query);
                    if(!$result) {
                        throw new Exception("System is unable to update the record.", 1);
                    }
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                
            }
            else 
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
                
            }
            $this->redirect("index.php?c=category&a=grid");

        } 

        catch (Exception $e) {
            $this->redirect("index.php?c=category&a=grid");
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


    public function deleteAction()
    {
        $request = new Model_Core_Request();
        $getId = $request->getRequest('categoryId');
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }

            $adapter = new Model_Core_Adapter();
            $categoryId = $getId;
            $query = "DELETE FROM category WHERE categoryId = '$categoryId' ";
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
            foreach ($id_array as $key => $categoryId)
            {
                if (array_key_exists($categoryId, $categoryIdName)):
                    array_push($temp, $categoryIdName[$categoryId]);
                endif;
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;
        }
        return ($category);
    }

    public function updatePathIntoCategory($categoryId, $parentId)
    {
        global $adapter;
        $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
        $result = $adapter->fetchOne($query);
        
        $output = $result . '/%';
        $path = $adapter->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
        if (!$path) {
            $newPath = $categoryId; 
        }
        else {
            $newPath = $path . '/' . $categoryId;           
        }
        
        $updatePath = $adapter->update("UPDATE category SET path = '$newPath' WHERE categoryId = '$categoryId'");
        $categories = $adapter->fetchAll("SELECT * FROM category WHERE path LIKE('$output') ORDER BY path");
        if(!$categories) 
        { 
            echo 'No others paths found....';
        }
        else {
            foreach ($categories as $categoryId => $category) {
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
