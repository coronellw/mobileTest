<?php

include '../../db_info.php';
include './parseParams.php';

$id_brand = filter_input(INPUT_GET, "id_brand");
$name = filter_input(INPUT_GET, "name");
$description = filter_input(INPUT_GET, "description");

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE brands SET name = '" . $name . "', "
        . "description = " . validateNullString($description) . "  WHERE id_brand = " . $id_brand . ";" or die(mysqli_error($link));
echo $query;
$result = $link->query($query);
