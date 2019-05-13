<?php
	class Officer{

		private $conn;
		private $table='officer';
		public $officer_id;
		public $end_date;
		public $first_name;
		public $last_name;
		public $start_date;
		public $title;
		public $cust_id;
		public function __construct($db){
			$this->conn=$db;
		}
		public function read(){
			$query='SELECT * FROM officer';
			$stmt=$this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function read_single(){
			$query='SELECT * FROM officer where officer_id = ?';
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$this->officer_id);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->end_date=$row['end_date'];
			$this->first_name=$row['first_name'];
			$this->last_name=$row['last_name'];
			$this->start_date=$row['start_date'];
			$this->title=$row['title'];
			$this->cust_id=$row['cust_id'];
		}
		public function create()
		{
			$query='INSERT INTO '.$this->table.' SET 
				end_date=:end_date,
				first_name=:first_name,
				last_name=:last_name,
				start_date=:start_date,
				title=:title,
				cust_id=:cust_id
			';
			$stmt=$this->conn->prepare($query);
			$this->end_date=htmlspecialchars(strip_tags($this->end_date));
			$this->first_name=htmlspecialchars(strip_tags($this->first_name));
			$this->last_name=htmlspecialchars(strip_tags($this->last_name));
			$this->start_date=htmlspecialchars(strip_tags($this->start_date));
			$this->title=htmlspecialchars(strip_tags($this->title));
			$this->cust_id=htmlspecialchars(strip_tags($this->cust_id));


			$stmt->bindParam(':end_date',$this->end_date);
			$stmt->bindParam(':first_name',$this->first_name);
			$stmt->bindParam(':last_name',$this->last_name);
			$stmt->bindParam(':title',$this->title);
			$stmt->bindParam(':cust_id',$this->cust_id);
			$stmt->bindParam(':start_date',$this->start_date);

			if($stmt->execute())
				return true;
			else
				return false;
		}

		public function update(){
			$query='UPDATE '.$this->table.'
			 	 SET
			 	end_date=:end_date,
				first_name=:first_name,
				last_name=:last_name,
				start_date=:start_date,
				title=:title,
				cust_id=:cust_id where officer_id=:id
			';
			$stmt=$this->conn->prepare($query);
			
			$this->end_date=htmlspecialchars(strip_tags($this->end_date));
			$this->first_name=htmlspecialchars(strip_tags($this->first_name));
			$this->last_name=htmlspecialchars(strip_tags($this->last_name));
			$this->start_date=htmlspecialchars(strip_tags($this->start_date));
			$this->title=htmlspecialchars(strip_tags($this->title));
			$this->cust_id=htmlspecialchars(strip_tags($this->cust_id));


			$stmt->bindParam(':end_date',$this->end_date);
			$stmt->bindParam(':first_name',$this->first_name);
			$stmt->bindParam(':last_name',$this->last_name);
			$stmt->bindParam(':title',$this->title);
			$stmt->bindParam(':cust_id',$this->cust_id);
			$stmt->bindParam(':start_date',$this->start_date);
			$stmt->bindParam(':id',$this->officer_id);

			if($stmt->execute())
				return true;
			else
				return false;
		}

		public function delete(){
			$query='DELETE FROM '.$this->table.' where officer_id= ?';
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$this->officer_id);
			if($stmt->execute())
				return true;
			else
				return false;
		}
	}
?>