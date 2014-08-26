<?php

include '../../../db_info.php';
include '../../../validations.php';

$json_data = json_decode(file_get_contents("php://input"), true);
$response = array();
$models = array();

if (isset($json_data['id_brand'])) {
    $query = "SELECT * FROM models WHERE id_brand = " . $json_data['id_brand'] . " ORDER BY name;";
} else {
    $query = "SELECT * FROM models ORDER BY name;" or die("Error " . mysqli_error($link));
}
$result = $link->query($query);
while ($model = mysqli_fetch_assoc($result)) {
    $models[] = $model;
}

if (count($models) > 0) {
    $response['result'] = "ok";
    $response['models'] = $models;
    $response['count'] = count($models);
} else {
    $response['result'] = "fail";
    $response['msg_error'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);
