<?php

class Model_Core_Row_Resource
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
	//protected $rowClassName;
  
	public function __construct()
    {
        
    }

    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }

	/*public function getRowClassName()
	{
		return $this->rowClassName;
	}

	public function setRowClassName($rowClassName)
	{
		$this->rowClassName = $rowClassName;
		return $this;
	}*/

	public function getRow()
	{
		return Ccc::getModel($this->getRowClassName());
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function insert(array $queryInsert)
    {
        if(!$queryInsert){
            return false;
        }
        $key = '`'.implode("`,`", array_keys($queryInsert)).'`';
        $value = '\''.implode("','", array_values($queryInsert)).'\'';

        $sqlResult = "INSERT INTO `{$this->getTableName()}` ({$key}) VALUES ({$value});";
        $result = $this->getAdapter()->insert($sqlResult);
        return $result;
    }

	public function delete(array $deleteArr)
	{ 
		$tableName = $this->getTableName();

		$key = key($deleteArr);
		$value = $deleteArr[$key];
		$delete = "DELETE FROM $tableName WHERE $key = $value;";
		$result = $this->getAdapter()->delete($delete);
		return $result;
	}

	public function update(array $updateArr , array $whereArr)
	{
		date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
		$set = [];
		$tableName = $this->getTableName();
		$key = key($whereArr);
		$value = $whereArr[$this->primaryKey];
		foreach($updateArr as $k => $v)
		{
			$set[] = "$k='$v'";
		}
		$imp = implode(',', $set);
		$update = "UPDATE $tableName SET $imp WHERE $key = $value;";
		//print_r($update);
		$result = $this->getAdapter()->update($update);
		return $result;
	}

	public function fetchRow($queryFetchRow)
  	{
		$tableName = $this->getTableName();
		$result = $this->getAdapter()->fetchRow($queryFetchRow);
		return $result;  
  	}

	public function fetchAll($queryFetchAll)
	{
		$tableName = $this->getTableName();
		$result = $this->getAdapter()->fetchAll($queryFetchAll);
		return $result;
	}

	/*public function load($id)
	{
		$rowData = $this->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");
		if(!$rowData)
		{
			return false;
		}
		$row = $this->getRow();
		$row->setData($rowData);
		return $row;
	}*/
}




/*class Model_Core_Table_Row
{
	protected $data = [];
	protected $tableClassName;

	public function getTableClassName()
	{
		return $this->tableClassName;
	}

	public function setTableClassName($tableClassName)
	{
		$this->tableClassName = $tableClassName;
		return $this;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
			return $this->data;
	}

	public function resetData()
	{
		$this->data = [];
		return $this;
	}

	public function __set($key ,$value )
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if(!array_key_exists($key,$this->data))
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

	public function getTable()
	{
		return Ccc::getModel($this->getTableClassName());
	}

	public function save()
	{	
		if(array_key_exists($this->getTable()->getPrimaryKey(),$this->data))
		{
			$tableName = $this->getTable()->getPrimaryKey();	
			$id = $this->data[$this->getTable()->getPrimaryKey()];
			$this->getTable()->update($this->data,[$tableName => $id]);
		}
		else
		{
			$id = $this->getTable()->insert($this->data);
		}
		return $id;
	}
}
*/