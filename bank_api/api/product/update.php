<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	header('Access-Control-Allow-Methods:PUT');
	header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-with');

	include_once '../../config/Database.php';
	include_once '../../models/Product.php';
	$database=new Database();
	$db=$database->connect();
	$product=new Product($db);

	$data=json_decode(file_get_contents("php://input"));
	
	$product->product_cd=$data->product_cd;
	$product->date_offered=$data->date_offered;
	$product->name=$data->name;
	$product->product_type_cd=$data->product_type_cd;

	//do the entry
	if($product->update()){
		echo json_encode(array("msg"=>"product updated"));
	}
	else{
		echo json_encode(array("msg"=>'product not updated'));
	}

?>