<?php

include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$name = $json_data["device"]["name"];
$imei = $json_data["device"]["imei"];
$id_model = $json_data["device"]["id_model"];
$id_brand = $json_data["device"]["id_brand"];
$id_device = $json_data["device"]["id_device"];
$response = array();

$query = "UPDATE devices SET name = '" . $name . "', "
        . "imei = '" . $imei . "', "
        . "id_model =   " . parseIntOrNull($id_model) . ", "
        . "id_brand = " . parseIntOrNull($id_brand) . " WHERE id_device = " . $id_device . ";" or die(mysqli_error($link));

$result = $link->query($query);

if ($result) {
    $response['result'] = 'ok';
    $response['id_device'] = $id_device;
    $response['imei'] = $imei;
} else {
    $response['result'] = 'fail';
    $response['query'] = $query;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);
