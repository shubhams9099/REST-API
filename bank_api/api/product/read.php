<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-Type:application/json');
	include_once '../../config/Database.php';
	include_once '../../models/Product.php';
	$database=new Database();
	$db=$database->connect();
	$product=new Product($db);
	$result=$product->read();
	$num=$result->rowCount();
	if($num>0){
		$product_arr['data']=array();
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			$item=array(
				'product_cd'=>$product_cd,
				'date_offered'=>$date_offered,
				'name'=>$name,
				'product_type_cd'=>$product_type_cd,
			);
			array_push($product_arr['data'], $item);
		}
		echo json_encode($product_arr);
	} 
	else{
		echo json_encode(array('msg'=>'No data Found'));
	}
?>