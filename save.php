<?php
include 'db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_device = filter_input(INPUT_POST, "device");
$timestamp = filter_input(INPUT_POST, "timestamp");
$eval_type = filter_input(INPUT_POST, "eval_type");
$eval_status = filter_input(INPUT_POST, "eval_status");
$pruebasResult = filter_input(INPUT_POST, "pruebas");
$postdata = file_get_contents("php://input");

$pruebas = json_decode($pruebasResult, true);

$query = "INSERT INTO evaluations(name, description, time) VALUES ('".$id_device."-".$timestamp."-".$eval_type."-".$eval_status."','" . $postdata . "', 10);";
if (mysqli_query($link, $query)) {
    die("Error" . mysqli_error($link));
}
