<?php

class Model_Core_Row_Resource
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
  
	public function __construct()
    {
        
    }

    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }

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
}

