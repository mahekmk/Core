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
        try
        {
            $categoryId = (int)$this->getRequest()->getRequest('categoryId');
            if(!$categoryId)
            {
                throw new Exception("Error Processing Request edit 1", 1);
            }
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = $categoryId");
            
            if(!$category)
            {
                throw new Exception("Error Processing Request edit 2", 1);
            }
            Ccc::getBlock('Category_Edit')->addData('category', $category)->toHtml();
            
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock('Category_Add')->toHtml();
    }

    public function saveAction()
    {
        global $adapter;
        $categoryModel = Ccc::getModel('Category');
        $categoryData = $this->getRequest()->getRequest('category');
        try 
        {
            if (!$this->getRequest()->getRequest('category')) 
            {
                throw new Exception("Invalid Request.", 1);
            }
            $date = date('Y-m-d H:i:s');
            $categoryData = $this->getRequest()->getRequest('category');
            $name = $categoryData['name'];
            $parentId = $categoryData['parentId'];
            $status = $categoryData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $categoryData))
            {
                if (!(int)$categoryData['categoryId'])
                {
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryId = $categoryData['categoryId'];
                if (!$parentId)
                {
                    $updateResult = $categoryModel->update(['name' => $name , 'parentId' => null , 'status' => $status , 'updatedAt' => $updatedAt],['categoryId' => $categoryId]);
                    if(!$updateResult)
                    {
                        throw new Exception("System is unable to update the record.", 1);
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                else
                {
                    $result = $categoryModel->update(['name' => $name , 'parentId' => $parentId , 'status' => $status , 'updatedAt' => $updatedAt],['categoryId' => $categoryId]);
                    if(!$result) 
                    {
                        throw new Exception("System is unable to update the record.", 1);
                    }
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                
            }
            else 
            {
                if (!$parentId)
                {
                    $insert = $categoryModel->insert(['name' => $name,'createdAt' => $date,'status' => $status]);
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                        $result1 = $categoryModel->update(['path' => $insert],['categoryId' => $insert]);
                        if (!$result1)
                        {
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                else
                {
                   $insert = $categoryModel->insert(['name' => $name ,'createdAt' => $date ,'status' => $status ,'parentId' => $parentId ]);
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                        $query2 = "SELECT `path` FROM category WHERE categoryId = '$parentId'";
                        $result2 = $adapter->fetchOne($query2);
                        $output = $result2 . '/' . $insert;
                        //$query3 = "UPDATE category SET path = '$output' WHERE categoryId = '$insert'";
                        $result3 = $categoryModel->update(['path' => $output],['categoryId' => $insert]);
                        if (!$result3)
                        {
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                
            }
            $this->redirect($this->getUrl('grid','category',null,true));
        } 

        catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','category',null,true));
        }
    }

    public function deleteAction()
    {
        $categroyModel = Ccc::getModel('Category');
        $getId = $this->getRequest()->getRequest('categoryId');
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $categoryId = $getId;
            $result = $categroyModel->delete(['categoryId' => $categoryId]);
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $this->redirect($this->getUrl('grid','category',null,true));
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
        $categroyModel = Ccc::getModel('Category');
        global $adapter;
        $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
        $result = $adapter->fetchOne($query);
        
        $output = $result . '/%';
        $path = $adapter->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
        if (!$path) 
        {
            $newPath = $categoryId; 
        }
        else 
        {
            $newPath = $path . '/' . $categoryId;           
        }
        $updatePath = $categroyModel->update(['path' => $newPath],['categoryId' => $categoryId]);
        $categories = $categroyModel->fetchAll("SELECT * FROM category WHERE path LIKE('$output') ORDER BY path");
        if(!$categories) 
        { 
            echo 'No others paths found....';
        }
        else
        {
            foreach ($categories as $categoryId => $category) 
            {
                $newParentId = $category['parentId'];
                $newCategoryId = $category['categoryId'];
                $getParentPath = $adapter->fetchOne("SELECT path FROM category WHERE categoryId='$newParentId'");
                $updatedPath = $getParentPath . '/' . $category['categoryId'];
                $updateResult = $categroyModel->update(['path' => $updatedPath],['categoryId' => $newCategoryId]);
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
