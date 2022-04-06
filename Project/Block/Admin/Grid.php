<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Admin_Grid extends Block_Core_Grid
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
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getAdmins());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('adminId', [
			'title' => 'Admin Id',
			'type' => 'int',
		]);

		$this->addColumn('firstName',[
			'title' => 'First Name',
			'type' => 'varchar',
		]);

		$this->addColumn('lastName',[
			'title' => 'Last Name',
			'type' => 'varchar',
		]);

		$this->addColumn('email',[
			'title' => 'Email',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'UpdatedAt',
			'type' => 'datetime',
		]);

		return $this;
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
