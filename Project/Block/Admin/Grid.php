<?php Ccc::loadClass('Block_Core_Grid_Collection'); ?>

<?php 
class Block_Admin_Grid extends Block_Core_Grid_Collection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($admin)
	{
		return $this->getUrl('edit',null,['id'=>$admin->adminId]);
	}
	
	public function getDeleteUrl($admin)
	{
		return $this->getUrl('delete',null,['id'=>$admin->adminId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			],'actions');
		return $this;
	}

	public function prepareCollections()
	{
		$this->addCollection([$this->getAdmins() ],'collection');
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'AdminId','First Name', 'Last Name','Email','Status','Created Date','Updated Date'
		],'columns');
	}
	
	public function getAdmins()
	{
		$admin = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$adminModel = Ccc::getModel('Admin');
		$totalCount = $adminModel->getAdapter()->fetchOne("SELECT count('adminId') FROM `admin`");
		$this->getPager()->execute($totalCount,$admin);
		$admins = $adminModel->fetchAll("SELECT `adminId`,`firstName`,`lastName`,`email`,`status`,`createdAt`,`updatedAt` FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $admins;
	}
}
