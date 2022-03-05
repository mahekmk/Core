<?php

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Category_Media extends Controller_Core_Action{

   public function gridAction()
   { 
         $content = $this->getLayout()->getContent();
        $mediaGrid = Ccc::getBlock("Category_Media_Grid");
        $content->addChild($mediaGrid);
        $this->renderLayout();     
   }

   public function saveAction()
   {
      $message = Ccc::getModel('Core_Message');
      try 
      {
          $categoryId = $this->getRequest()->getRequest('id');

          $media = Ccc::getModel('Category_Media');

        if(!$this->getRequest()->isPost())
        {
            throw new Exception("Invalid Request." , 1);
         }

         $rows = $this->getRequest()->getPost();
         $media = $rows['media'];
 //-------------------------------------------------------------------Remove--------------------------------
      
       if(array_key_exists('remove',$media))
         {
            $message = Ccc::getModel('Core_Message');
            $removeArr = $rows['media']['remove'];
            $removeIds = [];
            foreach($removeArr as $key => $value)
            {
               array_push($removeIds ,$value);
            }
           
            $removeIdsImplode = implode(",",$removeIds);
            
             $query1 = "SELECT imageId , image FROM `category_media` WHERE imageId IN($removeIdsImplode) ";
            $result1 = $this->getAdapter()->fetchPairs($query1);


            $query="DELETE FROM `category_media` WHERE imageId IN($removeIdsImplode)";
            $result = $this->getAdapter()->delete($query);

            if(!$result){
               throw new Exception("Unable to delete." , 1);
            }

             foreach($result1 as $key => $value){
               if($result)
               {
                  unlink($this->getBaseUrl('Media/category/') . $value);
               }
            }
         }

//------------------------------RESET status,small,base,thumb,gallery--------------------------------------

            $query = "SELECT imageId,categoryId FROM `category_media` WHERE categoryId = $categoryId";

            $result = $this->getAdapter()->fetchPairs($query);
            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);
            
            $query = "UPDATE `category_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";
            $result = $this->getAdapter()->update($query);      


//--------------------------------------------------------------------------Status--------------------------
         if(array_key_exists('status',$media))
         {
            $statusArr = $rows['media']['status'];
            $statusIds = [];
            foreach($statusArr as $key => $value)
            {
               array_push($statusIds,$value);
            } 
            $statusIdsImplode = implode(",",$statusIds);
            $query = "UPDATE `category_media` SET status = 1 WHERE imageId IN ($statusIdsImplode)";
            $result = $this->getAdapter()->update($query);
            if(!$result){
               throw new Exception("Unable to update status." , 1);
            }
         }
//------------------------------------------------------------------------gallery--------------------------

         if(array_key_exists('gallery',$media))
         {
            $galleryArr = $rows['media']['gallery'];
            $galleryIds = [];
            foreach($galleryArr as $key => $value)
            {
               array_push($galleryIds,$value);
            } 
            $galleryIdsImplode = implode(",",$galleryIds);
            $query = "UPDATE `category_media` SET gallery = 1 WHERE imageId IN ($galleryIdsImplode)";
            $result = $this->getAdapter()->update($query);
            if(!$result){
                $message->addMessage('Unable to update gallery',Model_Core_Message::ERROR);
            }
         }  
//--------------------------------------------------------------------------Base--------------------------

         if(array_key_exists('base',$media))
         {
            $baseId = $rows['media']['base'];
            $query = "UPDATE `category_media` SET base = 1 WHERE imageId = {$baseId}";
            $result = $this->getAdapter()->update($query);
            if(!$result){
               throw new Exception("Unable to update base image." , 1);
            }
         }

//--------------------------------------------------------------------------Small--------------------------
         if(array_key_exists('small',$media))
         {
            $smallId = $rows['media']['small'];
            $query = "UPDATE `category_media` SET small = 1 WHERE imageId = {$smallId}";
            $result = $this->getAdapter()->update($query);
            if(!$result){
               throw new Exception("Unable to update small image." , 1);
            }
         }
//--------------------------------------------------------------------------Thumb--------------------------
         if(array_key_exists('thumb',$media))
         {
            $thumbId = $rows['media']['thumb'];
            $query = "UPDATE `category_media` SET thumb = 1 WHERE imageId = {$thumbId}";
           $result = $this->getAdapter()->update($query);
           if(!$result){
               throw new Exception("Unable to update thumb image." , 1);
            }
         }
 //------------------------------------------------------------------------Redirect-----------------------

         $message->addMessage('Data Updated Successfully'); 
         $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId]));

      } catch (Exception $e) 
      {
         $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
         $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId])); 
      }
   }

   public function addAction()
   {
      $message = Ccc::getModel('Core_Message'); 
      try 
      {
      $categoryId = $_GET['id'];
      $imageName1 = $_FILES['image']['name'];
      $imageAddress1 = $_FILES['image']['tmp_name'];
      $imageName = implode("", $imageName1);
      $imageName = date("mjYhis")."-".$imageName;
      $imageAddress = implode("", $imageAddress1);
         
      if(move_uploaded_file($imageAddress , $this->getBaseUrl('Media/category/') . $imageName))
         {
            $query =  "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($categoryId,'$imageName',0,0,0,0,0)";
           
            $result = $this->getAdapter()->insert($query);
           
            if(!$result)
            {
               throw new Exception("Image not added." , 1);
            }
            $message->addMessage('Image added Successfully.');
            $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId]));
         }
         else
         {
            $message->addMessage('Image not selected.',Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid','category_media',['id' =>  $categoryId],true));
         }
       } catch (Exception $e) 
       {
         $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
         $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId]));
      } 
   }
}

   

?>




