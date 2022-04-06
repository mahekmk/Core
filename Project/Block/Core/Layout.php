<?php 

Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Core_Layout_Header');
Ccc::loadClass('Block_Core_Layout_Footer');
Ccc::loadClass('Block_Core_Layout_Content');

class Block_Core_Layout extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/core/layout.php');
		$this->setLayout($this);
	}
	
	public function getHead()
	{
		
		$child = Ccc::getBlock('Core_Layout_Head');
		if(array_key_exists('head',$this->children))
		{
			$child = $this->getChild('head');
		}
		
		$this->children['head'] = $child;
		
		return $child;
	}
	
	public function getHeader()
	{
		$child = $this->getChild('header');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header');
			$this->addChild($child,'header');
		}
		return $child;

	}

	public function getFooter()
	{
		$child = $this->getChild('footer');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->addChild($child,'footer');
		}
		return $child;
	}

	public function getContent()
	{
		$child = $this->getChild('content');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->addChild($child,'content');
		}
		return $child;
	}

	
}