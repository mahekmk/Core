<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php

class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Category Grid');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock("Category_Grid");
        $content->addChild($categoryGrid);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Category Edit');
        try
        {
            $message = $this->getMessage();
            $categoryId = (int)$this->getRequest()->getRequest('categoryId');
            if(!$categoryId)
            {
                throw new Exception("Error Processing Request edit 1");
            }
            $category = Ccc::getModel('Category')->load($categoryId);
            
            if(!$category)
            {
                throw new Exception("Error Processing Request edit 2");
            }
            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock("Category_Edit")->setData(["category" => $category]);
            $content->addChild($categoryEdit);
            $this->renderLayout();  
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','category',null,true));
        }
    }

    public function addAction()
    {
        $this->setTitle('Category Add');
        $category = Ccc::getModel('Category');
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('Category_Edit')->setData(["category" => $category]);
        $content->addChild($categoryAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        $category = Ccc::getModel('Category');
        try 
        {       
            if (!$this->getRequest()->getRequest('category')) 
            {
                throw new Exception("Invalid Request.");
            }
            
            $date = date('Y-m-d H:i:s');
            $categoryData = $this->getRequest()->getRequest('category');
            $name = $categoryData['name'];
            $parentId = $categoryData['parentId'];
            $status = $categoryData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $categoryData) && $categoryData['categoryId'] != NULL)
            {   
                if (!(int)$categoryData['categoryId'])
                {
                    throw new Exception("Invalid Request.");
                }
               
                $categoryId = $categoryData['categoryId'];
                if (!$parentId)
                {   
                    $category->load($categoryId);     
                    $category->categoryId = $categoryId;
                    $category->name = $categoryData['name'];
                    $category->parentId = NULL;
                    $category->status = $categoryData['status'];
                    $category->updatedAt = $date;
                    $updateResult = $category->save();
                    if(!$updateResult)
                    {
                        $message->addMessage('System is unable to update the record.',Model_Core_Message::ERROR);            
                        $this->redirect($this->getUrl('grid','category',null,true));
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                else
                {  
                    $category->load($categoryId);
                    $category->categoryId = $categoryId;
                    $category->name = $categoryData['name'];
                    $category->parentId = $categoryData['parentId'];
                    $category->status = $categoryData['status'];
                    $category->updatedAt = $date;
                    $result = $category->save();

                    if(!$result) 
                    {
                        throw new Exception("System is unable to update the record.");
                    }
                    $this->updatePathIntoCategory($categoryId,$parentId);     
                }
                $message->addMessage('Data Updated Successfully.');
            }
            else 
            { 
                if (!$parentId)
                {
                    $category->name = $categoryData['name'];
                    $category->status = $categoryData['status'];
                    $insert = $category->save();
                    $insert = $insert->categoryId;
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.");
                    }
                    else
                    {
                        $category->load($insert);
                        $category->categoryId = $insert;
                        $category->path = $insert;
                        $result1 = $category->save();
                        if (!$result1)
                        {
                            throw new Exception("System is unable to insert.");
                        }
                    }
                }
                else
                {
                    $category->name = $categoryData['name'];
                    $category->parentId = $categoryData['parentId'];
                    $category->status = $categoryData['status'];
                    $category->createdAt = $date;
                    $insert = $category->save();
                    $insert = $insert->categoryId;
                    if (!$insert)
                    {
                        throw new Exception("System is unable to insert.");
                    }
                    else
                    {
                        $query2 = "SELECT `path` FROM category WHERE categoryId = '$parentId'";
                        $result2 = $this->getAdapter()->fetchOne($query2);
                        $output = $result2 . '/' . $insert;
                        $category->load($insert);
                        $category->categoryId = $insert;
                        $category->path = $output;
                        $result3 = $category->save();
                        if (!$result3)
                        {
                            throw new Exception("System is unable to insert.");
                        }
                    }
                }     
            }
            $message->addMessage('Data Inserted Successfully.');
            $this->redirect($this->getUrl('grid','category',null,true));
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','category',null,true));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('categoryId');
        $category = Ccc::getModel('Category')->load($getId);
        try
        {   
            $query1 = "SELECT imageId,image FROM category c LEFT JOIN category_media cm ON c.categoryId = cm.categoryId  WHERE c.categoryId = $getId;";
            $result1 = $this->getAdapter()->fetchPairs($query1);

            if (!$getId)
            {
               throw new Exception("Invalid Request.");
            }

            $result = $category->delete();
            foreach($result1 as $key => $value)
            {
               if($result)
               {  
                  unlink($this->getBaseUrl('Media/category/') . $value);
               }
            }

            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully.');
            $this->redirect($this->getUrl('grid','category',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);     
            $this->redirect($this->getUrl('grid','category',null,true));
        }
    }

    public function getCategoryWithPath()
    {    
        $category = [];
        $categoryIdName = $this->getAdapter()->fetchPairs('SELECT `categoryId` , `name` FROM `category`');
         if (!$this->getRequest()->getRequest('categoryId')) 
        {
            $query = "SELECT `categoryId`, `path` FROM `category` ORDER BY `path`"; 
        }
        else 
        {
            $categoryId = $this->getRequest()->getRequest('categoryId');
            $excludePath = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId = '$categoryId'");
            $excludePath = $excludePath . '/%';
            $query = "SELECT categoryId,path FROM category WHERE categoryId <> '$categoryId' AND path NOT LIKE('$excludePath') ORDER BY path";  
        }
        $categoryIdPath = $this->getAdapter()->fetchPairs($query);
        foreach ($categoryIdPath as $categoryId => $path)
        {
            $idArray = explode("/", $path);
            $temp = [];
            foreach ($idArray as $key => $categoryId)
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
        $message = $this->getMessage();
        $category = Ccc::getModel('Category');
        $query = "SELECT `path` FROM `category` WHERE `categoryId` = {$categoryId}";
        $result = $this->getAdapter()->fetchOne($query);   
        $output = $result . '/%';
        $path = $this->getAdapter()->fetchOne("SELECT `path` FROM `category` WHERE `categoryId` = {$parentId}");
        if (!$path) 
        {
            $newPath = $categoryId; 
        }
        else 
        {
            $newPath = $path . '/' . $categoryId;           
        }
        $category->load($categoryId);
        $category->categoryId = $categoryId;
        $category->path = $newPath;
        $updatePath = $category->save();
        $query = "SELECT * FROM category WHERE path LIKE('$output') ORDER BY path";
        $categories = $category->fetchAll($query);
        if(!$categories) 
        { 
            $message->addMessage('Data Updated Successfully.');
            $this->redirect($this->getUrl('grid','category',null,true));
        }
        else
        {
            foreach ($categories as $categoryId => $category) 
            {
                $res = $category->getData();
                $parentId = $res['parentId'];
                $categoryId = $res['categoryId'];
                $newParentId = $parentId;
                $newCategoryId = $categoryId;
                $getParentPath = $this->getAdapter()->fetchOne("SELECT `path` FROM `category` WHERE `categoryId`={$newParentId}");
                $updatedPath = $getParentPath . '/' . $categoryId;   
                $category->load($newCategoryId);
                $category->categoryId = $newCategoryId;
                $category->path = $updatedPath;
                $updateResult = $category->save();
            }
        }
        $message->addMessage('Data Updated Successfully.'); 
        $this->redirect($this->getUrl('grid','category',null,true)); 
    }

    public function errorAction()
    {
        echo "echo";
    }
}

?>
