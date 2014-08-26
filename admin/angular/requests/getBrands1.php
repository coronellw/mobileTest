<?php

include '../../../db_info.php';
include '../../../validations.php';

$response = array();
$brands = array();
$query = "SELECT * FROM brands ORDER BY name;" or die("Error " . mysqli_error($link));
$result = $link->query($query);
while ($brand = mysqli_fetch_assoc($result)) {
    $brands[] = $brand;
}

if (count($brands) > 0) {
    $response['result'] = "ok";
    $response['brands'] = $brands;
    $response['count']=count($brands);
} else {
    $response['result'] = "fail";
    $response['msg_error'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);
