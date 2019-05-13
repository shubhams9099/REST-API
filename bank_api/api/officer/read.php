<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	include_once '../../config/Database.php';
	include_once '../../models/Officer.php';
	$database=new Database();
	$db=$database->connect();
	$officer=new Officer($db);
	$result=$officer->read();
	$num=$result->rowCount();
	if($num>0){
		$post_arr['data']=array();
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			$item=array(
				'officer_id'=>$officer_id,
				'cust_id'=>$cust_id,
				'end_date'=>$end_date,
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'start_date'=>$start_date,
				'title'=>$title
			);
			array_push($post_arr['data'], $item);
		}
		echo json_encode($post_arr);
	} 
	else{
		echo json_encode(array('msg'=>'No data Found'));
	}
?>