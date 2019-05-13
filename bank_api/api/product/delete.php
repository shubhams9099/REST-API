<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	header('Access-Control-Allow-Methods:DELETE');
	header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-with');

	include_once '../../config/Database.php';
	include_once '../../models/Product.php';
	$database=new Database();
	$db=$database->connect();
	$product=new Product($db);

	$data=json_decode(file_get_contents("php://input"));
	$product->product_cd=$data->product_cd;

	//delete the entry
	if($product->delete()){
		echo json_encode(array("msg"=>"product deleted"));
	}
	else{
		echo json_encode(array("msg"=>'product not deleted'));
	}

?>