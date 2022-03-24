<?php 

Ccc::loadClass('Controller_Core_Action');

class Controller_Admin_Login extends Controller_Core_Action
{
	public function loginAction()
	{
		if(Ccc::getModel('Admin_Login')->isLoggedIn())
		{
			$this->redirect($this->getLayout()->getUrl('grid','product',null,true));
		}
		echo Ccc::getBlock('Admin_Login')->toHtml();
	}

	public function loginPostAction()
	{
		try 
		{
			$message = $this->getMessage();
			if(!array_key_exists('admin', $this->getRequest()->getPost()))
			{
				throw new Exception("Invalid Request.");
				
			}
			$adminData = $this->getRequest()->getPost('admin');
			$result = Ccc::getModel('Admin_Login')->login($adminData['email'], $adminData['password']);
			if (!$result) 
			{
				throw new Exception("Email Address or Password Incorrect.");
			}
			$message->addMessage("Logged In successfully.");
			$this->redirect($this->getLayout()->getUrl('grid','product',null,true));
		} 
		catch (Exception $e) 
		{
			$message = $this->getMessage();
			$message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('login'));
		}
	}

	public function logoutAction()
	{
		try 
		{
			$result = Ccc::getModel('Admin_Login')->logout();
			if(!$result)
			{
				throw new Exception("Some error occur.");
			}
			$this->redirect($this->getLayout()->getUrl('login','admin_login',null,true));
		} 
		catch (Exception $e) 
		{
			echo 'some error';
		}
	}
}