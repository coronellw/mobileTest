<?php

include '../../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$json_data = json_decode(file_get_contents("php://input"), true);
$response = array();
$id_device = $json_data['id_device'];

$query = "DELETE FROM devices WHERE id_device = " . $id_device;

$result = $link->query($query) or die("Error ".  mysqli_error($link));

if ($result) {
	$response['result'] = 'ok';
}else{
	$response['result'] = 'fail';
	$response['error_msg'] = mysqli_error($link);
	$response['query'] = $query;
}

echo json_encode($response);