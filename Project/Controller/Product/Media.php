<?php

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Product_Media extends Controller_Core_Action{

   public function gridAction()
   { 
         Ccc::getBlock('Product_Media_Grid')->toHtml();      
   }

   public function saveAction()
   {
      //global $adapter;
      try 
      {
          $productId = $this->getRequest()->getRequest('id');

          $media = Ccc::getModel('Product_Media');
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
            
            $query1 = "SELECT imageId , image FROM `product_media` WHERE imageId IN($removeIdsImplode) ";
            $result1 = $this->getAdapter()->fetchPairs($query1);

            $query="DELETE FROM `product_media` WHERE imageId IN($removeIdsImplode)";
            $result = $this->getAdapter()->delete($query);

            foreach($result1 as $key => $value){
               if($result)
               {
                  unlink($this->getBaseUrl('Media/product/') . $value);
               }
            }
         }

//------------------------------RESET status,small,base,thumb,gallery--------------------------------------

            $query = "SELECT imageId,productId FROM `product_media` WHERE productId = $productId";

            $result = $this->getAdapter()->fetchPairs($query);
            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);
            
            $query = "UPDATE `product_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";
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
            $query = "UPDATE `product_media` SET status = 1 WHERE imageId IN ($statusIdsImplode)";
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
            $query = "UPDATE `product_media` SET gallery = 1 WHERE imageId IN ($galleryIdsImplode)";
            $result = $this->getAdapter()->update($query);
         }  
//--------------------------------------------------------------------------Base--------------------------

         if(array_key_exists('base',$media))
         {
            $baseId = $rows['media']['base'];
            $query = "UPDATE `product_media` SET base = 1 WHERE imageId = {$baseId}";
            $result = $this->getAdapter()->update($query);
         }

//--------------------------------------------------------------------------Small--------------------------
         if(array_key_exists('small',$media))
         {
            $smallId = $rows['media']['small'];
            $query = "UPDATE `product_media` SET small = 1 WHERE imageId = {$smallId}";
            $result = $this->getAdapter()->update($query);
         }
//--------------------------------------------------------------------------Thumb--------------------------
         if(array_key_exists('thumb',$media))
         {
            $thumbId = $rows['media']['thumb'];
            $query = "UPDATE `product_media` SET thumb = 1 WHERE imageId = {$thumbId}";
           $result = $this->getAdapter()->update($query);
         }
 //------------------------------------------------------------------------Redirect-----------------------


          $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));

      } catch (Exception $e) 
      {
          
      }
   }

   public function addAction()
   {

      try 
      {
         
         $productId = $_GET['id'];
         $imageName1 = $_FILES['image']['name'];
         $imageAddress1 = $_FILES['image']['tmp_name'];
         $imageName = implode("", $imageName1);
         $imageName = date("mjYhis")."-".$imageName;
         $imageAddress = implode("", $imageAddress1);
     
         if(move_uploaded_file($imageAddress , $this->getBaseUrl('Media/product/') . $imageName))
         {
            $query =  "INSERT INTO `product_media`( `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($productId,'$imageName',0,0,0,0,0)";
           
            $result = $this->getAdapter()->insert($query);
           

           $this->redirect($this->getUrl('grid','product_media',['id'=> $productId]));
         }
         else
         {
            $this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
         }

      } catch (Exception $e) {
         
      }

       
      }
   }


   
   

?>




