<?php
class Model_Core_Adapter{

	public $config = [
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dbname' => 'adapter'
	];

	private $connect = NULL;

	public function connect()
	{
		$connect = mysqli_connect($this->config['host'], $this->config['user'],$this->config['password'], $this->config['dbname']);
		$this->setConnect($connect);
		return $connect;
	}

	public function setConnect($connect)
	{
		$this->connect = $connect;
		return $this;
	}

	public function getConnect()     
    {
        return $this->connect;
    }


    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

	public function getConfig()
	{
		return $this->config;
	}

	public function query($query)
    {
        if(!$this->getConnect())
        {
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

	public function insert($query)
	{
		$result=$this->query($query);
		if($result)
		{	
			return $this->getConnect()->insert_id;
		}
		return $result;
	}

	public function update($query)
	{
		$result = $this->query($query);
        return $result;
	}

	public function delete($query)
	{
		$result = $this->query($query);
		return $result;
	}

	public function select($query)
	{
		$result = $this->query($query);
		return $result;
	}

	public function fetchRow($query)
	{
		$result = $this->query($query);
		if($result->num_rows)
		{
			return $result->fetch_assoc();
		}
		return false;
	}

	public function fetchAll($query , $mode= MYSQLI_ASSOC)
	{
		$result = $this->query($query);
		if($result->num_rows)
		{
			return $result->fetch_all($mode);
		}
		return false;
	}

	public function fetchPairs($query)
	{
		$result = $this->fetchAll( $query , MYSQLI_NUM );
		if(!$result)
		{
			return false;
		}
			
		$keys = array_column($result, "0");
		$values = array_column($result, "1");
		if(!$values)
		{
			$values = array_fill(0, count($key), null);
		}
		$result = array_combine($keys,$values);
		
		return $result;
	}
	
	public function fetchOne($query)
	{
		$result = $this->fetchRow($query);
		if(!$result)
		{
			return false;
		}

		$popElement = array_pop($result);
		return $popElement;
	}

	/*public function redirect($url)
	{
		header("location :$url");	
		exit();			
	}*/
}
$adapter = new Model_Core_Adapter();

/*
$query = "SELECT productId , name FROM product";
$result = $adapter->fetchPairs($query);
print_r($result);
*/


//$adapter->insert("INSERT INTO `product`(`ID`, `name`, `price`, `quantity`, `status`, `created_date`, `updated_at`) VALUES ('3','tablet','6000','2','2','2022-01-10','2022-01-11')");
//$adapter->insert("INSERT INTO category(name,status,created_at,updated_at) VALUES('electronics',1,'2022-01-10','2022-01-12')");
/*$data = $adapter->fetchAll("SELECT * FROM product");
print_r($data);*/
 //$del = $adapter->delete("DELETE FROM category WHERE id = 2");
//var_dump($del);