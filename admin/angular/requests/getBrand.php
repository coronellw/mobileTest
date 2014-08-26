<?php

include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$id_brand = $json_data['id_brand'];
$response = array();

$query = "SELECT b.* FROM brands b WHERE b.id_brand = $id_brand" or die("Error " . mysqli_error($link));
$result = $link->query($query);

if (mysqli_num_rows($result) > 0) {
    $brand = mysqli_fetch_assoc($result);
    $response['result'] = "ok";
    $response['brand'] = $brand;
} else {
    $response['result'] = "fail";
    $response['error_msg'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);
