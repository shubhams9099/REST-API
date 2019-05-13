<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	header('Access-Control-Allow-Methods:DELETE');
	header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-with');

	include_once '../../config/Database.php';
	include_once '../../models/Officer.php';
	$database=new Database();
	$db=$database->connect();
	$officer=new Officer($db);

	$data=json_decode(file_get_contents("php://input"));
	$officer->officer_id=$data->id;

	//delete the entry
	if($officer->delete()){
		echo json_encode(array("msg"=>"officer deleted"));
	}
	else{
		echo json_encode(array("msg"=>'officer not deleted'));
	}

?>