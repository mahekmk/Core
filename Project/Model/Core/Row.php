<?php 

class Model_Core_Row
{
	protected $data = [];
	protected $tableClassName;

	public function __construct()
    {
        
    }

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


	public function load($id, $column = null)
    {
        if($column == null){
            $column = $this->getTable()->getPrimaryKey();
        }
        $tableName = $this->getTable()->getTableName();
        $query = "SELECT * FROM $tableName WHERE $column = $id";
        
        return $this->fetchRow($query);
        
    }

    public function delete()
    {
        if(!array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
        {
            return false;
        }
        $key = $this->getTable()->getPrimaryKey();
        $value = $this->data[$this->getTable()->getPrimaryKey()];
        $result = $this->getTable()->delete([$key=>$value]);
        return $result;
    }

    public function fetchAll($query)
    {
        $results = $this->getTable()->fetchAll($query);
        if(!$results)
        {
            return $results;
        }
        foreach ($results as &$result) 
        {
            $result = (new $this())->setData($result);
        }
        return $results;
    }

    public function fetchRow($query)
    {
        $result = $this->getTable()->fetchRow($query);
        if(!$result){
            return $result;
        }
        return (new $this())->setData($result);
    }
}



/*Ccc::loadClass('Model_Core_Table_Row');

class Model_Core_Table
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
	protected $rowClassName;
  
	public function getRowClassName()
	{
		return $this->rowClassName;
	}

	public function setRowClassName($rowClassName)
	{
		$this->rowClassName = $rowClassName;
		return $this;
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

	public function insert(array $insertArr)
	{
		$colName = [];
		$valueName =[];
		global $adapter;
		foreach ($insertArr as $columnName => $value ){
			array_push($colName,$columnName);
			array_push($valueName,$value);
		}
			$sql1= implode(',', $colName);
			$sql2= implode("','", $valueName);
			$sql3 = "'" . $sql2 . "'";
			$tableName = $this->getTableName();

			$insert = "INSERT INTO $tableName($sql1) values($sql3);" ;
			$result = $adapter->insert($insert);
			return $result;
	}

	public function delete(array $deleteArr)
	{ 
		global $adapter;
		$tableName = $this->getTableName();

		$key = key($deleteArr);
		$value = $deleteArr[$this->primaryKey];
		$delete = "DELETE FROM $tableName WHERE $key = $value;";
		$result = $adapter->delete($delete);
		return $result;
	}

	public function update(array $updateArr , array $whereArr)
	{
		global $adapter;
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
		$result = $adapter->update($update);
		return $result;
	}

	public function fetchRow($queryFetchRow)
  	{
		global $adapter;
		$tableName = $this->getTableName();
		$result = $adapter->fetchRow($queryFetchRow);
		return $result;  
  	}

	public function fetchAll($queryFetchAll)
	{
		global $adapter;
		$tableName = $this->getTableName();
		$result = $adapter->fetchAll($queryFetchAll);
		return $result;
	}

	public function load($id)
	{
		$rowData = $this->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");
		if(!$rowData)
		{
			return false;
		}
		$row = $this->getRow();
		$row->setData($rowData);
		return $row;
	}
}*/
