<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	include_once '../../config/Database.php';
	include_once '../../models/Officer.php';
	

	$database=new Database();
	$db=$database->connect();
	$officer=new Officer($db);
	$officer->officer_id=isset($_GET['id'])?$_GET['id']:die();
	$officer->read_single();
	$officer_arr=array(
		'officer_id'=>$officer->officer_id,
		'cust_id'=>$officer->cust_id,
		'end_date'=>$officer->end_date,
		'first_name'=>$officer->first_name,
		'last_name'=>$officer->last_name,
		'start_date'=>$officer->start_date,
		'title'=>$officer->title
	);	
	print_r(json_encode($officer_arr));
?>