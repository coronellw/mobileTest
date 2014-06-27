<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_model = filter_input(INPUT_POST, "id_model");

$query = "DELETE FROM models WHERE id_model = " . $id_model;

$result = $link->query($query) or die("Error ".  mysqli_error($link));
echo $result;