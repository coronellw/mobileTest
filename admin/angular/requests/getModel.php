<?php

include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$imei = $json_data['imei'];
$response = array();

$query = "SELECT m.* FROM devices d, models m WHERE d.id_model = m.id_model AND d.imei = $imei" or die("Error " . mysqli_error($link));
$result = $link->query($query);

if (mysqli_num_rows($result) > 0) {
    $model = mysqli_fetch_assoc($result);
    $response['result'] = "ok";
    $response['model'] = $model;
} else {
    $response['result'] = "fail";
    $response['error_msg'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);