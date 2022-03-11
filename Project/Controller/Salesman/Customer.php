<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid');
        $content->addChild($salesmanCustomerGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try 
        {
            $customer = $this->getRequest()->getRequest('customerWithNoSalesman'); 
            $customerIds = $customer['customer']; 
            $customer = Ccc::getModel('customer');
            $result = $customer->saveSalesmanInfo($customerIds);

            if(!$result)
            {
               throw new Exception('No record.'); 
            }

            $message->addMessage('Data Updated Successfully');
            $this->redirect($this->getUrl('grid','Salesman_Customer',null,false));
        } catch (Exception $e) {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','Salesman_Customer',null,true));
        }
        
    }
}