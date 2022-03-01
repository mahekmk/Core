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
            $category = Ccc::getModel('Category')->load($categoryId);
            //$category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = $categoryId");
            
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
        $category = Ccc::getModel('Category');
        Ccc::getBlock('Category_Edit')->addData('category', $category)->toHtml();
        //Ccc::getBlock('Category_Add')->toHtml();
    }

    public function saveAction()
    {
        //global $adapter;
        $category = Ccc::getModel('Category');
        //$category = $category -> getRow();
        //$categoryData = $this->getRequest()->getRequest('category');
        try 
        {
            //echo 1;
            if (!$this->getRequest()->getRequest('category')) 
            {
              //  echo 2;
                throw new Exception("Invalid Request.", 1);
            }
            //echo 3;
            $date = date('Y-m-d H:i:s');
            $categoryData = $this->getRequest()->getRequest('category');
            $name = $categoryData['name'];
            $parentId = $categoryData['parentId'];
            $status = $categoryData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $categoryData) && $categoryData['categoryId'] != NULL)
            {
               // echo 4;
                if (!(int)$categoryData['categoryId'])
                {
                 //   echo 5;
                    throw new Exception("Invalid Request.", 1);
                }
               // echo 6;
                $categoryId = $categoryData['categoryId'];
                if (!$parentId)
                {
                 //   echo 7;
                    $category->load($categoryId);
                    print_r( $category->load($categoryId));     
                    $category->categoryId = $categoryId;
                    $category->name = $categoryData['name'];
                    $category->parentId = NULL;
                    $category->status = $categoryData['status'];
                    $category->updatedAt = $date;
                    $updateResult = $category->save();
                    print_r($updateResult);


                   /* $updateResult = $categoryModel->update(['name' => $name , 'parentId' => null , 'status' => $status , 'updatedAt' => $updatedAt],['categoryId' => $categoryId]);*/
                    if(!$updateResult)
                    {
                   //     echo 8;
                        throw new Exception("System is unable to update the record.", 1);
                    }

                   // echo 9;
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId,$parentId);
                }
                else
                {
                    //echo 'a';
                    $category->load($categoryId);
                    $category->categoryId = $categoryId;
                    $category->name = $categoryData['name'];
                    $category->parentId = $categoryData['parentId'];
                    $category->status = $categoryData['status'];
                    $category->updatedAt = $date;
                    $result = $category->save();

                   /* $result = $categoryModel->update(['name' => $name , 'parentId' => $parentId , 'status' => $status , 'updatedAt' => $updatedAt],['categoryId' => $categoryId]);*/
                    if(!$result) 
                    {
                      //  echo 'b';
                        throw new Exception("System is unable to update the record.", 1);
                    }
                  //  echo 'c';
                    $this->updatePathIntoCategory($categoryId,$parentId);
                   
                }
                
            }
            else 
            {
              //  echo 'd';
                if (!$parentId)
                {
                //    echo 'e';
                    $category->name = $categoryData['name'];
                    //print_r($category->name);
                    $category->status = $categoryData['status'];
                    $insert = $category->save();
                    

                    /*$insert = $categoryModel->insert(['name' => $name,'createdAt' => $date,'status' => $status]);*/
                    if (!$insert)
                    {
                    //    echo 'f';
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                  //      echo 'g';
                        $category->load($insert);
                        $category->categoryId = $insert;
                        $category->path = $insert;
                        $result1 = $category->save();
                   
                       /* $result1 = $categoryModel->update(['path' => $insert],['categoryId' => $insert]);*/
                        if (!$result1)
                        {
                      //      echo 'h';
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                else
                {
                    //echo 'i';
                    $category->name = $categoryData['name'];
                    $category->parentId = $categoryData['parentId'];
                    $category->status = $categoryData['status'];
                    $category->createdAt = $date;
                    $insert = $category->save();

                   /*$insert = $categoryModel->insert(['name' => $name ,'createdAt' => $date ,'status' => $status ,'parentId' => $parentId ]);*/
                    if (!$insert)
                    {
                      //  echo 'j';
                        throw new Exception("System is unable to insert.", 1);
                    }
                    else
                    {
                        //echo 'k';
                        $query2 = "SELECT `path` FROM category WHERE categoryId = '$parentId'";
                        $result2 = $this->getAdapter()->fetchOne($query2);
                        $output = $result2 . '/' . $insert;
                        //$query3 = "UPDATE category SET path = '$output' WHERE categoryId = '$insert'";

                        $category->load($insert);
                        $category->categoryId = $insert;
                        $category->path = $output;
                        $result3 = $category->save();

                        /*$result3 = $categoryModel->update(['path' => $output],['categoryId' => $insert]);*/
                        if (!$result3)
                        {
                          //  echo 'l';
                            throw new Exception("System is unable to insert.", 1);
                        }
                    }
                }
                
            }
           /* exit();*/
            $this->redirect($this->getUrl('grid','category',null,true));
        } 

        catch (Exception $e) 
        {
            $this->redirect($this->getUrl('grid','category',null,true));
        }
    }

    public function deleteAction()
    {
        $getId = $this->getRequest()->getRequest('categoryId');
        $category = Ccc::getModel('Category')->load($getId);
        try
        {
            
            $query1 = "SELECT imageId,image FROM category c LEFT JOIN category_media cm ON c.categoryId = cm.categoryId  WHERE c.categoryId = $getId;";

            $result1 = $this->getAdapter()->fetchPairs($query1);

            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
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
        //global $adapter;
        $category = [];
        $categoryIdName = $this->getAdapter()->fetchPairs('SELECT categoryId , name FROM category');
         if (!$this->getRequest()->getRequest('categoryId')) 
        {
            $query = "SELECT categoryId, path FROM category ORDER BY path"; 
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
        $category = Ccc::getModel('Category');
        //global $adapter;
        $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
        $result = $this->getAdapter()->fetchOne($query);
        //print_r($result);
        
        $output = $result . '/%';
       // print_r($output);
        $path = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
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
        //print_r($query);

        $categories = $category->fetchAll($query);
        if(!$categories) 
        { 
            $this->redirect($this->getUrl('grid','category',null,true));
            echo 'No others paths found....';
        }
        else
        {
            /*print_r($categories);
            exit();*/
            foreach ($categories as $categoryId => $category) 
            {
                $res = $category->getData();
                $parentId = $res['parentId'];
                $categoryId = $res['categoryId'];
                $newParentId = $parentId;
                $newCategoryId = $categoryId;
                $getParentPath = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId='$newParentId'");
                $updatedPath = $getParentPath . '/' . $categoryId;
                
                $category->load($newCategoryId);
                $category->categoryId = $newCategoryId;
                $category->path = $updatedPath;
                $updateResult = $category->save();

                /*$updateResult = $category->update(['path' => $updatedPath],['categoryId' => $newCategoryId]);*/
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
