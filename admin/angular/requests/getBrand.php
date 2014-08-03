<?php

include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$imei = $json_data['imei'];
$response = array();

$query = "SELECT b.* FROM devices d, brands b WHERE d.id_brand = b.id_brand AND d.imei = $imei" or die("Error " . mysqli_error($link));
$result = $link->query($query);

if (mysqli_num_rows($result) > 0) {
    $brand = mysqli_fetch_array($result);
    $response['result'] = "ok";
    $response['brand'] = $brand;
} else {
    $response['result'] = "fail";
    $response['error_msg'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);
