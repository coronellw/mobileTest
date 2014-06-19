<?php

$imei = filter_input(INPUT_GET, "imei");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "SELECT d.imei, d.id_model, d.id_brand FROM devices d WHERE d.imei = " . $imei . ";" or die("Error " . mysqli_error($link));

$device_result = $link->query($query);
$device = mysqli_fetch_array($device_result);
echo json_encode($device);