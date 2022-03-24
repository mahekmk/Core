<?php

class Model_Core_Pager 
{
	protected $totalCount = 0;
	protected $perPageCountOptions = [2,4,5,10,15,20,100];
	protected $pageCount = 0;
	protected $perPageCount = 10;
	protected $start = 0;
	protected $end = 0;
	protected $prev = 0;
	protected $next = 0;
	protected $startLimit  = 0;
	protected $endLimit= 0;
	protected $current = 0;

	public function execute($totalCount , $current)
	{
		$rpp = Ccc::getFront()->getRequest()->getRequest('rpp');

		if(!in_array($rpp,$this->getPerPageCountOptions()))
		{
			$this->setPerPageCount(10);
			$viewModel = Ccc::getModel('Core_View');
			$viewModel->getUrl('grid',null,['p' => 1 ,'rpp' => 10],false);
		}
		else
		{
			$this->setPerPageCount($rpp);
		}
		$this->setTotalCount($totalCount);
		$this->setPageCount(ceil($this->getTotalCount()/$this->getPerPageCount()));
		$this->setStart('1');

		if($current > $this->getPageCount())
		{
			$this->setCurrent($this->getPageCount());
		}
		elseif($current < $this->getStart())
		{
			$this->setCurrent($this->getStart());
		}
		else
		{
			$this->setCurrent($current);
		}
		
		$this->setEnd($this->getPageCount());
		$this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1) );
		$this->setEndLimit($this->getPerPageCount() * $this->getCurrent() );
		$this->setPrev(($this->getCurrent() == $this->getStart()) ? null : $this->getCurrent() - 1);
		$this->setNext(($this->getCurrent() == $this->getEnd()) ? null : $this->getCurrent() + 1);

		
	}

	
	public function getPerPageCountOptions()
	{
		return $this->perPageCountOptions;
	}
	
	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount = $totalCount;
		return $this->totalCount;
	}

	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
		return $this->pageCount;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
	}

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
		return $this->perPageCount;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function setstart($start)
	{
		$this->start = $start;
		return $this->start;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setEnd($end)
	{
		$this->end = $end;
		return $this->end;
	}

	public function getPrev()
	{
		return $this->prev;
	}

	public function setPrev($prev)
	{
		$this->prev = $prev;
		return $this->prev;
	}

	public function getNext()
	{
		return $this->next;
	}

	public function setNext($next)
	{
		$this->next = $next;
		return $this->next;
	}

	public function getStartLimit()
	{
		return $this->startLimit;
	}

	public function setStartLimit($startLimit)
	{
		$this->startLimit = $startLimit;
		return $this->startLimit;
	}

	public function getEndLimit()
	{
		return $this->endLimit;
	}

	public function setEndLimit($endLimit)
	{
		$this->endLimit = $endLimit;
		return $this->endLimit;
	}

	public function getCurrent()
	{
		return $this->current;
	}

	public function setCurrent($current)
	{
		$this->current = $current;
		return $this->current;
	}

}