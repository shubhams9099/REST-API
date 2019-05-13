<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	header('Access-Control-Allow-Methods:PUT');
	header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-with');

	include_once '../../config/Database.php';
	include_once '../../models/Officer.php';
	$database=new Database();
	$db=$database->connect();
	$officer=new Officer($db);

	$data=json_decode(file_get_contents("php://input"));
	$officer->officer_id=$data->id;
	$officer->title=$data->title;
	$officer->start_date=$data->start_date;
	$officer->end_date=$data->end_date;
	$officer->cust_id=$data->cust_id;
	$officer->first_name=$data->first_name;
	$officer->last_name=$data->last_name;

	//do the entry
	if($officer->update()){
		echo json_encode(array("msg"=>"officer updated"));
	}
	else{
		echo json_encode(array("msg"=>'officer not updated'));
	}

?>