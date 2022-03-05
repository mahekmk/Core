<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Page extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();     
    }

    public function editAction()
    {
        $message = Ccc::getModel('Core_Message');
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Id not valid.");
            }
            $page = Ccc::getModel('Page')->load($id);
            if(!$page){
                throw new Exception("unable to load page.");
            }
            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock("Page_Edit")->addData("page", $page);
            $content->addChild($pageEdit);
            $this->renderLayout();      
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','page',null,true));
        }
    }

    public function addAction()
    {
        $page = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->addData('page',$page);
        $content->addChild($pageAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {

            $page = Ccc::getModel('Page');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getRequest('page');
            
            if (!isset($row)) {
                throw new Exception("Invalid Request.", 1);             
            }           
            if (array_key_exists('id',$row) && $row['id'] == NULL)
            {
            
                $page->name = $row['name'];
                $page->code = $row['code'];
                $page->content = $row['content'];
                $page->status = $row['status'];
                $page->createdAt = $date;
                $result = $page->save();

                 if (!$result)
                {
                     throw new Exception("System is unable to update information.", 1);
                }

                if($result)
                {
                    $message->addMessage('Data Added Successfully');
                }
            }
            else
            {

                $page->load($row['id']);
                $page->pageId = $row["id"];
                $page->name = $row['name'];
                $page->code = $row['code'];
                $page->content = $row['content'];
                $page->status = $row['status'];
                $page->updatedAt = $date;
                $result = $page->save();

                if (!$result)
                {
                    throw new Exception("System is unable to update information.", 1);
                }
                $message->addMessage('Data Updated Successfully'); 
            }

           $this->redirect($this->getUrl('grid','page',null,true));
        }

        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','page',null,true));
        }
    }

    public function deleteAction()
    {
        $message = Ccc::getModel('Core_Message');
        $getId = $this->getRequest()->getRequest('id');
        $page = Ccc::getModel('page')->load($getId);
        try
        {
            if (!isset($getId))
            {
                throw new Exception("Invalid Request.", 1);
            }
            $id = $getId;
            $result = $page->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.", 1);
            }
            $message->addMessage('Data Deleted Successfully');
            $this->redirect($this->getUrl('grid','page',null,true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','page',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
