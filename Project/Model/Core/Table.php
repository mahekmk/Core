<?php Ccc::loadClass('Model_Core_Table_Row');

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
}
