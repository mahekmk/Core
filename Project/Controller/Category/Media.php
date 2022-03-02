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
      //global $adapter;
      try 
      {
          $categoryId = $this->getRequest()->getRequest('id');

          $media = Ccc::getModel('Category_Media');
          print_r($media);
          //exit();

          if(!$this->getRequest()->isPost()){
            throw new Exception("Invalid Request" , 1);
          }

          $rows = $this->getRequest()->getPost();
          /*echo "<pre>";
          print_r($rows);*/

         $media = $rows['media'];
 //-------------------------------------------------------------------Remove--------------------------------
      
       if(array_key_exists('remove',$media))
         {
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
         }  
//--------------------------------------------------------------------------Base--------------------------

         if(array_key_exists('base',$media))
         {
            $baseId = $rows['media']['base'];
            $query = "UPDATE `category_media` SET base = 1 WHERE imageId = {$baseId}";
            $result = $this->getAdapter()->update($query);
         }

//--------------------------------------------------------------------------Small--------------------------
         if(array_key_exists('small',$media))
         {
            $smallId = $rows['media']['small'];
            $query = "UPDATE `category_media` SET small = 1 WHERE imageId = {$smallId}";
            $result = $this->getAdapter()->update($query);
         }
//--------------------------------------------------------------------------Thumb--------------------------
         if(array_key_exists('thumb',$media))
         {
            $thumbId = $rows['media']['thumb'];
            $query = "UPDATE `category_media` SET thumb = 1 WHERE imageId = {$thumbId}";
           $result = $this->getAdapter()->update($query);
         }
 //------------------------------------------------------------------------Redirect-----------------------


          $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId]));

      } catch (Exception $e) 
      {
          
      }
   }

   public function addAction()
   {
      
      $categoryId = $_GET['id'];

      //$mediaTable = Ccc::getModel('Media_Resource');
      $imageName1 = $_FILES['image']['name'];
      $imageAddress1 = $_FILES['image']['tmp_name'];
      $imageName = implode("", $imageName1);
      $imageName = date("mjYhis")."-".$imageName;
      $imageAddress = implode("", $imageAddress1);
      // $media = Ccc::getModel('Category_Media');   
      //$media = $mediaModel->getRow();

      //  $row = $this->getRequest()->getRequest('category_media');
         
      if(move_uploaded_file($imageAddress , $this->getBaseUrl('Media/category/') . $imageName))
         {
            //global $adapter;
            $query =  "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($categoryId,'$imageName',0,0,0,0,0)";
           
            $result = $this->getAdapter()->insert($query);
           

           $this->redirect($this->getUrl('grid','category_media',['id'=> $categoryId]));
         }
         else
         {
            //$this->redirect($this->getUrl('grid','category_media',['id' =>  $categoryId],true));
         }  
}
   }


   /*public function saveAction()
   {
      $categoryId = $_GET['id'];
      print_r($categoryId);
      die;
      if(!isset($_POST['submit']))
      {
         
         $imageName = $_FILES['image']['name'];
         $tempImageName = $_FILES['image']['tmp_name'];
         $name = implode("",$imageName);
         $tempImageName1 =implode("",$tempImageName);
         $imageExt = pathinfo($name,PATHINFO_EXTENSION);
         $name1 =  date("mjYHis") . $name ."." .$imageExt ;

         $folderName = 'E:\xampp\htdocs\Cybercom\Core\Project\Media/' . $name1;
         //print_r($imageName);
         if(move_uploaded_file($tempImageName1, $folderName)){

            $query = "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($categoryId,$name1,0,0,0,0,0)";
            //global $adapter;
            $insert = $this->getAdapter()->insert('$query');
            print_r("$insert");

         }

      }*/
   

?>




