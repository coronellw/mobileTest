<?php

include '../../../db_info.php';
$json_data = json_decode(file_get_contents("php://input"));
$imei = $json_data->imei;
$id_evaluation = $json_data->id_evaluation;

$query = "SELECT name, description, tag, action FROM tests;" or die("Error " . mysqli_error($link));

$result = $link->query($query);
$tests = array();

while ($test = mysqli_fetch_array($result)) {
    $tests[] = $test;
}

echo json_encode($tests);