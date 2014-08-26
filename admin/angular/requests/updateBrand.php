<?php
include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$brand = $json_data['brand'];
$response = array();


$id_brand = $brand["id_brand"];
$name = $brand["name"];
$description = $brand["description"];

$query = "UPDATE brands SET name = " . parseString($name) . ", "
        . "description = " . parseString($description) . "  WHERE id_brand = " . $id_brand . ";" or die(mysqli_error($link));

$result = $link->query($query);

if ($result) {
	$response['result'] = "ok";
	$response['id_brand'] = $id_brand;
}else{
	$response['result'] = "fail";
	$response['error_msg'] = mysqli_error($link);
	$response['query'] = $query;
}

echo json_encode($response);