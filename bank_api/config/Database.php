<?php
	class Database
	{
		private $uname="root";
		private $pass="123456";
		private $db_name="bank";
		private $host="localhost";
		private $conn;
		function connect()
		{
			$this->conn=null;
			try{
				$this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->uname,$this->pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->conn;
			}
			catch(PDOException $e){
				echo 'Connection failed'.$e->getMessage();
			}
		}
	}
	/*$db=new Database();
	$c=$db->connect();*/
?>