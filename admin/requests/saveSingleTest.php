<?php
include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$date = filter_input(INPUT_GET, "fecha");
$id_device = filter_input(INPUT_GET, "device");
$resultado = filter_input(INPUT_GET, "resultado");
$test = filter_input(INPUT_GET, "test");
$status_test = filter_input(INPUT_GET, "status_test");
$evaluation = filter_input(INPUT_GET, "evaluation");
$response = array();


$query = "INSERT INTO results(test_date, id_device, id_status_test, id_test, id_status_evaluation, id_evaluation) VALUES 
        ('$date',$id_device,$status_test, $test, $resultado, $evaluation";
$result = $link->query($query);
$id = mysqli_insert_id();

if ($result && $id !== 0) {
    $response['result']='ok';
}else{
    $response['result']='fail';
}

echo json_encode($response);