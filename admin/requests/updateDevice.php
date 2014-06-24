<?php

$id_device = filter_input(INPUT_GET, "id_device");
$name = filter_input(INPUT_GET, "name");
$imei = filter_input(INPUT_GET, "imei");
$id_model = filter_input(INPUT_GET, "id_model");
$id_brand = filter_input(INPUT_GET, "id_brand");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE devices SET name = '".$name."', "
        . "imei = '".$imei."', "
        . "id_model =   ".$id_model.", "
        . "id_brand = ".$id_brand." WHERE id_device = ".$id_device.";" or die (mysqli_error($link));

$result = $link->query($query);