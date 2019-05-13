<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	include_once '../../config/Database.php';
	include_once '../../models/Product.php';
	

	$database=new Database();
	$db=$database->connect();
	$product=new Product($db);
	$product->product_cd=isset($_GET['id'])?$_GET['id']:die();
	$product->read_single();
	$product_arr=array(
		'product_cd'=>$product->product_cd,
		'date_offered'=>$product->date_offered,
		'name'=>$product->name,
		'product_type_cd'=>$product->product_type_cd,
	);	
	print_r(json_encode($product_arr));
?>