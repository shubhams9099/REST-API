<?php
	class Product{

		private $conn;
		private $table='product';
		public $product_cd;
		public $date_offered;
		public $name;
		public $product_type_cd;
		public function __construct($db){
			$this->conn=$db;
		}
		public function read(){
			$query='SELECT * FROM '.$this->table;
			$stmt=$this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function read_single(){
			$query='SELECT * FROM product where product_cd = ?';
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$this->product_cd);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->product_cd=$row['product_cd'];
			$this->date_offered=$row['date_offered'];
			$this->name=$row['name'];
			$this->product_type_cd=$row['product_type_cd'];
			
		}
		public function create()
		{
			$query='INSERT INTO '.$this->table.' SET 
				product_cd=:product_cd,
				date_offered=:date_offered,
				name=:name,
				product_type_cd=:product_type_cd				
			';
			$stmt=$this->conn->prepare($query);
			$this->product_cd=htmlspecialchars(strip_tags($this->product_cd));
			$this->date_offered=htmlspecialchars(strip_tags($this->date_offered));
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->product_type_cd=htmlspecialchars(strip_tags($this->product_type_cd));


			$stmt->bindParam(':product_cd',$this->product_cd);
			$stmt->bindParam(':date_offered',$this->date_offered);
			$stmt->bindParam(':name',$this->name);
			$stmt->bindParam(':product_type_cd',$this->product_type_cd);

			if($stmt->execute())
				return true;
			else
				return false;
		}

		public function update(){
			$query='UPDATE '.$this->table.'
			 	 SET
			 	 product_cd=:id,
				date_offered=:date_offered,
				name=:name,
				product_type_cd=:product_type_cd where product_cd=:id
			';
			$stmt=$this->conn->prepare($query);
			$this->product_cd=htmlspecialchars(strip_tags($this->product_cd));
			$this->date_offered=htmlspecialchars(strip_tags($this->date_offered));
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->product_type_cd=htmlspecialchars(strip_tags($this->product_type_cd));


			$stmt->bindParam(':id',$this->product_cd);
			$stmt->bindParam(':date_offered',$this->date_offered);
			$stmt->bindParam(':name',$this->name);
			$stmt->bindParam(':product_type_cd',$this->product_type_cd);

			if($stmt->execute())
				return true;
			else
				return false;
		}

		public function delete(){
			$query='DELETE FROM '.$this->table.' where product_cd= ?';
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$this->product_cd);
			if($stmt->execute())
				return true;
			else
				return false;
		}
	}
?>