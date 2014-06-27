<?php

include './parseParams.php';
include '../../db_info.php';

$name = validateNullString(filter_input(INPUT_GET, "name"));
$model = validateNullString(filter_input(INPUT_GET, "model"));
$id_brand = filter_input(INPUT_GET, "id_brand");

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "INSERT INTO models(name, model, id_brand) VALUES (" . $name . ", " . $model . ", " . $id_brand . ");" or die("Error " . mysqli_error($link));

$result = $link->query($query);

echo $result;
