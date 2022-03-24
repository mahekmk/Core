<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>

<?php
class Controller_Page extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Page Grid');
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();     
    }

    public function editAction()
    {
        $this->setTitle('Page Edit');
        $message = $this->getMessage();
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
            $pageEdit = Ccc::getBlock("Page_Edit")->setData(['page' => $page]);
            $content->addChild($pageEdit);
            $this->renderLayout();      
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));
        }
    }

    public function addAction()
    {
        $this->setTitle('Page Add');
        $page = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page' => $page]);
        $content->addChild($pageAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            $page = Ccc::getModel('Page');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('page');
            
            if (!$row) {
                throw new Exception("Invalid Request.");             
            }           
            $pageId = (int)$this->getRequest()->getRequest('id');
            $page = Ccc::getModel('Page')->load($pageId);
            if(!$page)
            {
                $page = Ccc::getModel('Page');
                $page->setData($row);
                $page->createdAt = $date;
            }
            else
            {
                $page->setData($row);
                $page->updatedAt = $date;
            }
            $result = $page->save();
                if (!$result)
                {
                    throw new Exception("System is unable to update information.");
                }
                $message->addMessage('Data Updated Successfully'); 

           $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }

        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,null,false));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $page = Ccc::getModel('page')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $page->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully');
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

?>
