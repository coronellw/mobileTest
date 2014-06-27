<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_brand = filter_input(INPUT_POST, "id_brand");

$query = "DELETE FROM brands WHERE id_brand = " . $id_brand;

$result = $link->query($query) or die("Error ".  mysqli_error($link));