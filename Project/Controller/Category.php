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

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Index');
        $content->addChild($categoryGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $categoryGrid = Ccc::getBlock("Category_Grid")->toHtml();
         $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         $response = [
            'status' => 'success',
            'content' => $categoryGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $category = Ccc::getModel('Category');
        Ccc::register('category',$category);
        $media = $category->getMedias();
        Ccc::register('media',$media);
        $categoryAdd =$this->getLayout()->getBlock('Category_Edit')->toHtml();
        $response = [
            'status' => 'success',
            'content' => $categoryAdd
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $categoryModel = Ccc::getModel('category')->load($id);
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = $id");
            $media = $category->getMedias();
                
            Ccc::register('category',$category);
                Ccc::register('media',$media);
            if(!$category)
            {
                throw new Exception("unable to load category.");
            }
            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock("category_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $categoryEdit
        ];
        $this->renderJson($response);
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
            $this->redirect($this->getLayout()->getUrl('grid','category',null,true));
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
                    $resultCategoryId = $updateResult->categoryId;
                    if(!$updateResult)
                    {
                        $message->addMessage('System is unable to update the record.',Model_Core_Message::ERROR);            
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
                    $resultCategoryId = $result->categoryId;


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
                    $resultCategoryId = $insert->categoryId;

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
                        $resultCategoryId = $result1->categoryId;
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
                    $resultCategoryId = $insert->categoryId;

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
                        $resultCategoryId = $result3->categoryId;

                        if (!$result3)
                        {
                            throw new Exception("System is unable to insert.");
                        }
                    }
                }     
            }
            $message->addMessage('Data Inserted Successfully.');
            $this->redirect($this->getLayout()->getUrl('editBlock','category',['id' => $resultCategoryId,'tab' => 'media'],false));
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('editBlock','category',['tab' => 'media'],false));
        }
    }

    public function deleteAction()
    {
        $adapter = $this->getAdapter();
        try 
        {
            $message = $this->getMessage();
            $mediaModel = Ccc::getModel('Category_Media');
            $id = $this->getRequest()->getRequest('id');
            $category = Ccc::getModel('Category')->load($id);

            $query1 = "SELECT imageId,image FROM category c LEFT JOIN `category_media` cm ON c.categoryId = cm.categoryId  WHERE c.categoryId = $id;";
            $result1 = $adapter->fetchPairs($query1);


            if (!$id) 
            {
                throw new Exception("Invalid Request.");
            }
            
            $delete = $category->delete(['categoryId' => $id]); 
            if(!$delete)
            {
                throw new Exception("System is unable to  delete.");
            }

            foreach($result1 as $key => $value){
            if($delete)
            {
              unlink($mediaModel->getImagePath() . $value);               }
            }
            $message->addMessage('Delete Successfully.');
            $this->redirect($this->getLayout()->getUrl('gridBlock','category',['id' => null],false));       
        } catch (Exception $e) {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('gridBlock','category',['id' => null],false));           
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
            $this->redirect($this->getLayout()->getUrl('editBlock','category',['id' => $categoryId,'tab' => 'media'],false));
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
       $this->redirect($this->getLayout()->getUrl('editBlock','category',['id' => $categoryId,'tab' => 'media'],false));
    }

    public function errorAction()
    {
        echo "echo";
    }
}

?>
