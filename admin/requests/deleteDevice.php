<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_device = filter_input(INPUT_POST, "id_device");

$query = "DELETE FROM devices WHERE id_device = " . $id_device;

$result = $link->query($query) or die("Error ".  mysqli_error($link));